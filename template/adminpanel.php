<?php

require '../lib/db.php'; // Remove when adding it to the regular flow

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

?>
<section class="addNewUser">
    <h1>Lägg till ny användare</h1>
    <form action="adminpanel.php" method="POST">
        <input type="text" name="user_firstName" placeholder="Förnamn" required>
        <input type="text" name="user_lastName" placeholder="Efternamn" required>
        <input type="text" name="user_company" placeholder="Organisation">
        <input type="text" name="user_profession" placeholder="Titel">
        <input type="email" name="user_email" placeholder="E-post">
        <input type="text" name="user_phone" placeholder="Telefonnummer">
        <input type="text" name="user_username" placeholder="Användarnamn" required>
        <input type="password" name="user_password" placeholder="Lösenord" required>
        <input type="submit" value="Lägg till">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_firstName'])){
                if (!userAddFormValidate($_POST['user_firstName'], $_POST['user_lastName'], $_POST['user_company'], $_POST['user_profession'], $_POST['user_email'], $_POST['user_phone'], $_POST['user_username'], $_POST['user_password'])) {
                    echo '<h4 class="errormessage">'.$_SESSION['error'].'</h4>';
                    unset($_SESSION['error']);
                }  else {
                    $inputArray = userAddFormValidate($_POST['user_firstName'], $_POST['user_lastName'], $_POST['user_company'], $_POST['user_profession'], $_POST['user_email'], $_POST['user_phone'], $_POST['user_username'], $_POST['user_password']);
                    addNewUser($db, $userAdd, $inputArray);
                    echo "Användaren lades till i databasen.";
                }
            }
        ?>
    </form>
</section>

<section class="addNewAdmin">
    <h1>Lägg till ny administratör</h1>
    <form action="adminpanel.php" method="POST">
        <input type="text" name="admin_firstName" placeholder="Förnamn">
        <input type="text" name="admin_lastName" placeholder="Efternamn">
        <input type="text" name="admin_company" placeholder="Organisation">
        <input type="text" name="admin_profession" placeholder="Titel">
        <input type="email" name="admin_email" placeholder="E-post">
        <input type="text" name="admin_phone" placeholder="Telefonnummer">
        <input type="text" name="admin_username" placeholder="Användarnamn">
        <input type="password" name="admin_password" placeholder="Lösenord">
        <input type="submit" value="Lägg till">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_firstName'])){
                if (!userAddFormValidate($_POST['admin_firstName'], $_POST['admin_lastName'], $_POST['admin_company'], $_POST['admin_profession'], $_POST['admin_email'], $_POST['admin_phone'], $_POST['admin_username'], $_POST['admin_password'])) {
                    echo '<h4 class="errormessage">'.$_SESSION['error'].'</h4>';
                    unset($_SESSION['error']);
                }  else {
                    $inputArray = userAddFormValidate($_POST['admin_firstName'], $_POST['admin_lastName'], $_POST['admin_company'], $_POST['admin_profession'], $_POST['admin_email'], $_POST['admin_phone'], $_POST['admin_username'], $_POST['admin_password']);
                    addNewUser($db, $adminAdd, $inputArray);
                    echo "Administratören lades till i databasen.";
                }
            }
        ?>
    </form>
</section>
