<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:49
 */

require_once('DB_Model.php');

class Login_Model {
    public function getDataUser($username) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM admin WHERE username =?");
        $query->execute(array($username));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}