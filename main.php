<?php

if (!$_SESSION['isLoggedIn']) {
    include './template/loginform.php'; // Send to login page if user is not logged in
} elseif ($_SESSION['userRole'] === 1) {
    include './template/adminpanel.php'; // If user has admin role, send to adminpanel
} elseif ($_SESSION['userRole'] === 2) {
    include './template/form.php'; // If user has user role, send to form
}
