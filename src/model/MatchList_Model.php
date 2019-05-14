<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 00:14
 */

require_once('ConnectionDB_Model.php');
require_once('Match_Model.php');

class MatchList_Model {
    private $matchList = array();

    public static function getByDayID($day_ID) {
        $matchList_Model = new self();

        $matchList_Model->loadByDayID($day_ID);
        return $matchList_Model;
    }

    public function hydrate($matchArray = array()) {
        if ($matchArray != null) {
            foreach ($matchArray as $match) {
                $this->addMatch($match);
            }
        }
    }

    protected function addMatch($match) {
        $this->matchList[] = Match_Model::loadFromArray($match);
    }

    public function loadByDayID($day_ID) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM `match` WHERE day_id=$day_ID");
        $query->execute();
        $matchArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($matchArray);
    }

    public function getMatchList() { return $this->matchList; }

    public function searchWinnerTeamId($team1_id, $team2_id) {
        foreach ($matchList = $this->getMatchList() as $match) {
            if ($match->getTeam1Id() == $team1_id && $match->getTeam2Id() == $team2_id) {
                return $match->getWinnerTeamId();
            }
        }

        return null;
    }

    public function clearList() {
        $this->matchList = null;
    }


    public function loadByDayList(&$dayList) {
        $dbModel = new ConnectionDB_Model();

        $statement = "SELECT * FROM `match` WHERE ";

        $nbPlayDay = count($dayList);
        $count = 1;

        foreach ($dayList as $day) {
            $day_id = $day['day_id'];

            $statement = $statement . "day_id=$day_id";

            if($count < $nbPlayDay) {
                $statement = $statement . " OR ";
                $count++;
            }
        }

        $query = $dbModel->getConnection()->prepare($statement);
        $query->execute();
        $matchArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($matchArray);
    }
}