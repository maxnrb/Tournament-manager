<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 03:19
 */

require_once('DB_Model.php');

class Match_Model {
    private $match_id;
    private $day_id;
    private $team1_id;
    private $team2_id;
    private $team1_score;
    private $team2_score;

    public function getMatchId() { return $this->match_id; }
    public function getDayId() { return $this->day_id; }
    public function getTeam1Id() { return $this->team1_id; }
    public function getTeam2Id() { return $this->team2_id; }
    public function getTeam1Score() { return $this->team1_score; }
    public function getTeam2Score() { return $this->team2_score; }

    public function setMatchId($match_id) { $this->match_id = $match_id; }
    public function setDayId($day_id) { $this->day_id = $day_id; }
    public function setTeam1Id($team1_id) { $this->team1_id = $team1_id; }
    public function setTeam2Id($team2_id) { $this->team2_id = $team2_id; }
    public function setTeam1Score($team1_score) { $this->team1_score = $team1_score; }
    public function setTeam2Score($team2_score) { $this->team2_score = $team2_score; }

    public static function newMatchDB($day_id, $team1_id, $team2_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO `match` (day_id, team1_id, team2_id) VALUES (:day_id, :team1_id, :team2_id)");
        $query->execute(array(':day_id' => "$day_id", ':team1_id' => "$team1_id", ':team2_id' => "$team2_id"));
    }
}