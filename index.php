<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: includes/welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - User Registration System</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<h1>Welcome to the User Registration System</h1>

<p>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="public/login-form.php">Login</a> or <a href="public/registration-form.php">Register</a>
    <?php else: ?>
        <a href="includes/welcome.php">Go to Welcome Page</a>
    <?php endif; ?>
</p>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>