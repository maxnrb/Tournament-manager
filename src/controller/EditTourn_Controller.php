<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:38
 */

require(dirname(__DIR__) . '/model/Tournament_Model.php');

session_start();

require(dirname(__DIR__) . '/controller/TeamList_Controller.php');
require(dirname(__DIR__) . '/model/UtilFunc_Model.php');

class EditTourn_Controller {
    private $tournament;

    public function __construct() {
        if ( isset($_POST['tournament_id']) ) {
            // TODO Verif security form

            $_SESSION['edit_tournament_id'] = $_POST['tournament_id'];

            $this->tournament = Tournament_Model::getByID($_SESSION['edit_tournament_id']);
            var_dump($this->tournament);
        } elseif ( isset($_SESSION['edit_tournament_id']) ) {
            $this->tournament = Tournament_Model::getByID($_SESSION['edit_tournament_id']);
            var_dump($this->tournament);
        }
    }

    function printView() {
        if (isset($_POST['team_id']) ) {
            // TODO Add verif if team already add
            // TODO verif security form

            Buffer_Model::addBufferTeam($this->tournament->getTournamentId(), $_POST['team_id']);
        }

        Buffer_Model::getNbAddTeam($_SESSION['edit_tournament_id']);

        $TeamList_Controller = new TeamList_Controller();
        $TeamList_Controller->printTeamAndBuff();
    }

}