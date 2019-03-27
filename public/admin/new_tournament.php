<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 23:37
 */

session_start();

try {
    $CSRF_token = bin2hex(random_bytes(32));
    $_SESSION['CSRF_token'] = $CSRF_token;
} catch (Exception $e) {
    // TODO : Add action
}

    ?>
    <form action='' method="post">
        <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">

        <label>Tournament name (unique) :<br>
            <input type="text" name="nom" required/><br>
        </label>

        <label>Number of teams :<br>
            <input type="number" min="0" max="50" name="nb_teams" required/><br>
        </label>

        <br>
        <input type="submit" value="Submit"/>
    </form>
    <?php