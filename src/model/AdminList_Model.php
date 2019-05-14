<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25/04/2019
 * Time: 14:24
 */

require_once('ConnectionDB_Model.php');

class AdminList_Model {
    private $adminList = array();

    /**
     * @return array
     */
    public function getAdminList()
    {
        return $this->adminList;
    }

    public function loadAllAdmin() {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT admin_id, username FROM admin");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function hydrate($admins = array()) {
        if ($admins != null) {
            foreach ($admins as $admin) {
                $this->pushAdmin($admin);
            }
        }
    }

    protected function pushAdmin($admin) {
        $this->adminList[ $admin['admin_id'] ] = Admin_Model::getFromArray($admin);
    }

    public function fetchAllAdmins() {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT username, admin_id FROM admin");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}