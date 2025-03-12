<?php
session_start();
require_once '../includes/db-connection.php';
require_once '../includes/user-functions.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match!";
    } else {
        $profilePicture = '';

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0 && in_array($_FILES['profile_picture']['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            $profilePicture = '../uploads/' . basename($_FILES['profile_picture']['name']);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture) or $errorMessage = "Error uploading the image.";
        }

        if (!$errorMessage) {
            $errorMessage = registerUser($username, $email, $password, $profilePicture, $connection);

            if (!$errorMessage) {
                header('Location: login.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="form-container">
    <h1>Register</h1>
    <?php if ($errorMessage): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture">

        <button type="submit">Register</button>
    </form>
    <a href="login.php">Login</a>
</div>

</body>
</html>
