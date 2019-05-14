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


                } else {
                    // TODO password not match
                }

            } else {
                // TODO Token error
            }

        } else {

        }
    }
}


