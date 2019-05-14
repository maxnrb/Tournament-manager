<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 00:00
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class Ranking_Controller {
    private $matchList_Model;

    private $rankingList_Model;
    private $rankingLists = array(); // Array of rankingList_Model : 1 rankingList = 1 tournament day

    public function __construct() {
        $this->matchList_Model = new MatchList_Model();
    }

    public function getRankingLists($tournament_id) {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT day_id FROM day WHERE tournament_id='$tournament_id' && played=true");
        $query->execute();
        $dayList = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($dayList == null) { return; }

        $this->matchList_Model->loadByDayList($dayList);
        $matchList = $this->matchList_Model->getMatchList();
        $this->rankingLists['global'] = new RankingList_Model();


        foreach ($dayList as $day) {
            $day_id = $day['day_id'];
            $this->rankingLists[$day_id] = new RankingList_Model();
        }

        foreach ($matchList as $match) {
            $this->rankingLists[ $match->getDayId() ]->updateRankingList( $match->getTeam1Id() , $match->getTeam2Id() , $match->getTeam1Score() , $match->getTeam2Score() );
            $this->rankingLists['global']->updateRankingList( $match->getTeam1Id() , $match->getTeam2Id() , $match->getTeam1Score() , $match->getTeam2Score() );
        }

        foreach ($this->rankingLists as $rank) {
            $rank->sortByTeamPoint($this->matchList_Model);
        }

        foreach ($dayList as $day) {
            $day_id = $day['day_id'];
            $rankingLists[$day_id] = $this->rankingLists[$day_id]->getRankingList();
        }

        $rankingLists[0] = $this->rankingLists['global']->getRankingList();

        require_once(dirname(__DIR__) . '/view/admin/editTournamentRanking-view.php');
    }
}