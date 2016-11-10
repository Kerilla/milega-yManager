<?php

require '../lib/db.php';

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
        <input type="text" name="firstName" placeholder="Förnamn" required>
        <input type="text" name="lastName" placeholder="Efternamn" required>
        <input type="text" name="company" placeholder="Organisation">
        <input type="text" name="profession" placeholder="Titel">
        <input type="email" name="email" placeholder="E-post">
        <input type="text" name="phone" placeholder="Telefonnummer">
        <input type="text" name="username" placeholder="Användarnamn" required>
        <input type="password" name="password" placeholder="Lösenord" required>
        <input type="submit" value="Lägg till">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                if (!userAddFormValidate($_POST['firstName'], $_POST['lastName'], $_POST['company'], $_POST['profession'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password'])) {
                    echo '<h4 class="errormessage">'.$_SESSION['error'].'</h4>';
                    unset($_SESSION['error']);
                }  else {
                    $inputArray = userAddFormValidate($_POST['firstName'], $_POST['lastName'], $_POST['company'], $_POST['profession'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password']);
                    if (!addNewUser($db, $userAdd, $inputArray)) {
                        echo '<h4 class="errormessage">Någonting gick fel. Var vänlig försök igen.</h4>';
                    } else {
                        echo "Användaren lades till i databasen.";
                    }
                }
            }
        ?>
    </form>
</section>

<section class="addNewAdmin">
    <h1>Lägg till ny administratör</h1>
    <form action="adminpanel.php" method="POST">
        <input type="text" name="firstName" placeholder="Förnamn">
        <input type="text" name="lastName" placeholder="Efternamn">
        <input type="text" name="company" placeholder="Organisation">
        <input type="text" name="profession" placeholder="Titel">
        <input type="email" name="email" placeholder="E-post">
        <input type="text" name="phone" placeholder="Telefonnummer">
        <input type="text" name="username" placeholder="Användarnamn">
        <input type="password" name="password" placeholder="Lösenord">
        <input type="submit" value="Lägg till">
    </form>
</section>
