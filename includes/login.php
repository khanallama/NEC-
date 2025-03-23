<?php
session_start();
require_once 'db-connection.php';
require_once 'user-functions.php';
require_once 'log-functions.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format!";
        logMessage("Login attempt with invalid email: $email");
    }

    $password = htmlspecialchars($_POST['password']);

    if (empty($email) || empty($password)) {
        $errorMessage = "Both fields are required!";
        logMessage("Login attempt with missing fields");
    }

    if (!$errorMessage) {
        $errorMessage = loginUser($email, $password, $connection);

        if (!$errorMessage) {
            logMessage("User logged in successfully: $email");
            header("Location: welcome.php");
            exit();
        }
    }
}

if ($errorMessage) {
    $_SESSION['errorMessage'] = $errorMessage;
    header("Location: ../public/login-form.php");
    exit();
}
