<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 16:14
 * @param string $password
 */

require_once(dirname(__DIR__) . '/src/model/ConnectionDB_Model.php');

function createSuperAdmin($password = '123456') {
    $dbModel = new DB_Connection_Model();

    $query = $dbModel->getConnection()->prepare("SELECT * FROM admin WHERE username =?");
    $query->execute(array('admin'));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    var_dump($data);

    if(!$data) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = $dbModel->getConnection()->prepare("INSERT INTO admin (username, password) VALUES (:username, :hashPassword)");
        $query->execute(array(':username' => "admin", ':hashPassword' => "$hash"));
    }
}