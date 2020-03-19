<?php
$dbconn = new PDO("mysql:host=172.31.22.43;dbname=Austin_A1099028", "Austin_A1099028", "R4Fr-bgQ-_");

$gameTitle = $_GET['name'];

$query = "delete from games where gameTitle = '$gameTitle'";
$stmt = $dbconn->prepare($query);
$stmt->execute();
$dbconn = null;
header("location: http://172.31.22.43/~Austin_A1099028/Assignment2/home.php");