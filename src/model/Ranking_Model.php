<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 11:10
 */

class Ranking_Model {
    private $team_id;

    private $teamPoint = 0;
    private $winMatch = 0;
    private $lostMatch = 0;
    private $drawMatch = 0;
    private $totalGoalFavor = 0;
    private $totalGoalAgainst = 0;

    public function __construct($team_id) {
        $this->setTeamId($team_id);
    }

    public function setTeamId($team_id) {
        $this->team_id = (int)$team_id;
    }

    public function getTeamId() { return $this->team_id; }
    public function getTeamPoint() { return $this->teamPoint; }
    public function getWinMatch() { return $this->winMatch; }
    public function getLostMatch() { return $this->lostMatch; }
    public function getDrawMatch() { return $this->drawMatch; }
    public function getTotalGoalFavor() { return $this->totalGoalFavor; }
    public function getTotalGoalAgainst() { return $this->totalGoalAgainst; }
    public function getTotalGoalDifference() { return ( $this->getTotalGoalFavor() - $this->getTotalGoalAgainst() ); }

    protected function updateTotalGoal($goalFavor, $goalAgainst) {
        $this->totalGoalFavor += $goalFavor;
        $this->totalGoalAgainst += $goalAgainst;
    }

    public function matchWin($goalFavor, $goalAgainst) {
        $this->teamPoint += 3;
        $this->winMatch += 1;

        $this->updateTotalGoal($goalFavor, $goalAgainst);
    }

    public function matchLost($goalFavor, $goalAgainst) {
        $this->lostMatch += 1;

        $this->updateTotalGoal($goalFavor, $goalAgainst);
    }

    public function matchDraw($goalFavor, $goalAgainst) {
        $this->teamPoint += 1;
        $this->drawMatch += 1;

        $this->updateTotalGoal($goalFavor, $goalAgainst);
    }
}