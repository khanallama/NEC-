<?php
session_start(); // Start session to access session variables
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</head>
<body>
<div class="form-container">
    <h1>Login</h1>

    <?php
    if (isset($_SESSION['errorMessage'])): ?>
        <div class="error"><?php echo htmlspecialchars($_SESSION['errorMessage']); ?></div>
        <?php
        unset($_SESSION['errorMessage']);
    endif;
    ?>

    <form id="login-form" action="../includes/login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <span id="email-error" class="error-message" style="color: red; display: none;"></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <span id="password-error" class="error-message" style="color: red; display: none;"></span>

        <button type="submit" id="login-button">Login</button>
    </form>

    <a href="registration-form.php">Don't have an account? Register</a>
</div>
</body>
</html>
