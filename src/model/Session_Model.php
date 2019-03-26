<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/03/2019
 * Time: 22:20
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

class Session_Model {
    public static function getLoginStat() {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function disconnection() {
        session_destroy();
        unset($_SESSION);
    }
}