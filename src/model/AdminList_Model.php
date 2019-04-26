<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25/04/2019
 * Time: 14:24
 */
require_once('DB_Model.php');


class AdminList_Model
{
    public function fetchAllAdmins() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT username, admin_id FROM admin");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}