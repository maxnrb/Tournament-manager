<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 22:32
 */

class UtilFunc_Model {
    public static function redirect($link) {
        header("Location: $link");
        exit();
    }
}