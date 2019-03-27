<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:50
 */

session_start();

require(dirname(__DIR__) . '/model/Login_Model.php');
require(dirname(__DIR__) . '/model/UtilFunc_Model.php');

class Login_Controller {
    public $loginModel;

    public function __construct() {
        $this->loginModel = new Login_Model();
    }

    private function printLoginView($error_msg = null) {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/login-view.php');
    }

    public function controlForm() {
        if( isset($_POST["username"]) && isset($_POST["password"]) ) {      // Verification of POST
            if( isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token'] ) {       // Verification of CRSF Token
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);

                $data = $this->loginModel->getDataUser($username);

                if(!$data) {
                    $this->printLoginView('Bad username');
                    exit();
                }

                if( password_verify($password, $data['password']) ) {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['admin_id'] = $data['admin_id'];
                    $_SESSION['username'] = $username;

                    try {
                        $_SESSION['login_date'] = new DateTime("now", new DateTimeZone("Europe/Paris"));
                    } catch (Exception $exception) {
                        // TODO Add treatment
                    }
                    UtilFunc_Model::redirect('/Tournament-manager/public/admin/');

                } else {
                    $this->printLoginView('Bad password');
                }

            } else {
                $this->printLoginView('Error with verification token, please retry');
            }

        } else {
            $this->printLoginView();
        }
    }
}

