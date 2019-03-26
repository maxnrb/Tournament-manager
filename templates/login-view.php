<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:48
 */
?>

<h1>Login :</h1>
<form action='' method='post'>
    <input type='hidden' name='CSRF_token' value='<?php echo $CSRF_token; ?>'>

    <label>Username :<br>
        <input type='text' name='username' required/><br>
    </label>

    <label>Password :<br>
        <input type='password' pattern='.{5,}' name='password' id='password' title='5 characters min.' required/><br>
    </label>

    <br>
    <input type='submit' value='Submit'/>
</form>