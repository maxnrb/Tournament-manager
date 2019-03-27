<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/02/2019
 * Time: 09:36
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

require_once(dirname(__DIR__) . '/src/controller/Session_Controller.php');
require_once(dirname(__DIR__) . '/config/SuperAdmin_creation.php');

$sessionController = new Session_Controller();
$sessionController->checkDisconnect();

$link_login = "login.php";

echo "<h1>Home</h1>";
echo "<h3><a title='login' href='$link_login'>Login</a></h3>";
echo "<h3><a title='admin' href='admin/'>Admin</a></h3>";

if (Session_Model::getLoginStat()) {
    echo "<h3><a title='disconnect' href='?action=disconnect'>Disconnect</a></h3>";

    var_dump($_SESSION);
}