<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 22/03/2019
 * Time: 14:13
 */

require_once(dirname(__DIR__) . '/src/controller/Login_Controller.php');
require_once(dirname(__DIR__) . '/src/model/UtilFunc_Model.php');
require_once(dirname(__DIR__) . '/src/model/Session_Model.php');

if(Session_Model::getLoginStat()) {
    UtilFunc_Model::redirect('/Tournament-manager/public/admin/');
}

$loginController = new Login_Controller();
$loginController->controlForm();