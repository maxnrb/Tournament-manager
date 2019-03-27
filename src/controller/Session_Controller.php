<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/03/2019
 * Time: 22:20
 */

require(dirname(__DIR__) . '/model/Session_Model.php');
require(dirname(__DIR__) . '/model/UtilFunc_Model.php');

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
        if(!Session_Model::getLoginStat()) {
            require_once(dirname(__DIR__).'/view/beConnected-view.php');
            die();
        }
    }
}