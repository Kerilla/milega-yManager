<?php
    require_once './functions.php';
    $loggedIn = checkLogin();

    // Check if user has initiated logout sequence
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        logout();
    }

?>
<!DOCTYPE html>
<html lang="sv">
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
    <?php
        require_once './template/header.php'; // Get the header

        if (!$loggedIn) {
            include './template/loginform.php'; // Send to login page if user is not logged in

        } elseif ($_SESSION['userRole'] === '1') {
            include './template/adminpanel.php'; // If user has admin role, send to adminpanel

        } elseif ($_SESSION['userRole'] === '2') {
            include './template/form.php'; } // If user has user role, send to form

        require_once './template/footer.php' // Get the footer
    ?>
    </main>
</body>
</html>
