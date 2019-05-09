<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:38
 */

session_start();

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});
class EditTourn_Controller {
    private $tournament;

    public function __construct() {}

    public function checkTournamentEdit() {
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
        if ( isset($_POST['team_id']) ) {
            // TODO Add verif if team already add
            // TODO verif security form

            Buffer_Model::addBufferTeam($this->tournament->getTournamentId(), $_POST['team_id']);
        }

        $TeamList_Controller = new TeamList_Controller();
        $TeamList_Controller->printTeamAndBuff();
    }

}