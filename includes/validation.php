<?php
/**
 * Server-side validation helpers (PHP + regular expressions with preg_match).
 * Each validator returns an error message string, or '' when the value is valid.
 */

// ---------- Regular expressions ----------
const RE_USERNAME = '/^[A-Za-z][A-Za-z0-9_]{2,19}$/D';              // 3-20 chars, starts with a letter
const RE_EMAIL    = '/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$/D';
const RE_PHONE    = '/^\+?[0-9]{7,15}$/D';                           // after stripping spaces, dashes, ( )
const RE_PASSWORD = '/^(?=.*[A-Za-z])(?=.*\d).{7,}$/D';              // 7+ chars, at least 1 letter and 1 digit

// ---------- Helpers ----------
/** Trim and read a POST field safely. */
function post(string $key): string
{
    return isset($_POST[$key]) && is_string($_POST[$key]) ? $_POST[$key] : '';
}

/** Escape output for HTML. */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/** Print the Facebook-style error block used by the existing CSS. */
function fieldError(array $errors, string $key): void
{
    if (!empty($errors[$key])) {
        echo '<div class="fb-error show"><i class="bi bi-exclamation-circle-fill"></i><span>'
            . e($errors[$key]) . '</span></div>';
    }
}

/** Returns ' is-invalid-fb' when a field has an error (for the input's class list). */
function invalidClass(array $errors, string $key): string
{
    return empty($errors[$key]) ? '' : ' is-invalid-fb';
}

// ---------- Login validators ----------
function validateLoginUsername(string $value): string
{
    $value = trim($value);
    if ($value === '') {
        return 'Please enter your username or email.';
    }
    if (!preg_match(RE_EMAIL, $value) && !preg_match(RE_USERNAME, $value)) {
        return 'Please enter a valid username or email address.';
    }
    return '';
}

function validateLoginPassword(string $value): string
{
    if ($value === '') {
        return 'Please enter your password.';
    }
    if (strlen($value) < 6) {
        return 'Your password must be at least 6 characters.';
    }
    return '';
}

// ---------- Register validators ----------
function validateUsername(string $value): string
{
    $value = trim($value);
    if ($value === '') {
        return 'Please enter a username.';
    }
    if (strlen($value) < 3) {
        return 'Your username must be at least 3 characters.';
    }
    if (!preg_match(RE_USERNAME, $value)) {
        return 'Username must start with a letter and use only letters, numbers, or underscores (max 20).';
    }
    return '';
}

function validateEmail(string $value): string
{
    $value = trim($value);
    if ($value === '' || !preg_match(RE_EMAIL, $value)) {
        return 'Please enter a valid email address.';
    }
    return '';
}

function validatePhone(string $value): string
{
    $clean = preg_replace('/[\s\-()]/', '', trim($value));   // remove spaces, dashes, parentheses
    if ($clean === '' || !preg_match(RE_PHONE, $clean)) {
        return 'Please enter a valid phone number (7-15 digits, optional leading +).';
    }
    return '';
}

function validatePassword(string $value, string $username): string
{
    $msg = 'Please choose a more secure password: longer than 6 characters, with at least one letter and one number.';
    if ($value === '' || !preg_match(RE_PASSWORD, $value)) {
        return $msg;
    }
    $username = strtolower(trim($username));
    if ($username !== '' && strpos(strtolower($value), $username) !== false) {
        return 'Your password must not contain your username.';
    }
    return '';
}

function validateConfirmPassword(string $value, string $password): string
{
    if ($value === '') {
        return 'Please re-enter your password.';
    }
    if (!hash_equals($password, $value)) {
        return 'The two passwords that you entered do not match.';
    }
    return '';
}
