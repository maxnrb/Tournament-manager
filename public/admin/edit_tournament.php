<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:32
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/EditTourn_Controller.php');

$EditTourn_Controller = new EditTourn_Controller();
$EditTourn_Controller->printView();