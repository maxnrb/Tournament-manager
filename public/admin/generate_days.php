<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 19:16
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/GenerateDays_Controller.php');

$generateDays_Controller = new GenerateDays_Controller();
$generateDays_Controller->generateDays();