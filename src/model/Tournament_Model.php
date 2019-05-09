<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:42
 */

require_once('DB_Model.php');

class Tournament_Model {
    private $tournament_id;
    private $name;
    private $nb_teams;
    private $status;

    public function __construct() {}

    public static function getByID($tournament_id) {
        $tournament = new self();
        $tournament->loadByID($tournament_id);

        return $tournament;
    }

    public static function getByName($name) {
        // TODO To implement
    }

    public static function loadFromArray($tournamentInfo = array()) {
        $tournament = new self();
        $tournament->hydrate($tournamentInfo);

        return $tournament;
    }

    protected function loadByID($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM tournament WHERE tournament_id=$tournament_id");
        $query->execute();
        $tournament = $query->fetch(PDO::FETCH_ASSOC);

        $this->hydrate($tournament);
    }

    public function hydrate(array $tournament) {
        if(isset($tournament['tournament_id'])) {
            $this->setTournamentId($tournament['tournament_id']);
        }

        if(isset($tournament['name'])) {
            $this->setName($tournament['name']);
        }

        if(isset($tournament['nb_teams'])) {
            $this->setNbTeams($tournament['nb_teams']);
        }

        if(isset($tournament['status'])) {
            $this->setStatus($tournament['status']);
        }

    }

    public function setTournamentId($tournament_id) { $this->tournament_id = $tournament_id; }
    public function setName($name) { $this->name = $name; }
    public function setNbTeams($nb_teams) { $this->nb_teams = $nb_teams; }
    public function setStatus($status) { $this->status = $status; }

    public function getTournamentId() { return $this->tournament_id; }
    public function getName() { return $this->name; }
    public function getNbTeams() { return $this->nb_teams; }
    public function getStatus() { return $this->status; }


    public static function editTournamentName($tournament_id, $newName) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("UPDATE tournament SET name='$newName' WHERE tournament_id='$tournament_id'");
        $query->execute();
    }

    public static function getNbTeamsTournament($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT nb_teams FROM tournament WHERE tournament_id='$tournament_id'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['nb_teams'];
    }

    public static function getStatusByID($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT status FROM tournament WHERE tournament_id='$tournament_id'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['status'];
    }

    private static function getMsgByStatus($status) {
        switch ($status) {
            case 0 :
                return array("msg" => "Add Teams", "btn" => "info");
                break;
            case 1 :
                return array("msg" => "Generate Days", "btn" => "danger");
                break;
            case 2 :
                return array("msg" => "Finished", "btn" => "success");
                break;
            case $status >= 11 :
                $msg = "In Progress : D" . ($status-10);
                return array("msg" => "$msg", "btn" => "warning");
                break;
        }

        return null;
        // 0 : Tournament created -> add teams
        // 1 : Max teams added -> ready to generate
        // 2 : Tournament finished
        //
        // 11 -> Inf : n-10 = next day to play
    }

    public function getStatusMsg() {
        return self::getMsgByStatus($this->status);
    }

    public static function getTournamentStatusMsg($tournament_id) {
        return self::getMsgByStatus( self::getStatusByID($tournament_id) );
    }

    public static function incrementStatus($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT status FROM tournament WHERE tournament_id='$tournament_id'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $status = $data['status'];
        $nbDays = Day_Model::getNbDays($tournament_id);

        switch ($status) {
            case 0 :
                $status++;
                break;
            case 1 :
                $status = 11;
                break;
            case $status > 10 AND $status-10 < $nbDays :
                $status++;
                break;
            case $status-10 == $nbDays :
                $status = 2;
                break;
        }

        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("UPDATE tournament SET status='$status' WHERE tournament_id='$tournament_id'");
        $query->execute();
    }

    public static function getGenerationStat($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT status FROM tournament WHERE tournament_id='$tournament_id'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['generate'];
    }

    public static function verifyAvailabilityName($name) {
        $dbModel = new DB_Model();

        return $dbModel->verifyAvailabilityName($name, 'tournament');
    }

    public static function addNewTournament($name, $nb_teams) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare('INSERT INTO tournament (name, nb_teams) VALUES (:name, :nb_teams)');
        return $query->execute(array(':name' => "$name", ':nb_teams' => "$nb_teams"));
    }

    public static function deleteById($tournament_id) {
        $dbModel = new DB_Model();

        return $dbModel->deleteLineById($tournament_id, 'tournament');
    }
}