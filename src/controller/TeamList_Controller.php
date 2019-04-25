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

    public function __construct() {
        $this->TeamList_Model = new TeamList_Model();
    }

    public function printTeamList() {
        $teams = $this->TeamList_Model->fetchAllTeams();

        if ($teams != null) {
            require_once(dirname(__DIR__) . '/view/teamList-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }
}