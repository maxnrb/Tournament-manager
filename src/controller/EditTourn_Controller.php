<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:38
 */

require(dirname(__DIR__) . '/model/EditTourn_Model.php');
require(dirname(__DIR__) . '/model/Tournament_Model.php');
require(dirname(__DIR__) . '/controller/TeamList_Controller.php');
require(dirname(__DIR__) . '/model/UtilFunc_Model.php');


class EditTourn_Controller {
    private $editTourn_Model;
    private $tournament;

    public function __construct() {
        $this->editTourn_Model = new EditTourn_Model();
        $this->tournament = new Tournament_Model(array("tournament_id" => "7", "name" => "tourn1", "nb_teams" => "4"));
    }

    function printView() {
        var_dump($this->tournament);

        $bufferTeams = $this->editTourn_Model->getBufferTeams($this->tournament->getTournamentId());

        var_dump($bufferTeams);

        $TeamList_Controller = new TeamList_Controller();
        $TeamList_Controller->printTeamAndBuff($bufferTeams);

        if (isset($_POST['team_id']) ) {
            // TODO Add verif if team already add
            // TODO verif security form

            $this->editTourn_Model->addBufferTeam($this->tournament->getTournamentId(), $_POST['team_id']);
            UtilFunc_Model::redirect('/Tournament-manager/public/admin/edit_tournament.php');
        }
    }

}