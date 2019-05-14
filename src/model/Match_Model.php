<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 03:19
 */

require_once('ConnectionDB_Model.php');

class Match_Model {
    private $match_id;
    private $day_id;
    private $team1_id;
    private $team2_id;
    private $team1_score = null;
    private $team2_score = null;

    public function getMatchId() { return $this->match_id; }
    public function getDayId() { return $this->day_id; }
    public function getTeam1Id() { return $this->team1_id; }
    public function getTeam2Id() { return $this->team2_id; }
    public function getTeam1Score() { return $this->team1_score; }
    public function getTeam2Score() { return $this->team2_score; }

    public function getWinnerTeamId() {
        if ($this->getTeam1Score() - $this->getTeam2Score() > 0) {
            return $this->getTeam1Id();
        } elseif ($this->getTeam2Score() - $this->getTeam1Score() > 0) {
            return $this->getTeam2Id();
        }

        return null;
    }

    public function setMatchId($match_id) { $this->match_id = (int)$match_id; }
    public function setDayId($day_id) { $this->day_id = (int)$day_id; }
    public function setTeam1Id($team1_id) { $this->team1_id = (int)$team1_id; }
    public function setTeam2Id($team2_id) { $this->team2_id = (int)$team2_id; }
    public function setTeam1Score($team1_score) { $this->team1_score = (int)$team1_score; }
    public function setTeam2Score($team2_score) { $this->team2_score = (int)$team2_score; }

    public static function newMatchDB($day_id, $team1_id, $team2_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO `match` (day_id, team1_id, team2_id) VALUES (:day_id, :team1_id, :team2_id)");
        $query->execute(array(':day_id' => "$day_id", ':team1_id' => "$team1_id", ':team2_id' => "$team2_id"));
    }

    public static function loadFromArray($matchInfo = array()) {
        $match = new self();
        $match->hydrate($matchInfo);

        return $match;
    }

    public function hydrate(array $match) {
        if(isset($match['match_id'])) {
            $this->setMatchId($match['match_id']);
        }

        if(isset($match['day_id'])) {
            $this->setDayId($match['day_id']);
        }

        if(isset($match['team1_id'])) {
            $this->setTeam1Id($match['team1_id']);
        }

        if(isset($match['team2_id'])) {
            $this->setTeam2Id($match['team2_id']);
        }

        if(isset($match['team1_score'])) {
            $this->setTeam1Score($match['team1_score']);
        }

        if(isset($match['team2_score'])) {
            $this->setTeam2Score($match['team2_score']);
        }
    }
}