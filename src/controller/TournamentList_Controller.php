<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:36
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class TournamentList_Controller {
    private $tournamentList_Model;
    private $teamList_Model;

    private $tournament_Model;

    public function __construct() {
        $this->tournamentList_Model = new TournamentList_Model();
    }

    public function actionsController() {
        if( isset($_POST['action']) && isset($_POST['tournament_id']) ) {

            if($_POST['action'] == "delete") {
                if( Tournament_Model::deleteById($_POST['tournament_id']) ) {
                    iziToast_Model::printNotification('success', 'Tournament deleted');
                } else {
                    iziToast_Model::printNotification('error', 'Error during deleting ! Please retry');
                }
            }
        }
    }

    public function newTournamentController() {
        if (isset($_POST['name']) && isset($_POST['nb_teams'])) {
            // Verification of POST
            if (isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {
                // Verification of CRSF Token

                $name = htmlentities($_POST['name']);
                $nb_teams = htmlentities($_POST['nb_teams']);

                if(!Tournament_Model::verifyAvailabilityName($name)) {
                    iziToast_Model::printNotification('warning', 'Tournament name already used');

                    return;
                }

                if( Tournament_Model::addNewTournament($name, $nb_teams) ) {
                    iziToast_Model::printNotification('success', 'Tournament created');
                } else {
                    iziToast_Model::printNotification('error', 'Error during creation ! Please retry');
                }

            } else {
                iziToast_Model::printNotification('error', 'Invalid token ! Please retry');
            }
        }
    }


    public function viewController() {
        if( isset($_GET['editTournament']) ) {
            $tournament_id = $_GET['editTournament'];
            $this->tournament_Model = Tournament_Model::getByID($tournament_id);

            $this->checkAddTeam( $tournament_id );

            $nbAddTeams = Buffer_Model::getNbAddTeam($tournament_id);
            $tournamentName = $this->tournament_Model->getName();
            $nbTeams = $this->tournament_Model->getNbTeams();

            $statusMsg = Tournament_Model::getTournamentStatusMsg($tournament_id);

            if(isset($_GET['view']) AND $_GET['view'] == 'match') {
                $matchLists = $this->getMatchPerDay($tournament_id);

                require_once(dirname(__DIR__) . '/view/admin/editTournamentMatch-view.php');
            } elseif (isset($_GET['view']) AND $_GET['view'] == 'ranking') {
                require_once(dirname(__DIR__) . '/view/admin/editTournamentRanking-view.php');
            } else {
                $this->printTeamAndBuff( $tournament_id );
            }

        } else {
            $this->printTournamentList();
        }
    }

    private function printTournamentList() {
        $this->tournamentList_Model->loadAllTournaments();
        $tournamentList = $this->tournamentList_Model->getTournamentList();

        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/admin/tournament-view.php');
    }


    private function printTeamAndBuff($tournament_id) {
        $this->teamList_Model = new TeamList_Model();

        $statusMsg = Tournament_Model::getTournamentStatusMsg($tournament_id);

        $this->teamList_Model->loadAllTeams();
        $this->teamList_Model->parseFromBufferTeams( $tournament_id );

        $teamList = $this->teamList_Model->getTeamList();
        $addTeamList = $this->teamList_Model->getAddTeamList();

        $tournamentName = $this->tournament_Model->getName();
        $nbTeams = $this->tournament_Model->getNbTeams();
        $nbAddTeams = count($addTeamList);

        if ($teamList != null OR $addTeamList != null) {
            require_once(dirname(__DIR__) . '/view/admin/editTournamentTeams-view.php');
        } else {
            echo "Aucune équipe !";
        }
    }

    private function checkAddTeam($tournament_id) {
        if ( isset($_POST['team_id']) AND isset($_POST['action'])) {
            // TODO Add verif if team already add
            // TODO verif security form

            if ($_POST['action'] == 'addTeam') {
                if( Tournament_Model::getStatusByID($tournament_id) > 0 ) {
                    iziToast_Model::printNotification('warning', 'Maximum number of teams reached');
                    return;
                }

                if( Buffer_Model::addBufferTeam($tournament_id, $_POST['team_id']) ) {
                    iziToast_Model::printNotification('success', 'Team added');

                    if( Buffer_Model::getNbAddTeam($tournament_id) == $this->tournament_Model->getNbTeams()) {
                        Tournament_Model::incrementStatus($tournament_id);
                    }

                    } else {
                    iziToast_Model::printNotification('error', 'Error during adding ! Please retry');
                }

            }
        }
    }

    public function matchActionsController() {
        if(isset($_POST['tournament_id']) AND isset($_POST['action']) ) {
            if ($_POST['action'] == 'generateDays') {
                $generateDays_Controller = new GenerateDays_Controller();
                $generateDays_Controller->generateDays($_POST['tournament_id']);
            }
        }

        if(isset($_POST['tournament_id']) AND isset($_POST['action']) ) {
            if ($_POST['action'] == 'playDay') {
                $playDay_Controller = new PlayDay_Controller();
                $playDay_Controller->playNextDay($_POST['tournament_id']);            }
        }

        if(isset($_POST['tournament_id']) AND isset($_POST['action']) ) {
            if ($_POST['action'] == 'playAllDays') {
                $playDay_Controller = new PlayDay_Controller();

                if( Tournament_Model::getStatusByID($_POST['tournament_id']) >= 11) {
                    while ( $status = Tournament_Model::getStatusByID($_POST['tournament_id']) != 2) {
                        $playDay_Controller->playNextDay($_POST['tournament_id']);            }
                }
                }
        }
    }

    private function getMatchPerDay($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT day_id FROM day WHERE tournament_id='$tournament_id'");
        $query->execute();
        $days = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($days as $day) {
            $day_id = $day['day_id'];

            $matchLists[$day_id] = MatchList_Model::getByDayID($day_id)->getMatchList();
        }

        if(isset($matchLists)) {
            return $matchLists;
        } else {
            return null;
        }
    }

}