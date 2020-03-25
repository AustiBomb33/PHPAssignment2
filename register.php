<?php
$dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register a New User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Register</h1>
    <a href="index.php">About Page</a>
    <a href="home.php">Home</a>
    <form action="" method="post">
        <label for="username">Username:</label><input type="text" name="username" id="username" value="<?php echo $_POST['username']?>" placeholder="username">
        <label for="password">Password:</label><input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        //check if user already exists
        $query = "select count(1) from UserInfo where userName='$username'";
        $stmt = $dbconn->prepare($query);
        $stmt->execute();
        if($stmt->fetch()[0] == 0){
            $query = "insert into UserInfo values('$username', '$passwordHash')";
            $stmt = $dbconn->prepare($query);
            $stmt->execute();
            echo "User has been created with name '$username'";

        }

    }
    ?>
</body>
</html>
