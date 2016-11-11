<?php
// Global requires
require_once './lib/db.php';

// Login form validation
function loginValidate($username, $password, $dbQuery)
{
    // Check if both fields are filled. Otherwise return error message
    if ($username === '' || $password === '') {
        return '<p>Var vänlig fyll i båda fälten.</p>';
        die();
    };

    // Filter input from bad hacking attempts
    $usernameSanitized = filter_var($username, FILTER_SANITIZE_STRING);
    $passwordSanitized = filter_var($password, FILTER_SANITIZE_STRING);

    // Execute prepared statement from db.php
    $dbQuery->execute([
        ':username' => $usernameSanitized,
        ':email' => $usernameSanitized
    ]);

    // Assign variable to query result
    $userRow = $dbQuery->fetch(PDO::FETCH_ASSOC);

    // Query returns false if there are no matches for username and password
    if (!$userRow || !password_verify($password, $userRow['password'])) {
        $_SESSION['error'] = 'Fel användarnamn eller lösenord';
        return false; // If Query is false, function should also return false
    } else {

        // If query returns a user we should set a session variable for logged in and which role the user has
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['userRole'] = $userRow['roleID'];
        return true;
    }

}

function checkLogin()
{
    session_start();
    return isset($_SESSION['isLoggedIn']);
}
