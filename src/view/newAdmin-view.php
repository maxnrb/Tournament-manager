<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 29/03/2019
 * Time: 10:40
 */
?>

<form action='' method="post">
        <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">

        <label>Admin username (unique) :<br>
            <input type="text" name="username" required/><br>
        </label>

        <label>Password :<br>
            <input type="password" name="password" required/><br>
        </label>

    <label>Confirm Password :<br>
        <input type="password" name ="confirmPassword" required/><br>
    </label>

    <br>
    <input type="submit" value="Submit"/>
</form>