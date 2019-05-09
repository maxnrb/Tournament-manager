<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});
if (session_status() == PHP_SESSION_NONE) { session_start(); }

class TeamList_Controller {
    private $teamList_Model;
    private $bufferList_Model;

    public function __construct() {
        $this->teamList_Model = new TeamList_Model();
    }

    public function actionsController() {
        if( isset($_POST['action']) && isset($_POST['team_id']) ) {

            if($_POST['action'] == "delete") {
                Team_Model::deleteById($_POST['team_id']);
            }
        }
    }

    public function printAllTeams() {
        $this->teamList_Model->loadAllTeams();
        $teamList = $this->teamList_Model->getTeamList();

        if ($teamList != null) {
            try {
                $CSRF_token = bin2hex(random_bytes(32));
                $_SESSION['CSRF_token'] = $CSRF_token;
            } catch (Exception $e) {
                // TODO : Add action
            }

            require_once(dirname(__DIR__) . '/view/admin/team-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }
}