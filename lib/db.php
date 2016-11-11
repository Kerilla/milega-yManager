<?php

$connectionString = 'mysql:host=localhost;port=3306;dbname=ymanager;charset=utf8';
$dbUser = 'root';
$dbPassword = '';

try {
    $db = new PDO($connectionString, $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<h1 style="text-align: center;">Unable to connect to database.</h1>';
    die($e->getMessage());
}

// Prepare Query for user validation
$userQueryString = 'SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1;';
$userQuery = $db->prepare($userQueryString);

// Prepare Query for adding regular users
$userAddString = <<<EOT
INSERT INTO users (roleID,firstName,lastName,company,profession,email,phone,username,password)
VALUES (2,:firstName,:lastName,:company,:profession,:email,:phone,:username,:password);
EOT;

$userAdd = $db->prepare($userAddString);

// Prepare Query for adding new admin user
$adminAddString = <<<EOT
INSERT INTO users (roleID,firstName,lastName,company,profession,email,phone,username,password)
VALUES (1,:firstName,:lastName,:company,:profession,:email,:phone,:username,:password);
EOT;

$adminAdd = $db->prepare($adminAddString);
