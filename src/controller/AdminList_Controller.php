<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25/04/2019
 * Time: 14:14
 */

require(dirname(__DIR__) . '/model/AdminList_Model.php');


class AdminList_Controller extends AdminList_Model
{
    private $AdminList_Model;

    public function __construct() {
        $this->AdminList_Model = new AdminList_Model();
    }

    public function printAdminList() {
        $admins = $this->AdminList_Model->fetchAllAdmins();

        if ($admins != null) {
            require_once(dirname(__DIR__) . '/view/adminList-view.php');
        }
    }
}