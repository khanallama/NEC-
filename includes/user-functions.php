<?php

/**
 * @param $username
 * @param $email
 * @param $password
 * @param $profilePicture
 * @param $connection
 * @return string|null
 */
function registerUser($username, $email, $password, $profilePicture, $connection)
{

    $username = $connection->real_escape_string($username);
    $email = $connection->real_escape_string($email);

    $sql = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        logMessage("Registration attempt with existing username or email: $email");
        return "Username or Email already exists!";
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $profilePicture = $connection->real_escape_string($profilePicture);
    $sql = "INSERT INTO users (username, email, password, profile_picture) VALUES ('$username', '$email', '$hashedPassword', '$profilePicture')";

    if ($connection->query($sql)) {
        return null;
    } else {
        logMessage("Database error during registration: " . $connection->error);
        return "Database error: " . $connection->error;
    }
}

/**
 * @param $email
 * @param $password
 * @param $connection
 * @return string|null
 */
function loginUser($email, $password, $connection)
{
    $email = $connection->real_escape_string($email);

    $sql = "SELECT id, password FROM users WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows === 0) {
        logMessage("Login attempt with non-existent email: $email");
        return "Email does not exist!";
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        logMessage("Failed login attempt due to incorrect password: $email");
        return "Incorrect password!";
    }

    @session_start();

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];

    return null;
}
