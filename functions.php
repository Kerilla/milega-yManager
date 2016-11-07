<?php

// Global requires
require_once './lib/db.php';

// Login form validation
function loginValidate($username, $password) {

    // Check if both fields are filled. Otherwise return error message
    if ($username === '' || $password === '') {
        return '<p>Var vänlig fyll i båda fälten.</p>';
        die();
    };

    // Filter input from bad hacking attempts
    $usernameSanitized = filter_var($username, FILTER_SANITIZE_STRING);
    $passwordSanitized = filter_var($password, FILTER_SANITIZE_STRING);

    if (!in_array($usernameSanitized, $usersTable[0])) {
        return "Fel användarnamn eller lösenord.";
    }

}
