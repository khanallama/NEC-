<?php
session_start();
require_once 'db-connection.php';
require_once 'user-functions.php';
require_once 'log-functions.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (empty($username)) {
        $errorMessage = "Username is required!";
        logMessage("Registration attempt without Username: $email");

    } elseif (strlen($username) < 3) {
        $errorMessage = "Username must be at least 3 characters long!";
        logMessage("Registration attempt with invalid Username: $email");

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format!";
        logMessage("Registration attempt with invalid email: $email");
    }

    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm_password']);

    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match!";
        logMessage("Registration attempt with mismatched passwords: $email");
    }

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required!";
        logMessage("Registration attempt with missing fields: $email");
    }

    if (!$errorMessage) {
        $profilePicture = '';

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['profile_picture']['type'];
            $fileSize = $_FILES['profile_picture']['size'];

            if (!in_array($fileType, $allowedTypes)) {
                $errorMessage = "Invalid file type!";
                logMessage("Registration attempt with invalid file type: $email");
            } elseif ($fileSize > 2 * 1024 * 1024) {
                $errorMessage = "File is too large!";
                logMessage("Registration attempt with large file: $email");
            } else {
                $uploadDir = '../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $profilePicture = $uploadDir . basename($_FILES['profile_picture']['name']);
                if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture)) {
                    $errorMessage = "Error uploading the image.";
                    logMessage("Error uploading profile picture: $email");
                }
            }
        }

        if (!$errorMessage) {
            $errorMessage = registerUser($username, $email, $password, $profilePicture, $connection);

            if (!$errorMessage) {
                logMessage("User registered successfully: $email");
                header('Location: ../public/login-form.php');
                exit();
            }
        }
    }
}

if ($errorMessage) {
    $_SESSION['errorMessage'] = $errorMessage;
    header("Location: ../public/registration-form.php");
    exit();
}