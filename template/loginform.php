    <section class="mainContent">
        <form action="index.php" name="loginForm" method="POST">
            <input type="text" name="username" placeholder="Användarnamn" required>
            <input type="password" name="password" placeholder="Lösenord" required>
            <input type="submit" value="Logga in">
            <?php
            if (isset($_POST['username']) && isset($_POST['password'])) {

                // Login validation function will return false if fail and true if success
                $validation = loginValidate($_POST['username'], $_POST['password'], $userQuery);

                if ($validation === false) {

                    // If false, output error message after form
                    echo '<h4 style="text-align: center; color: var(--red);">Fel användarnamn eller lösenord.</h4>';
                } else {

                    // If login is successful, redirect back to index.php
                    header('Location: ./index.php');

                }

            }
            ?>
        </form>
    </section>
