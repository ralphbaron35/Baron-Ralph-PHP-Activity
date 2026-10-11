<?php
// Shared <head>. Pages can set these variables BEFORE including this file;
// otherwise the defaults below (used by index.php) apply.
$pageTitle  = $pageTitle  ?? 'Pixel World';
$stylesheet = $stylesheet ?? 'assets/css/style.css';
$bodyClass  = $bodyClass  ?? 'd-flex flex-column h-100';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($stylesheet) ?>">
  </head>
<body class="<?= htmlspecialchars($bodyClass) ?>">
