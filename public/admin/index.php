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
    "<h3><a title='new_admin' href='new_admin.php'>New admin</a></h3>" .
    "<h2>Tournaments</h2>" .
    "<h3><a title='new_tournament' href='new_tournament.php'>New tournament</a></h3>" .
    "<h3><a title='new_team' href='new_team.php'>New team</a></h3>" .
    "<h3><a title='team_list' href='team_list.php'>Team list</a></h3>".
    "<h2>Admin</h2>".
    "<h3><a title='admin_list' href='admin_list.php'>List</a></h3>";

