<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require_once(dirname(__DIR__) . '/model/TeamList_Model.php');

if (session_status() == PHP_SESSION_NONE) { session_start(); }

class TeamList_Controller {
    private $teamList_Model;
    private $bufferList_Model;

    public function __construct() {
        $this->teamList_Model = new TeamList_Model();
    }

    public function printAllTeams() {
        $this->teamList_Model->loadAllTeams();
        $teamList = $this->teamList_Model->getTeamList();

        if ($teamList != null) {
            require_once(dirname(__DIR__) . '/view/allTeam-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }

    public function printTeamAndBuff() {
        $this->teamList_Model->loadAllTeams();
        $this->teamList_Model->parseFromBufferTeams( $_SESSION['edit_tournament_id'] );

        $teamList = $this->teamList_Model->getTeamList();
        $addTeamList = $this->teamList_Model->getAddTeamList();

        var_dump($addTeamList);

        if ($teamList != null) {
            require_once(dirname(__DIR__) . '/view/teamAndBuff-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }
}