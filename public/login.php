<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 22/03/2019
 * Time: 14:13
 */

include_once(dirname(__DIR__) . '/src/controller/Login_Controller.php');

$loginController = new Login_Controller();
$loginController->controlForm();