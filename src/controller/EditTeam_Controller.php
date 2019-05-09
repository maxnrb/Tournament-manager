<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 01/05/2019
 * Time: 22:27
 */

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});
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

    public function checkEdition() {
        if( isset($_POST['edition_id']) ) {
            if($_POST['edition_id'] == $_SESSION['edit_team_id']) {

                if($_POST['name'] != $_SESSION['team_name']) {
                    Team_Model::editTeamName($_SESSION['edit_team_id'], $_POST['name']);
                }

                if($_POST['picturePath'] != $_SESSION['picturePath_team']) {

                }

            }
        }
    }

    public function printView() {
        $name = $this->team->getName();
        $picturePath = $this->team->getPicturePath();
        $edit_team_id = $this->team->getTeamId();
        $CSRF_token = 0;

        $_SESSION['team_name'] = $name;
        $_SESSION['picturePath_team'] = $picturePath;

        require_once(dirname(__DIR__) . '/view/editTeam-view.php');
    }
}