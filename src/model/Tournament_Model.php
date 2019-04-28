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
    }

    public function setTournamentId($tournament_id) { $this->tournament_id = $tournament_id; }
    public function setName($name) { $this->name = $name; }
    public function setNbTeams($nb_teams) { $this->nb_teams = $nb_teams; }

    public function getTournamentId() { return $this->tournament_id; }
    public function getName() { return $this->name; }
    public function getNbTeams() { return $this->nb_teams; }


    public static function editTournamentName($tournament_id, $newName) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("UPDATE tournament SET name='$newName' WHERE tournament_id='$tournament_id'");
        $query->execute();
    }
}