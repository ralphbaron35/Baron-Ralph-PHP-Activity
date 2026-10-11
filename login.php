<?php
require_once 'includes/validation.php';

$errors   = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(post('username'));
    $password = post('password');

    $errors['username'] = validateLoginUsername($username);
    $errors['password'] = validateLoginPassword($password);
    $errors = array_filter($errors);          // keep only fields that have an error

    if (empty($errors)) {
        header('Location: index.php');         // valid -> go to the landing page
        exit;
    }
}

// Variables read by includes/head.php
$pageTitle  = 'Login - Pixel World';
$stylesheet = 'assets/css/act3.css';
$bodyClass  = '';
include 'includes/head.php';
?>

    <div class="login-card">
      <h1 class="login-title">Login</h1>

      <?php if (isset($_GET['registered'])): ?>
        <div class="alert alert-success py-2 small text-center">Registration successful! You can now log in.</div>
      <?php endif; ?>

      <form id="loginForm" method="post" action="login.php" novalidate>
        <div class="mb-3 input-wrapper">
          <input type="text" name="username" id="loginUsername"
                 class="form-control<?= invalidClass($errors, 'username') ?>"
                 placeholder="Username or Email" value="<?= e($username) ?>">
          <i class="bi bi-person icon"></i>
          <?php fieldError($errors, 'username'); ?>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="password" name="password" id="loginPassword"
                 class="form-control<?= invalidClass($errors, 'password') ?>"
                 placeholder="Password">
          <i class="bi bi-lock icon"></i>
          <?php fieldError($errors, 'password'); ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 options-row">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">Login</button>

        <div class="text-center mt-3 register-text">
          <span>Don't have an account? </span>
          <a href="register.php" class="register-link">Register</a>
        </div>
      </form>
    </div>

<?php include 'includes/scripts.php'; ?>
