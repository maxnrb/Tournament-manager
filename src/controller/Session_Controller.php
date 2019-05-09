<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/03/2019
 * Time: 22:20
 */

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

class Session_Controller {
    private $sessionModel;

    public function __construct() {
        $this->sessionModel = new Session_Model();
    }

    public function checkDisconnect() {
        if( isset($_GET['action'])  && $_GET['action'] == 'disconnect' ) {
            $this->sessionModel->disconnection();
            UtilFunc_Model::redirect('/Tournament-manager/public/');
        }
    }

    public function protectedPage() {
        $login_Controller = new Login_Controller();
        $login_Controller->controlForm();

        if(!Session_Model::getLoginStat()) {
            $login_Controller->printLoginView();

            die();
        }
    }
}