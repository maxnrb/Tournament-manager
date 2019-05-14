<?php

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

$sessionController = new Session_Controller();
$sessionController->protectedPage();
$sessionController->checkDisconnect();

$admin_Controller = new Admin_Controller();
$admin_Controller->actionsController();
$admin_Controller->printAllAdmin();