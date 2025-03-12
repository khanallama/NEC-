<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="profile-container">
    <h1>Welcome to your profile, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>You are successfully logged in.</p>

    <h3>Your Profile Picture:</h3>
    <img src="../uploads/<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture"
         style="width: 150px; height: 150px; border-radius: 50%;">

    <p>Email: <?php echo htmlspecialchars($email); ?></p>

    <a href="logout.php">Logout</a>
</div>
</body>
</html>
