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

class Team_Controller {
    private $teamList_Model;
    private $bufferList_Model;
    private $tournamentList_Model;

    private $team_Model;
    private $editionMode = false;

    public function __construct() {
        $this->teamList_Model = new TeamList_Model();
        $this->bufferList_Model = new BufferList_Model();
    }

    public function actionsController() {
        if( isset($_POST['action']) && isset($_POST['team_id']) ) {

            if($_POST['action'] == "delete") {
                Team_Model::deleteById($_POST['team_id']);
            }

            elseif ($_POST['action'] == 'edit') {
                $this->team_Model = Team_Model::getByID($_POST['team_id']);

                if( $this->team_Model != null) {
                    $this->editionMode = true;
                    $_SESSION['edit_team_id'] = $_POST['team_id'];
                }
            }
        }
    }

    public function viewController() {
        $this->bufferList_Model->loadAllBuffer();

        if( isset($_GET['viewTeam']) ) {
            $team_id = $_GET['viewTeam'];
            $tmp = "viewTeam" . $team_id;

            if(!isset($_COOKIE[$tmp])) {
                Team_Model::incrementNbVisits($team_id);
                setcookie($tmp, true);
            }

            $team_Model = Team_Model::getByID($team_id);
            $teamName = $team_Model->getName();
            $team_picturePath = $team_Model->getPicturePath();
            $nbTournaments = $this->bufferList_Model->getNbTournaments($team_id);
            $nbVisits = $team_Model->getNbVisits();
            $ratio = 'x';

            $bufferList = $this->bufferList_Model->getBufferList();

            $this->tournamentList_Model = new TournamentList_Model();
            $this->tournamentList_Model->loadByBufferList($bufferList);

            $tournamentList = $this->tournamentList_Model->getTournamentList();

            require_once(dirname(__DIR__) . '/view/admin/viewTeam-view.php');
        } else {
            $this->printAllTeams();
        }
    }

    public function printAllTeams() {
        $teamEdition = $this->editionMode;

        if($teamEdition == true) {
            $teamName = $this->team_Model->getName();
            $team_picturePath = $this->team_Model->getPicturePath();
        }

        $this->teamList_Model->loadAllTeams();
        $teamList = $this->teamList_Model->getTeamList();

        $bufferList = $this->bufferList_Model->getBufferList();

        $nbTournaments = array();

        foreach ($bufferList as $buffer) {
            $team_id = $buffer->getTeamId();

            if( isset($nbTournaments[$team_id]) ) {
                $nbTournaments[$team_id]++;
            } else {
                $nbTournaments[$team_id] = 1;
            }
        }

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

    public function controlForm() {
        if (isset($_POST['form'])) {
            if ($_POST['form'] == 'create') {

                if (isset($_FILES['logo']) AND isset($_POST['name']) AND $_POST['name'] != '') {
                    // Verification of POST
                    if (isset($_POST['CSRF_token']) AND $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {
                        // Verification of CRSF Token

                        $name = htmlentities($_POST['name']);

                        if (!Team_Model::verifyAvailabilityName($name)) {
                            // TODO Add error message
                            exit();
                        }
                        $absolutePath = Team_Controller::resizeAndSave($_FILES['logo']['tmp_name']);

                        if ($absolutePath != null) {
                            Team_Model::addNewTeam($name, $absolutePath);
                        }

                    } else {
                        // TODO Add error message
                    }

                } else {
                    // TODO Add error message
                }

            } elseif ($_POST['form'] == 'edit') {
                if ($_POST['name'] != '') {
                    $name = htmlentities($_POST['name']);

                    if (!Team_Model::verifyAvailabilityName($name)) {
                        // TODO Add error message
                        exit();
                    }
                    Team_Model::editTeamName($_SESSION['edit_team_id'], $name);
                }
                
                if (isset($_FILES['logo']) AND is_array($_FILES) AND $_FILES['logo']['tmp_name'] != '') {
                    $absolutePath = Team_Controller::resizeAndSave($_FILES['logo']['tmp_name']);

                    if($absolutePath != null) {
                        $oldPicturePath = Team_Model::getPicturePathByID($_SESSION['edit_team_id']);
                        Team_Model::editPicturePath($_SESSION['edit_team_id'], $absolutePath);
                        unlink(dirname(dirname(__DIR__)) . $oldPicturePath) or die('PB !');
                    }

                }
                unset($_SESSION['edit_team_id']);
            }
        }
    }

    private static function imageResize($imageResourceId,$width,$height) {
        $targetWidth = 100;
        $targetHeight = 100;

        $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId,0,0,0,0, $targetWidth, $targetHeight, $width, $height);

        return $targetLayer;
    }

    private static function resizeAndSave($file) {
        $sourceProperties = getimagesize($file);
        $fileNewName = md5(uniqid(rand(), true));
        $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
        $absolutePath = "/upload/teamLogo_" . $fileNewName . "." . $ext;
        $relativePath = dirname(dirname(__DIR__)) . $absolutePath;
        $imageType = $sourceProperties[2];

        switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($file);
                $targetLayer = Team_Controller::imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                imagepng($targetLayer, $relativePath);

                break;

            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($file);
                $targetLayer = Team_Controller::imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
                imagejpeg($targetLayer, $relativePath);

                break;

            default:
                // TODO Add error msg
                return null;
                break;
        }

        return $absolutePath;
        // TODO Add success msg
    }
}