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
    if (!$userRow || !password_verify($passwordSanitized, $userRow['password'])) {
        $_SESSION['error'] = 'Fel användarnamn eller lösenord';
        return false; // If Query is false, function should also return false
    } else {

        // If login is successful we should set a session variable for logged in and which role the user has
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['userRole'] = $userRow['roleID'];
        return true;
    }

}

// Check if user is logged in and start a session
function checkLogin()
{
    session_start();
    return isset($_SESSION['isLoggedIn']);
}

// Function for logging out
function logout()
{
    $_SESSION = [];
    session_destroy();
    header('Location: ./');
    die();
}

// Validate the input fields when adding user
function userAddFormValidate($firstName,$lastName,$company,$profession,$email,$phone,$username,$password)
{
    $valid = true;

    if ($firstName === '' || $lastName === '' || $username === '' || $password === '') {
        $_SESSION['error'] = 'Var vänlig fyll i alla obligatoriska fält';
        $valid = false;
        die();
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'E-postadressen är inte rätt ifylld.';
        $valid = false;
        die();
    }

    $valid = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'company' => $company,
        'profession' => $profession,
        'email' => $email,
        'phone' => $phone,
        'username' => $username,
        'password' => $password
    ];

    return $valid;

}

// Function for add a new regular user
function addNewUser($db, $statement, $userDataArray)
{
    $statement->execute([
        ':firstName' => $userDataArray['firstName'],
        ':lastName' => $userDataArray['lastName'],
        ':company' => $userDataArray['company'],
        ':profession' => $userDataArray['profession'],
        ':email' => $userDataArray['email'],
        ':phone' => $userDataArray['phone'],
        ':username' => $userDataArray['username'],
        ':password' => password_hash($userDataArray['password'], PASSWORD_BCRYPT)
    ]);
}
