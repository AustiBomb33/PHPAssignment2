<?php
session_start();
session_destroy();
unset($_SESSION['username']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logged Out</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Logged Out</h1>
    <a href="index.php">About Page</a>
    <a href="home.php">Home</a>
    <a href="login.php">Log In</a>
    <a href="register.php">Register</a>
    <p>
        You have been logged out
    </p>
</body>
</html>
