<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/02/2019
 * Time: 09:36
 */

session_start();

$link_login = "login.php";

echo "<h1>Home</h1>";

echo "<h3><a title='login' href='$link_login'>Login</a></h3>";

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo "<h3><a title='admin' href='admin/'>Admin</a></h3>";

    //echo "<a title='disconnect' href='controller.php?action=disconnect'>Disconnect</a>";

    var_dump($_SESSION);
}