<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require(dirname(__DIR__) . '/model/TeamList_Model.php');

class TeamList_Controller {
    private $TeamList_Model;

    private function getAllTeams() {
        return $this->TeamList_Model->fetchAllTeams();
    }

    public function __construct() {
        $this->TeamList_Model = new TeamList_Model();
    }

    public function printAllTeams() {
        $teams = $this->getAllTeams();

        if ($teams != null) {
            require_once(dirname(__DIR__) . '/view/allTeam-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }

    public function printTeamAndBuff($bufferTeams) {
        $teams = $this->getAllTeams();

        

        if ($teams != null) {
            require_once(dirname(__DIR__) . '/view/teamAndBuff-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }
}