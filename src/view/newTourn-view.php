<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 08:37
 */

?>
<form action='' method="post">
    <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">

    <label>Tournament name (unique) :<br>
        <input type="text" name="name" required/><br>
    </label>

    <label>Number of teams :<br>
        <input type="number" min="2" max="50" name="nb_teams" required/><br>
    </label>

    <br>
    <input type="submit" value="Submit"/>
</form>