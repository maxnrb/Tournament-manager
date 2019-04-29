<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 23:44
 */

session_start();

require(dirname(__DIR__) . '/model/Tournament_Model.php');

class NewTourn_Controller {
    private function printForm() {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/newTourn-view.php');
    }

    public function controlForm() {
        if (isset($_POST['name']) && isset($_POST['nb_teams'])) {      // Verification of POST
            if (isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {       // Verification of CRSF Token
                $name = htmlentities($_POST['name']);
                $nb_teams = htmlentities($_POST['nb_teams']);

                if(!Tournament_Model::verifyAvailabilityName($name)) {
                    $this->printForm();
                    exit();
                }

                Tournament_Model::addNewTournament($name, $nb_teams);

            } else {
                $this->printForm();
                // TODO Add error message
            }
        } else {
            $this->printForm();
        }
    }
}