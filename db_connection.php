<?php
// db-connection.php

try {
    $host = 'localhost';
    $dbname = 'adyemsgodlovedb';
    $username = 'adyems9';
    $password = '#adyems123AD';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>