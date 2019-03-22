<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 22/03/2019
 * Time: 14:13
 */

include "../config/bddInfo.php";

session_start();

function badPassword() { echo "Mot de passe incorrect !<br><br>"; }
function loginNotFound() { echo "L'utilisateur n'existe pas !<br><br>"; }

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo "You are already connected<br>";
} else {
    if(isset($_GET['alert']) ) {
        $_GET['alert']();
    }

    try {
        $token = bin2hex(random_bytes(32));
    } catch (Exception $e) {
        // TODO : Add action
    }
    $_SESSION['csrf_token'] = $token;

    echo bddInfo::getDbName();

    ?>
    <h1>Login :</h1>
    <form action=".php?form=login" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

        <label>Username :<br>
            <input type="text" name="login" required/><br>
        </label>

        <label>Password :<br>
            <input type="password" pattern=".{6,}" name="password" id="password" title="6 characters min." required/><br>
        </label>

        <br>
        <input type="submit" value="Submit"/>
    </form>
    <?php
}