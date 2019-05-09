<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/03/2019
 * Time: 09:01
 */

spl_autoload_register(function($className) { require_once dirname(__DIR__) . '/src/controller/' . $className . '.php'; });

$newTeamController = new NewTeam_Controller();
$newTeamController->controlForm();
$newTeamController->printForm();