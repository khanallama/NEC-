
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

    <a href="../includes/logout.php">Logout</a>
</div>
</body>
</html>
