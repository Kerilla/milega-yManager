<section class="adminpanelHeader">
    <h1>Administrationspanel</h1>
    <div class="userOptions">
        <form action="./" class="logout" method="POST">
            <input type="submit" name="logout" value="Logga ut">
        </form>
    </div>
</section>
<section class="addNewUser">
    <h2>Lägg till ny användare</h2>
    <form name="addUser" action="./" method="POST">
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
    <h2>Lägg till ny administratör</h2>
    <form name="addAdmin" action="./" method="POST">
        <input type="text" name="admin_firstName" placeholder="Förnamn" required>
        <input type="text" name="admin_lastName" placeholder="Efternamn" required>
        <input type="text" name="admin_company" placeholder="Organisation">
        <input type="text" name="admin_profession" placeholder="Titel">
        <input type="email" name="admin_email" placeholder="E-post">
        <input type="text" name="admin_phone" placeholder="Telefonnummer">
        <input type="text" name="admin_username" placeholder="Användarnamn" required>
        <input type="password" name="admin_password" placeholder="Lösenord" required>
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
