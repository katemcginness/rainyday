<?php
$host = "rainyday.katemcginness.com";
$username = "katemcginness";
$password = "Llama2021!";
$dbname = "rainyday";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

);

try{
    /* Attempt to connect to MySQL database */
    $pdo_connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>