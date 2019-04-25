<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:36
 */

require(dirname(__DIR__) . '/model/TournamentList_Model.php');

class TournamentList_Controller {
    private $TournamentList_Model;

    public function __construct() {
        $this->TournamentList_Model = new TournamentList_Model();
    }

    public function printTournamentList() {
        $tournaments = $this->TournamentList_Model->fetchAllTournaments();

        if ($tournaments != null) {
            require_once(dirname(__DIR__) . '/view/tournList-view.php');
        } else {
            echo "Aucun tournois !";
        }
    }
}