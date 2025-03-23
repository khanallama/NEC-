<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login-form.php");
    exit();
}

require_once '../includes/db-connection.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email, profile_picture FROM users WHERE id = $user_id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();
    $username = $user['username'];
    $email = $user['email'];
    $profilePicture = $user['profile_picture'];
} else {
    $errorMessage = "User not found.";
    session_destroy();
    exit();
}

include '../public/welcome.php';