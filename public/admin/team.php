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

$team_Controller = new Team_Controller();
$team_Controller->actionsController();
$team_Controller->controlForm();
$team_Controller->viewController();