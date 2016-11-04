<?php

try {
    $db = new PDO('mysql:host=localhost;port=3306;dbname=ymanager;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
    echo '<h1 style="text-align: center;">Unable to connect to database.</h1>';
    die($e->getMessage());
}
