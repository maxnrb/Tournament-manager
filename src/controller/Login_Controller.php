<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 22:50
 */

session_start();

require(dirname(__DIR__) . '/model/Login_Model.php');

function redirect($link) {
    header("Location: $link");
    exit();
}

class Login_Controller {
    public $loginModel;

    public function __construct() {
        $this->loginModel = new Login_Model();
    }

    public function controlForm() {
        if(isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] === $_POST['CSRF_token']) {     // Verification of CRSF Token
            if(isset($_POST["username"]) && isset($_POST["password"])) {                                // Verification of POST
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);

                $data = $this->loginModel->getDataUser($username);

                if( password_verify($password, $data['password']) ) {
                    echo "Connected";

                    $_SESSION['loggedIn'] = true;
                    $_SESSION['admin_id'] = $data['admin_id'];
                    $_SESSION['right_level'] = $data['right_level'];
                    $_SESSION['username'] = $username;

                    try {
                        $_SESSION['login_date'] = new DateTime("now", new DateTimeZone("Europe/Paris"));
                    } catch (Exception $exception) {
                        // TODO Add treatment
                    }
                    //redirect('/Tournament-manager/public/admin/index.php');
                }
            }
        } else {
            require_once(dirname(__DIR__).'/view/login-view.php');
        }
    }
}

