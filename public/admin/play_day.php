<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 21:16
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/PlayDay_Controller.php');

$playDay_Controller = new PlayDay_Controller();
$playDay_Controller->playNextDay();