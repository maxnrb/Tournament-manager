<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require(dirname(__DIR__) . '/model/TeamList_Model.php');
require(dirname(__DIR__) . '/model/BufferList_Model.php');

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

        $this->bufferList_Model = new BufferList_Model();
        $this->bufferList_Model->loadByTournamentId( $_SESSION['edit_tournament_id'] );

        $bufferList = $this->bufferList_Model->getBufferList();
        $this->teamList_Model->parseWithBufferList($bufferList);

        $addTeamList = $this->teamList_Model->getAddTeamList();
        $teamList = $this->teamList_Model->getTeamList();

        var_dump($addTeamList);

        if ($teamList != null) {
            require_once(dirname(__DIR__) . '/view/teamAndBuff-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }
}