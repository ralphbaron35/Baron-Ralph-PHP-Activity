<?php
require_once 'includes/validation.php';

$errors = [];
$old    = ['username' => '', 'email' => '', 'phone' => ''];   // sticky values (never passwords)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['username'] = trim(post('username'));
    $old['email']    = trim(post('email'));
    $old['phone']    = trim(post('phone'));
    $password        = post('password');
    $confirm         = post('confirmPassword');

    $errors['username']        = validateUsername($old['username']);
    $errors['email']           = validateEmail($old['email']);
    $errors['phone']           = validatePhone($old['phone']);
    $errors['password']        = validatePassword($password, $old['username']);
    $errors['confirmPassword'] = validateConfirmPassword($confirm, $password);
    $errors = array_filter($errors);

    if (empty($errors)) {
        header('Location: login.php?registered=1');
        exit;
    }
}

// Variables read by includes/head.php
$pageTitle  = 'Register - Pixel World';
$stylesheet = 'assets/css/act3page2.css';
$bodyClass  = '';
include 'includes/head.php';
?>

    <div class="login-card">
      <h1 class="login-title">Register</h1>

      <form id="registerForm" method="post" action="register.php" novalidate>
        <div class="mb-3 input-wrapper">
          <input type="text" name="username" id="username"
                 class="form-control<?= invalidClass($errors, 'username') ?>"
                 placeholder="Username" value="<?= e($old['username']) ?>">
          <i class="bi bi-person icon"></i>
          <?php fieldError($errors, 'username'); ?>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="email" name="email" id="email"
                 class="form-control<?= invalidClass($errors, 'email') ?>"
                 placeholder="Email Address" value="<?= e($old['email']) ?>">
          <i class="bi bi-envelope icon"></i>
          <?php fieldError($errors, 'email'); ?>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="tel" name="phone" id="phone"
                 class="form-control<?= invalidClass($errors, 'phone') ?>"
                 placeholder="Phone Number" value="<?= e($old['phone']) ?>">
          <i class="bi bi-telephone icon"></i>
          <?php fieldError($errors, 'phone'); ?>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="password" name="password" id="password"
                 class="form-control<?= invalidClass($errors, 'password') ?>"
                 placeholder="Password">
          <i class="bi bi-lock icon"></i>
          <?php fieldError($errors, 'password'); ?>
        </div>

        <div class="mb-3 input-wrapper">
          <input type="password" name="confirmPassword" id="confirmPassword"
                 class="form-control<?= invalidClass($errors, 'confirmPassword') ?>"
                 placeholder="Confirm Password">
          <i class="bi bi-shield-lock icon"></i>
          <?php fieldError($errors, 'confirmPassword'); ?>
        </div>

        <button type="submit" class="btn btn-login w-100">Register</button>

        <div class="text-center mt-3 register-text">
          <span>Already have an account? </span>
          <a href="login.php" class="register-link">Login Here</a>
        </div>
      </form>
    </div>

<?php include 'includes/scripts.php'; ?>
