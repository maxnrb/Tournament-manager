<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 00:00
 */

session_start();

require_once(dirname(__DIR__) . '/model/DB_Model.php');
require_once(dirname(__DIR__) . '/model/MatchList_Model.php');
require_once(dirname(__DIR__) . '/model/RankingList_Model.php');


class Ranking_Controller {
    private $matchList_Model;
    private $rankingList_Model;

    public function __construct() {
        $this->matchList_Model = new MatchList_Model();
    }

    public function getRanking() {
        $tournament_id = $_SESSION['edit_tournament_id'];

        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT day_id FROM day WHERE tournament_id='$tournament_id' && played=true");
        $query->execute();
        $dayList = $query->fetchAll(PDO::FETCH_ASSOC);

        var_dump($dayList);

        if ($dayList == null) {
            return;
        }

        $this->rankingList_Model = new RankingList_Model();

        foreach ($dayList as $day) {
            $day_id = $day['day_id'];

            $this->matchList_Model->loadByDayID($day_id);
        }

        $matchList = $this->matchList_Model->getMatchList();

        var_dump($matchList);

        foreach ($matchList as $match) {
            $this->rankingList_Model->updateRankingList( $match->getTeam1Id() , $match->getTeam2Id() , $match->getTeam1Score() , $match->getTeam2Score() );
        }

        $this->rankingList_Model->sortByTeamPoint($this->matchList_Model);
        var_dump($this->rankingList_Model->getRankingList());
    }
}