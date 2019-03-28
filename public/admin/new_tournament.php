<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 23:37
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/NewTourn_Controller.php');

$newTournamentController = new NewTourn_Controller();
$newTournamentController->controlForm();