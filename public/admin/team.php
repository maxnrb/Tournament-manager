<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});
$sessionController = new Session_Controller();
$sessionController->protectedPage();
$sessionController->checkDisconnect();

$newTeam_Controller = new NewTeam_Controller();
$newTeam_Controller->controlForm();

$teamList_Controller = new TeamList_Controller();
$teamList_Controller->actionsController();
$teamList_Controller->printAllTeams();