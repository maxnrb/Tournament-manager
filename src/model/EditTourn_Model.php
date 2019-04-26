<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:38
 */

require_once('DB_Model.php');

class EditTourn_Model {
    function getBufferTeams($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM tournament_manager.buffer_teams WHERE tournament_id=?");
        $query->execute(array($tournament_id));
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    function addBufferTeam($tournament_id, $team_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO tournament_manager.buffer_teams VALUES (:tournament_id, :team_id)");
        $query->execute(array(':tournament_id' => $tournament_id, ':team_id' => "$team_id"));
    }

    function editTournamentName($tournament_id, $newName) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("UPDATE tournament_manager.tournament SET name='$newName' WHERE tournament_id='$tournament_id'");
        $query->execute();
    }
}