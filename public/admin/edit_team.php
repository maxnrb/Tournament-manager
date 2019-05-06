<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 01/05/2019
 * Time: 22:24
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/EditTeam_Controller.php');

$editTeam_Controller = new EditTeam_Controller();
$editTeam_Controller->checkTeamEdit();
$editTeam_Controller->printView();