<?php

require_once './functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = loginValidate($_POST['username'], $_POST['password']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible">
	<title>Milega yManager</title>
</head>
<body>
    <form action="index.php" name="loginForm" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="submit" value="Logga in">
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($validation !== TRUE) {
                echo $validation;
            }
        }
    ?>
</body>
</html>
