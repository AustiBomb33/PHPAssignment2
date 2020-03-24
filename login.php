<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <form action="" method="post">
            <div id="simpleLogin">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" name="submit" value="submitted">
            </div>
        </form>
        <?php
        $dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");
        session_start();
        //check for submission
        if(isset($_POST['submit'])){
            //if username exists
            $username = $_POST['username'];
            $query = "select count(1) from UserInfo where username='$username'";
            $stmt = $dbconn->prepare($query);
            $stmt->execute();
            $userExists = ($stmt->fetch() == 1);
        }
        ?>
    </body>
</html>