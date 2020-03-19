<?php

$dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");

//are we adding a new game?
if (!empty($_POST['newGame']) && !empty($_POST['newGameDesc'])){
    $gameTitles = [];
    foreach (getAllGames($dbconn) as $game){
        array_push($gameTitles, $game[0]);
    }

    if(!in_array($_POST['newGame'],$gameTitles )) {
        $query = 'insert into games (gameTitle, gameDesc) values (:title, :desc)';
        $stmt = $dbconn->prepare($query);
        $stmt->bindParam(':title', $_POST['newGame']);
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
    <a href="index.html">About Page</a>
    <a href="home.php">Home</a>
</div>
<!--form to add new game-->
<?php
echo "<form action='home.php' method='post'>";
?>
    <fieldset>
        <h2>Add a Game to the Database</h2>
        <label for="newGame">Add a game:<input type="text" name="newGame"></label>
        <label for="newGameDesc" class="desc">enter the new game's description:<input type="text" name="newGameDesc"></label>
        <button type="submit">Submit new game</button>
    </fieldset>
</form>
<?php
echo "<form action=\"home.php\" method=\"post\">";
?>
    <fieldset>
        <h2>Remove a Game From the Database</h2>
        <label for="delGame">
            <select name="delGame">
                <?php
                $gamesTable = getAllGames($dbconn);
                foreach($gamesTable as $game){
                    echo "<option>$game[0]</option>";
                }
                ?>
            </select>
        </label>
        <button type="submit">Delete Game</button>
    </fieldset>
</form>
<fieldset class="invisible">
    <h2>List of all Games</h2>
    <table>
        <th>
            Game Title
        </th>
        <th>
            Game Description
        </th>
        <th>
            Edit
        </th>
        <th>
            Delete
        </th>
        <?php
            foreach ($gamesTable as $game){
                echo "
                <tr><td>$game[0]</td>
                <td>$game[1]</td>
                <td><a href='edit.php?name=$game[0]'>X</a></td>
                <td><a href='delete.php?name=$game[0]' onclick='confirm('Are you sure you want to remove $game[0]?')'>X</a></td></tr>";
            }
        ?>
    </table>
</fieldset>
</body>
</html>