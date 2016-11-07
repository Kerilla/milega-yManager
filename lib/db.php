<?php

try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=ymanager;charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo '<h1 style="text-align: center;">Unable to connect to database.</h1>';
    die($e->getMessage());
}

// Query the users table iin db for login validation
$dbstring = 'SELECT * FROM users;';
$usersTable = $db->query($dbstring)->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($usersTable);
