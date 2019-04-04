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

echo "<h3><a title='home' href='../'>Home</a></h3>" .
    "<h2>Tournaments</h2>" .
    "<h3><a title='new tournament' href='new_tournament.php'>New tournament</a></h3>" .
    "<h3><a title='new admin' href='new_admin.php'>New admin</a></h3>";


