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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sanitize.css/2.0.0/sanitize.min.css">
    <link rel="stylesheet" href="./css/style.css">
	<title>Milega yManager</title>
</head>
<body>
    <main class="mainWrapper">
        <header class="mainHeader">
            <a href="./"><h1 class="logo">Milega</h1></a>
        </header>
        <section class="mainContent">
            <form action="index.php" name="loginForm" method="POST">
                <input type="text" name="username">
                <input type="password" name="password">
                <input type="submit" value="Logga in">
            </form>
        </section>
    </main>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($validation !== TRUE) {
                echo $validation;
            }
        }
    ?>
</body>
</html>
