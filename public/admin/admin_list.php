<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25/04/2019
 * Time: 09:49
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/AdminList_Controller.php');

$AdminList_Controller = new AdminList_Controller();
$AdminList_Controller->printAdminList();