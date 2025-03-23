<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
</head>
<body>
<div class="form-container">
    <h1>Register</h1>

    <?php
    if (isset($_SESSION['errorMessage'])): ?>
        <div class="error"><?php echo htmlspecialchars($_SESSION['errorMessage']); ?></div>
        <?php
        unset($_SESSION['errorMessage']);
    endif;
    ?>


    <form id="registration-form" action="../includes/register.php" method="POST" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <span id="username-error" class="error-message" style="color: red; display: none;"></span>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <span id="email-error" class="error-message" style="color: red; display: none;"></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <span id="password-error" class="error-message" style="color: red; display: none;"></span>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <span id="confirm-password-error" class="error-message" style="color: red; display: none;"></span>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture">
        <span id="profile-picture-error" class="error-message" style="color: red; display: none;"></span>

        <button type="submit" id="register-button">Register</button>
    </form>

    <a href="login-form.php">Already have an account? Login</a>
</div>
</body>
</html>