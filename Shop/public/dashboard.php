<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1 Align="center"><?php echo $_SESSION["username"] . ', Welcome! This is the dashboard.';?></h1>

    <!-- Admin Dashboard Content -->
    
</body>
</html>

<style>
    .verification-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .verification-container .verification-box input[type="submit"] {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
