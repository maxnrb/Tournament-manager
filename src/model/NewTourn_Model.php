<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 23:45
 */

require_once('DB_Model.php');

class NewTourn_Model {
    public function verifyAvailabilityName($name) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT count(*) FROM tournament WHERE name =?");
        $query->execute(array($name));
        $data = $query->fetch();

        if($data['count(*)'] != 0) {        // Tournament name already used in bdd
            return false;
        } else {
            return true;
        }
    }

    public function createNewTournament($name, $nb_teams) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare('INSERT INTO tournament (name, nb_teams) VALUES (:name, :nb_teams)');
        $query->execute(array(':name' => "$name", ':nb_teams' => "$nb_teams"));
    }

    public function getTournaments() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM tournament ORDER BY tournament_id DESC");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if(!$data) {
            return $data;
        } else {
            return null;
        }
    }
}