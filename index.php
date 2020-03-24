<?php
session_start();
$login = isset($_SESSION['username']);
if(!$login){
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment Website</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<h1>Austin Marcoux's Video Game Directory</h1>
<div>
    <a href="index.php">About Page</a>
    <a href="home.php">Home</a>
    <?php
    if(!$login){
        echo "<a href = 'login.php'>Login</a>
<a href='register.php'>Register</a>";
    } else {
        echo "<a href='logout.php'>Log Out</a>";
    }
    ?>
</div>

<p>This website was created because I like video games, and so I decided to relate my assignment to a passion of mine. Originally, the site used a quite insecure method of having a user log in, passing their login name around with $_POST, but in the future the site will use PHP's Sessions for authentication
</p>

</body>
</html>