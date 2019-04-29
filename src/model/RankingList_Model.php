<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 11:33
 */

require_once('Ranking_Model.php');
require_once('MatchList_Model.php');
require_once('Team_Model.php');

class RankingList_Model {
    private $matchList_Model;
    private $rankingList = array();

    public function getRankingList() { return $this->rankingList; }

    protected function objectRankingCreation($team1_id, $team2_id) {
        if( !isset($this->rankingList["$team1_id"]) ) { $this->rankingList["$team1_id"] = new Ranking_Model($team1_id); }
        if( !isset($this->rankingList["$team2_id"]) ) { $this->rankingList["$team2_id"] = new Ranking_Model($team2_id); }
    }

    public function updateRankingList($team1_id, $team2_id, $team1_score, $team2_score) {
        $this->objectRankingCreation($team1_id, $team2_id);

        if ($team1_score > $team2_score) {
            $this->rankingList["$team1_id"]->matchWin($team1_score, $team2_score);
            $this->rankingList["$team2_id"]->matchLost($team2_score, $team1_score);

        } elseif ($team2_score > $team1_score) {
            $this->rankingList["$team1_id"]->matchLost($team1_score, $team2_score);
            $this->rankingList["$team2_id"]->matchWin($team2_score, $team1_score);

        } else {
            $this->rankingList["$team1_id"]->matchDraw($team1_score, $team2_score);
            $this->rankingList["$team2_id"]->matchDraw($team2_score, $team1_score);
        }
    }

    public function sortByTeamPoint(&$matchList_Model) {
        $this->matchList_Model = &$matchList_Model;

        uasort($this->rankingList, array("RankingList_Model", "cmpTeamPoint"));
    }

    public static function cmp($valueA, $valueB) {
        if($valueA == $valueB) {
            return 0;
        }
        return ($valueA > $valueB) ? -1 : 1;
    }

    protected function cmpTeamPoint($a, $b) {
        $cmpValue = self::cmp( $a->getTeamPoint(), $b->getTeamPoint());

        if( $cmpValue == 0) { $cmpValue = self::cmpTotalGoalDifference($a, $b); }
        if( $cmpValue == 0) { $cmpValue = self::cmpTotalGoalFavor($a, $b); }
        if( $cmpValue == 0) { $cmpValue = self::cmpGoalDifference($a, $b); }
        if( $cmpValue == 0) { $cmpValue = self::cmpTeamName($a,$b); }

        return $cmpValue;
    }

    public function cmpGoalDifference($a, $b) {
        $team1_id = $a->getTeamId();
        $team2_id = $b->getTeamId();

        $winnerTeamId = $this->matchList_Model->searchWinnerTeamId($team1_id, $team2_id);

        if($winnerTeamId == null) {
            return 0;
        }
        return ($winnerTeamId == $team1_id) ? -1 : 1;
    }

    public function cmpTeamName($a, $b) {
        $team1_id = $a->getTeamId();
        $team2_id = $b->getTeamId();
        $team1Name = Team_Model::getTeamNameByID($team1_id);
        $team2Name = Team_Model::getTeamNameByID($team2_id);

        return (strcasecmp($team1Name, $team2Name) > 0) ? 1 : -1;
    }

    public static function cmpTotalGoalDifference($a, $b) {
        return self::cmp( $a->getTotalGoalDifference(), $b->getTotalGoalDifference() );
    }

    public static function cmpTotalGoalFavor($a, $b) {
        return self::cmp( $a->getTotalGoalFavor(), $b->getTotalGoalFavor() );
    }

    public static function cmpTotalGoalAgainst($a, $b) {
        return self::cmp( $a->getTotalGoalAgainst(), $b->getTotalGoalAgainst() );
    }

    public static function cmpWinMatch($a, $b) {
        return self::cmp( $a->getWinMatch(), $b->getWinMatch() );
    }

    public static function cmpLostMatch($a, $b) {
        return self::cmp( $a->getLostMatch(), $b->getLostMatch() );
    }

    public static function cmpDrawMatch($a, $b) {
        return self::cmp( $a->getDrawMatch(), $b->getDrawMatch() );
    }
}