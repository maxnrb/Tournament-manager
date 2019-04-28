<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/04/2019
 * Time: 20:31
 */

class Buffer_Model {
    private $tournament_id;
    private $team_id;

    public function getTournamentId() { return $this->tournament_id; }
    public function getTeamId() { return $this->team_id; }

    public function setTournamentId($tournament_id) { $this->tournament_id = $tournament_id; }
    public function setTeamId($team_id) { $this->team_id = $team_id; }

    public static function loadFromArray($bufferInfo = array()) {
        $buffer = new self();
        $buffer->hydrate($bufferInfo);

        return $buffer;
    }

    public function hydrate(array $buffer) {
        if(isset($buffer['tournament_id'])) {
            $this->setTournamentId($buffer['tournament_id']);
        }

        if(isset($buffer['team_id'])) {
            $this->setTeamId($buffer['team_id']);
        }
    }

    public static function addBufferTeam($tournament_id, $team_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO buffer_teams VALUES (:tournament_id, :team_id)");
        $query->execute(array(':tournament_id' => $tournament_id, ':team_id' => "$team_id"));
    }

    public static function getNbAddTeam($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT COUNT(*) AS nb FROM buffer_teams WHERE tournament_id='$tournament_id'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['nb'];
    }
}