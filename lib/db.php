<?php

$connectionString = 'mysql:host=localhost;port=3306;dbname=ymanager;charset=utf8';
$username = 'root';
$password = '';

try {
    $db = new PDO($connectionString, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<h1 style="text-align: center;">Unable to connect to database.</h1>';
    die($e->getMessage());
}

// Query the users table iin db for login validation
$dbstring = 'SELECT * FROM users;';
$usersTable = $db->query($dbstring)->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($usersTable);
