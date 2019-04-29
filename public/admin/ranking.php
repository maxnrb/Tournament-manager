<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 29/04/2019
 * Time: 00:05
 */

require_once(dirname(dirname(__DIR__)) . '/src/controller/Ranking_Controller.php');

$ranking_Controller = new Ranking_Controller();
$ranking_Controller->getRanking();