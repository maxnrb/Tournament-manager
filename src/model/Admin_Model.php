<?php

require_once('ConnectionDB_Model.php');

class Admin_Model {
    private $admin_id;
    private $name;

    public static function getFromArray($adminInfo = array()) {
        $admin = new self();
        $admin->hydrate($adminInfo);

        return $admin;
    }

    public static function getByID($team_id) {
        $admin = new self();

        if( !$admin->loadByID($team_id) ) {
            $admin = null;
        }

        return $admin;
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * @param mixed $admin_id
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    protected function loadByID($admin_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM admin WHERE admin_id=$admin_id");
        $query->execute();
        $admin = $query->fetch(PDO::FETCH_ASSOC);

        if($admin != null) {
            $this->hydrate($admin);
            return true;
        } else {
            return false;
        }
    }

    public function hydrate(array $admin) {
        if(isset($admin['admin_id'])) {
            $this->setAdminId($admin['admin_id']);
        }

        if(isset($admin['username'])) {
            $this->setName($admin['username']);
        }
    }

    public static function deleteById($admin_id) {
        $dbModel = new ConnectionDB_Model();

        $dbModel->deleteLineById($admin_id, 'admin');
    }

    public static function createAdmin($username, $hash) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO admin (username, password) VALUES (:username, :hashPassword)");
        return $query->execute(array(':username' => $username, ':hashPassword' => "$hash"));
    }

    public static function verifyAvailabilityUsername($username) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT count(*) FROM admin WHERE username =?");
        $query->execute(array($username));
        $data = $query->fetch();

        if($data['count(*)'] != 0) {        // User name already used in bdd
            return false;
        } else {
            return true;
        }
    }

    public static function editUsername($admin_id, $newName) {
        $dbModel = new ConnectionDB_Model();

        return $dbModel->editProperty($admin_id, 'admin', 'username', $newName);
    }

    public static function editPassword($admin_id, $newPassword) {
        $dbModel = new ConnectionDB_Model();

        return $dbModel->editProperty($admin_id, 'admin', 'password', $newPassword);
    }
}