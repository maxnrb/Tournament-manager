<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/04/2019
 * Time: 18:56
 */

class Team_Model {
    private $team_id;
    private $name;
    private $picture_path;

    public function __construct() {}

    public static function getByID($team_id) {
        $tournament = new self();
        $tournament->loadByID($team_id);

        return $tournament;
    }

    public static function getByName($name) {
        // TODO To implement
    }

    public static function loadFromArray($teamInfo = array()) {
        $tournament = new self();
        $tournament->hydrate($teamInfo);

        return $tournament;
    }

    protected function loadByID($team_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM team WHERE team_id=$team_id");
        $query->execute();
        $tournament = $query->fetch(PDO::FETCH_ASSOC);

        $this->hydrate($tournament);
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
    }

    public function getTeamId() { return $this->team_id; }
    public function getName() { return $this->name; }
    public function getPicturePath() { return $this->picture_path; }

    public function setTeamId($team_id) { $this->team_id = $team_id; }
    public function setName($name) { $this->name = $name; }
    public function setPicturePath($picture_path) { $this->picture_path = $picture_path; }
}