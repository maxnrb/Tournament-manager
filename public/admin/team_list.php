<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/TeamList_Controller.php');

$TeamList_Controller = new TeamList_Controller();
$TeamList_Controller->printTeamList();