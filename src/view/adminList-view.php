<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25/04/2019
 * Time: 14:16
 */
?>

<table class="orders_details" width="40%" border="0" cellspacing="0" cellpadding="5" style="text-align:center">
    <tr>
        <th>Username</th>
        <th>Id Admin</th>
    </tr>

<?php

foreach ($admins as $admin) {
    foreach ($admin as $cle => $value) {
        echo "<td>" . $value . "</td>";
    }

    $admin_id = $admin['admin_id'];
    echo "<td>";
 //   echo '<a href="view-admin.php?action=deleteStudent&id=' . $admin_id . '" style="text-decoration: none">Suppr </a>' .
    echo '<a href="edit_admin.php?action=getStudent&id=' . $admin_id . '" style="text-decoration: none"> Edit</a>';

    echo "</td>" . "</tr>";
}