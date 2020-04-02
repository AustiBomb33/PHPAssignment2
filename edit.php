<?php

session_start();
$login = isset($_SESSION['username']);
if(!$login){
    session_destroy();
    header("lamp.computerstudi.es/~Austin_A1099028/home.php");
}

$dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");

$gameTitle = $_GET['name'];

//check if we've sent a request to submit changed data
if (isset($_POST['gameTitle'])) {
    echo "changing data";
    $newGameTitle = $_POST['gameTitle'];
    $gameDesc = $_POST['gameDesc'];
    $query = "update `games` set `gameTitle` = ':ngt' where `gameTitle` = ':gt';";
    $stmt = $dbconn->prepare($query);
    $stmt->bindParam(":ngt", $newGameTitle);
    $stmt->bindParam(":gt", $gameTitle);
    $stmt->execute();

    $query=" update `games` set `gameDesc` = ':gd' where `gameTitle` = ':ngt';";
    $stmt=$dbconn->prepare($query);
    $stmt->bindParam(":gd", $gameDesc);
    $stmt->bindParam(":ngt", $newGameTitle);
    $stmt->execute();

    header('Location: https://lamp.computerstudi.es/~Austin_A1099028/Assignment2/home.php');
} else {
    $query = "select gameDesc from games where gameTitle='$gameTitle'";
    $stmt = $dbconn->prepare($query);
    $stmt->execute();
    $gameDesc = $stmt->fetch()[0];
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Assignment Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Austin Marcoux's Video Game Directory</h1>
<div>
    <a href="index.php">About Page</a>
    <a href="home.php">Home</a>
    <?php
    if (!$login) {
        echo "<a href = 'login.php'>Login</a>
<a href='register.php'>Register</a>";
    } else {
        echo "<a href='logout.php'>Log Out</a>";
    }
    ?>
</div>
<fieldset>
    <form action="<?php echo "http://lamp.computerstudi.es/~Austin_A1099028/Assignment2/edit.php?name=$gameTitle"; ?>" method="post">
        <label for="gameTitle">Game Title:</label><input id='gameTitle' name='gameTitle' type='text' value='<?php echo "$gameTitle" ?>'>
        <label for="gameDesc">Game Description:</label>
        <textarea id='gameDesc' name='gameDesc' rows="4 cols=100"><?php echo $gameDesc ?></textarea><br>
        <button type="submit">Submit Changes</button>
    </form>
</fieldset>
</body>
</html>
