<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:01
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/NewTeam_Controller.php');

$newTeamController = new NewTeam_Controller();
$newTeamController->controlForm();