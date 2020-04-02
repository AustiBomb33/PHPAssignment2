<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <a href="index.php">About Page</a>
    <a href="home.php">Home</a>
        <form action="" method="post">
            <fieldset id="simpleLogin">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="submit" name="submit" value="submit">
            </fieldset>
        </form>
        <?php
        $dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");
        session_start();
        //check for submission
        if(isset($_POST['submit'])){

            //check database for username
            $username = $_POST['username'];
            $query = "select count(1) from UserInfo where username='$username'";
            $stmt = $dbconn->prepare($query);
            $stmt->execute();

            //if there is 1 instance of the given username
            if($stmt->fetch()[0] == 1){

                //get hash from server
                $query = "select * from UserInfo where username='$username'";
                $stmt = $dbconn->prepare($query);
                $stmt->execute();

                $hash = $stmt->fetch()[1];
                $password = $_POST['password'];
                if(password_verify($password, $hash)){
                    $_SESSION['username'] = $username;
                    header("location: http://lamp.computerstudi.es/~Austin_A1099028/Assignment2/");
                } else {
                    echo "Bad user";
                    session_destroy();
                }
            } else {
                echo "Bad user";
                session_destroy();
            }
        }
        ?>
    </body>
</html>