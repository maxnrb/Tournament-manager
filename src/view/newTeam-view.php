<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:08
 */

?>
<form action='' method="post" enctype="multipart/form-data">
    <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">

    <label>Team name (unique) :<br>
        <input type="text" name="name" required/><br><br>
    </label>

    <label>Picture :<br>
        <input type="file" name="logo" accept="image/png, image/jpeg" required><br>
    </label>

    <br>
    <input type="submit" value="Submit"/>
</form>