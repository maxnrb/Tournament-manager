<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:02
 */

session_start();

require(dirname(__DIR__) . '/model/NewTeam_Model.php');


class NewTeam_Controller extends NewTeam_Model {
    private function printForm() {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/newTeam-view.php');
    }

    public function controlForm() {
        if (isset($_POST['name']) && isset($_POST['picture_path'])) {      // Verification of POST
            if (isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token']) {       // Verification of CRSF Token
                $name = htmlentities($_POST['name']);
                $picture_path = htmlentities($_POST['picture_path']);

                if(!$this->verifyAvailabilityName($name)) {
                    $this->printForm();
                    exit();
                }

                $this->createNewTeam($name, $picture_path);

            } else {
                $this->printForm(); // TODO Add error message
            }
        } else {
            $this->printForm();
        }
    }
}