<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 03:31
 */

session_start();

require_once(dirname(__DIR__) . '/model/TeamList_Model.php');
require_once(dirname(__DIR__) . '/model/Day_Model.php');
require_once(dirname(__DIR__) . '/model/Match_Model.php');
require_once(dirname(__DIR__) . '/model/Buffer_Model.php');
require_once(dirname(__DIR__) . '/model/Tournament_Model.php');


class GenerateDays_Controller {
    private $teamList_Model;

    public function __construct() {
        $this->teamList_Model = new TeamList_Model();
    }

    public function generateDays() {
        $tournament_id = $_SESSION['edit_tournament_id'];

        if(Buffer_Model::getNbAddTeam($tournament_id) != Tournament_Model::getNbTeamsTournament($tournament_id)) {
            return;
        } elseif (Tournament_Model::getGenerationStat($tournament_id) == true) {
            return;
        }

        $this->teamList_Model->loadOnlyBufferTeams( $tournament_id );
        $teamList = $this->teamList_Model->getAddTeamList();

        $nbTeams = count($teamList);
        if($nbTeams%2 != 0) {
            array_push($teamList, new Team_Model());
            $nbTeams++;
        }

        shuffle($teamList);    // Random teams

        $visitors = array_splice($teamList, $nbTeams/2);
        $home = $teamList;

        for ($dayNumber = 1; $dayNumber < $nbTeams; $dayNumber++) {
            $day_id = Day_Model::newDayDB($tournament_id, $dayNumber );

            for ($i = 0; $i < $nbTeams/2; $i++) {
                Match_Model::newMatchDB($day_id , $home[$i]->getTeamId(), $visitors[$i]->getTeamId());
            }

            $var1_array = array_splice($home, 1, 1);  // Return an array
            $var2_string = array_pop($visitors);   // Return a string

            array_unshift($visitors, $var1_array[0]);
            array_push($home, $var2_string);
        }

        Tournament_Model::setTournamentGenerated($tournament_id);
    }
}