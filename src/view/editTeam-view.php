<?php ?>

<form action="" method="POST">
    <input type="hidden" name="CSRF_token" value="<?php if (isset($CSRF_token)) { echo $CSRF_token; } ?>">
    <input type="hidden" name="edition_id" value="<?php if (isset($edit_team_id)) { echo $edit_team_id; } ?>">


    <label>Team name (unique) :<br>
        <input type="text" name="name" value="<?php if (isset($name)) { echo $name; } ?>"><br><br>
    </label>

    <label>Picture :<br>
        <input type="file" name="picturePath" accept="image/png, image/jpeg" value="<?php if (isset($picturePath)) { echo $picturePath; } ?>"><br>
    </label>

    <br>
    <input type="submit" value="Edit"/>
</form>
<?php