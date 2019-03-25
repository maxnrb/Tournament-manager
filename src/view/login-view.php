<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:48
 */

try {
    $CSRF_token = bin2hex(random_bytes(32));
    $_SESSION['CSRF_token'] = $CSRF_token;
} catch (Exception $e) {
    // TODO : Add action
}


?>
<h1>Login :</h1>
<form action='' method='post'>
    <input type='hidden' name='CSRF_token' value='<?php echo $CSRF_token; ?>'>

    <label>Username :<br>
        <input type='text' name='username' required/><br>
    </label>

    <label>Password :<br>
        <input type='password' pattern='.{5,}' name='password' id='password' title='6 characters min.' required/><br>
    </label>

    <br>
    <input type='submit' value='Submit'/>
</form>