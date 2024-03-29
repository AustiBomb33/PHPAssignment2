<?php

session_start();
$login = isset($_SESSION['username']);
if(!$login){
    session_destroy();
}

$dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");

//are we adding a new game?
if (!empty($_POST['newGame']) && !empty($_POST['newGameDesc'])){
    $gameTitles = [];
    foreach (getAllGames($dbconn) as $game){
        array_push($gameTitles, $game[0]);
    }

    $newGameName = $_POST['newGame'];
    if(!in_array($newGameName,$gameTitles )) {
        $query = 'insert into games (gameTitle, gameDesc) values (:title, :desc)';
        $stmt = $dbconn->prepare($query);
        $stmt->bindParam(':title', $newGameName);
        $stmt->bindParam(':desc', $_POST['newGameDesc']);
        $stmt->execute();
    }
}

//are we removing a game?
if(!empty($_POST['delGame'])){
    $delGame = $_POST['delGame'];
    $query = "delete from games where gameTitle = :title";
    $stmt = $dbconn->prepare($query);
    $stmt->bindParam(':title', $_POST['delGame']);
    $stmt->execute();
}

function getAllGames($dbconn){
    $query = 'select * from games';
    $stmt = $dbconn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Games Directory</title>
    <link rel="stylesheet" href="styles.css">
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
<!--form to add new game-->
<?php
if($login){
echo '<form action="home.php" method="post">
    <fieldset>
        <h2>Add a Game to the Database</h2>
        <label for="newGame">Add a game:<input type="text" name="newGame"></label>
        <label for="newGameDesc" class="desc">enter the new game\'s description:<input type="text" name="newGameDesc"></label>
        <label for="image">Choose an image <input name="image" type="file" accept="image/jpeg"></label>
        <button type="submit">Submit new game</button>
    </fieldset>
</form>
';
}
?>
<fieldset class="invisible">
    <h2>List of all Games</h2>
    <table>
        <th>
            Game Title
        </th>
        <th>
            Game Description
        </th>
        <?php
        if($login){
            echo "<th>Edit</th><th>Delete</th>";
       }
        $gamesTable = getAllGames($dbconn);

        foreach ($gamesTable as $game){
                echo "
                <tr>
                <td>$game[0]</td>
                <td>$game[1]</td>";

                if($login){
                    echo "<td><a href='edit.php?name=$game[0]'>X</a></td>
                <td><a href='delete.php?name=$game[0]' onclick='return confirm(\"Are you sure you want to remove $game[0] ? \")'>X</a></td></tr>";
                }
            }
        ?>
    </table>
</fieldset>
</body>
</html>