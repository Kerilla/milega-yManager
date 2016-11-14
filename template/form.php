<section class="adminpanelHeader">
    <h1>Välkommen <?php $loggedInUser['firsName'].' '.$loggedInUser['lastName']; ?></h1>
    <div class="userOptions">
        <form action="./" class="logout" method="POST">
            <input type="submit" name="logout" value="Logga ut">
        </form>
    </div>
</section>
