<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 28/03/2019
 * Time: 09:00
 */

class NewAdmin_Model
{

    public function createAdmin($username, $hash) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO admin (username, password) VALUES (:username, :hashPassword)");
        $query->execute(array(':username' => $username, ':hashPassword' => "$hash"));
    }


    public function getDataUser($username) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM admin WHERE username =?");
        $query->execute(array($username));
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}