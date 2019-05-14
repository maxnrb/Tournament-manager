<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/04/2019
 * Time: 18:56
 */

require_once('ConnectionDB_Model.php');

class Team_Model {
    private $team_id;
    private $name;
    private $picture_path;
    private $nb_visits;

    public function __construct() {}

    public static function getByID($team_id) {
        $team = new self();

        if( !$team->loadByID($team_id) ) {
            $team = null;
        }

        return $team;
    }

    public static function getByName($name) {
        // TODO To implement
    }

    public static function loadFromArray($teamInfo = array()) {
        $team = new self();
        $team->hydrate($teamInfo);

        return $team;
    }

    protected function loadByID($team_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM team WHERE team_id=$team_id");
        $query->execute();
        $team = $query->fetch(PDO::FETCH_ASSOC);

        if($team != null) {
            $this->hydrate($team);
            return true;
        } else {
            return false;
        }
    }

    public function hydrate(array $team) {
        if(isset($team['team_id'])) {
            $this->setTeamId($team['team_id']);
        }

        if(isset($team['name'])) {
            $this->setName($team['name']);
        }

        if(isset($team['picture_path'])) {
            $this->setPicturePath($team['picture_path']);
        }

        if(isset($team['nb_visits'])) {
            $this->setNbVisits($team['nb_visits']);
        }
    }

    public function getTeamId() { return $this->team_id; }
    public function getName() { return $this->name; }
    public function getPicturePath() { return $this->picture_path; }
    public function getNbVisits() { return $this->nb_visits; }

    public function setTeamId($team_id) { $this->team_id = $team_id; }
    public function setName($name) { $this->name = $name; }
    public function setPicturePath($picture_path) { $this->picture_path = $picture_path; }
    public function setNbVisits($nb_visits) { $this->nb_visits = $nb_visits; }

    public static function getTeamNameByID($team_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT name FROM team WHERE team_id=$team_id");
        $query->execute();
        $team = $query->fetch(PDO::FETCH_ASSOC);

        return $team['name'];
    }

    public static function getPicturePathByID($team_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT picture_path FROM team WHERE team_id=$team_id");
        $query->execute();
        $team = $query->fetch(PDO::FETCH_ASSOC);

        return $team['picture_path'];
    }

    public static function verifyAvailabilityName($name) {
        $dbModel = new ConnectionDB_Model();

        return $dbModel->verifyAvailabilityName($name, 'team');
    }

    public static function addNewTeam($name, $picture_path) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare('INSERT INTO team (name, picture_path) VALUES (:name, :picture_path)');
        $query->execute(array(':name' => "$name", ':picture_path' => "$picture_path"));
    }

    public static function editTeamName($team_id, $newName) {
        $dbModel = new ConnectionDB_Model();

        $dbModel->editProperty($team_id, 'team', 'name', $newName);
    }

    public static function editPicturePath($team_id, $absolutePath) {
        $dbModel = new ConnectionDB_Model();

        $dbModel->editProperty($team_id, 'team', 'picture_path', $absolutePath);

    }

    public static function deleteById($team_id) {
        $dbModel = new ConnectionDB_Model();

        $dbModel->deleteLineById($team_id, 'team');
    }

    public static function incrementNbVisits($team_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("UPDATE team SET nb_visits = nb_visits + 1 WHERE team_id=$team_id");
        return $query->execute();
    }
}