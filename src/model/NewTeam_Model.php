<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:04
 */

require_once('DB_Model.php');

class NewTeam_Model {
    public function verifyAvailabilityName($name) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT count(*) FROM team WHERE name =?");
        $query->execute(array($name));
        $data = $query->fetch();

        if($data['count(*)'] != 0) {        // Team name already used in bdd
            return false;
        } else {
            return true;
        }
    }

    public function createNewTeam($name, $picture_path) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare('INSERT INTO team (name, picture_path) VALUES (:name, :picture_path)');
        $query->execute(array(':name' => "$name", ':picture_path' => "$picture_path"));
    }
}