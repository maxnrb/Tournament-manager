<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 23:20
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/Session_Controller.php');

$sessionController = new Session_Controller();
$sessionController->protectedPage();

echo "salut";