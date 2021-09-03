<?php
$host = "localhost";
$username = "id17519704_rainyuser";
$password = "i}Ql\D3vKBmyl2)B";
$dbname = "id17519704_rainy";
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