<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:37
 */

require_once('DB_Model.php');

class TournamentList_Model {
    public function fetchAllTournaments() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM tournament");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}