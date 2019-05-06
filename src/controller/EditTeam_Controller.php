<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 01/05/2019
 * Time: 22:27
 */

require(dirname(__DIR__) . '/model/Team_Model.php');

session_start();

class EditTeam_Controller {
    private $team;

    public function __construct() {}

    public function checkTeamEdit() {
        if ( isset($_POST['team_id']) ) {
            // TODO Verif security form

            $_SESSION['edit_team_id'] = $_POST['team_id'];

            $this->team = Team_Model::getByID($_SESSION['edit_team_id']);
            var_dump($this->team);

        } elseif ( isset($_SESSION['edit_team_id']) ) {
            $this->team = Team_Model::getByID($_SESSION['edit_team_id']);
            var_dump($this->team);
        }
    }

    public function printView() {

    }
}