<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:36
 */

require_once(dirname(__DIR__) . '/model/TournamentList_Model.php');

session_start();


class TournamentList_Controller {
    private $tournamentList_Model;

    public function __construct() {
        $this->tournamentList_Model = new TournamentList_Model();
    }

    public function printTournamentList() {
        $this->tournamentList_Model->loadAllTournaments();
        $tournamentList = $this->tournamentList_Model->getTournamentList();

        require_once(dirname(__DIR__) . '/view/tournList-view.php');
    }
}