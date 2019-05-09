<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 28/03/2019
 * Time: 08:35
 */

session_start();

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class Newadmin_Controller extends NewAdmin_Model {
    public $newAdminModel;


    public function __construct() {
        $this->newAdminModel = new NewAdmin_Model();
    }


    private function printAdminView($error_msg = null) {
        try {
            $CSRF_token = bin2hex(random_bytes(32));
            $_SESSION['CSRF_token'] = $CSRF_token;
        } catch (Exception $e) {
            // TODO : Add action
        }

        require_once(dirname(__DIR__) . '/view/newAdmin-view.php');
    }

    public function controlForm() {
        if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword']) ) {      // Verification of POST
            if( isset($_POST['CSRF_token']) && $_SESSION['CSRF_token'] == $_POST['CSRF_token'] ) {       // Verification of CRSF Token
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);
                $confirmPassword = htmlentities($_POST['confirmPassword']);


                if( $password == $confirmPassword ) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->createAdmin($username, $hash);
                    UtilFunc_Model::redirect('/ProjectMaxRobin/public/admin/');
                    echo ('3');


                } else {
                    $this->printAdminView('Passwords don\'t match');
                    echo ('1');
                }

            } else {
                $this->printAdminView('Error with verification token, please retry');
                echo ('2');
            }

        } else {
            $this->printAdminView();
            echo ('4');

        }
    }
}


