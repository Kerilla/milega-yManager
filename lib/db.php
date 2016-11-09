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

// Prepare Query for user validation
$userQueryString = 'SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1;';
$userQuery = $db->prepare($userQueryString);
