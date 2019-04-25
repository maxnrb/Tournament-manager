<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:34
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/TournamentList_Controller.php');

$TournamentList_Controller = new TournamentList_Controller();
$TournamentList_Controller->printTournamentList();