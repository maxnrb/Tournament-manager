<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require_once('DB_Model.php');

class TeamList_Model {
    public function fetchAllTeams() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM team");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}