<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 03:31
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class GenerateDays_Controller {
    private $teamList_Model;

    public function __construct() {
        $this->teamList_Model = new TeamList_Model();
    }

    public function generateDays($tournament_id) {
        $status = Tournament_Model::getStatusByID($tournament_id);
        if($status == 1 ) {
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

            Tournament_Model::incrementStatus($tournament_id);
            iziToast_Model::printNotification('success', 'Days generated successfully');
        } elseif ($status == 0) {
            iziToast_Model::printNotification('warning', 'Please add team for generation');
        } elseif ($status >= 2) {
            iziToast_Model::printNotification('warning', 'Tournament already generated');
        }

    }
}