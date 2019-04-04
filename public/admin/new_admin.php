<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 28/03/2019
 * Time: 08:17
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/Newadmin_Controller.php');

$newAdminController = new Newadmin_Controller();
$newAdminController->controlForm();

