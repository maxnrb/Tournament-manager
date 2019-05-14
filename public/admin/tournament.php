<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:34
 */

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

$session_Controller = new Session_Controller();
$session_Controller->protectedPage();
$session_Controller->checkDisconnect();

$tournament_Controller = new Tournament_Controller();
$tournament_Controller->newTournamentController();
$tournament_Controller->actionsController();
$tournament_Controller->matchActionsController();
$tournament_Controller->viewController();