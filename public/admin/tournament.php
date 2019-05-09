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

$sessionController = new Session_Controller();
$sessionController->protectedPage();
$sessionController->checkDisconnect();

$tournamentList_Controller = new TournamentList_Controller();
$tournamentList_Controller->newTournamentController();
$tournamentList_Controller->actionsController();
$tournamentList_Controller->matchActionsController();
$tournamentList_Controller->viewController();