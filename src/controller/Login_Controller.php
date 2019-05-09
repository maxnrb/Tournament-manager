<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:50
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class Login_Controller {
    public $loginModel;

    public function __construct() {
        $this->loginModel = new Login_Model();
    }

    public function printLoginView() {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/login-view.php');
    }

    public function controlForm($redirect = false) {
        if( isset($_POST["username"]) && isset($_POST["password"]) ) {
            // Verification of POST
            if( isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token'] ) {
                // Verification of CRSF Token
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);

                $data = $this->loginModel->getDataUser($username);

                if(!$data) {
                    return;
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

                    if($redirect == true) {
                        UtilFunc_Model::redirect(dirname($_SERVER['SCRIPT_NAME']) . '/admin/');
                    } else {
                        header("refresh: 0");
                    }

                } else {}

            } else {}

        }
    }
}

