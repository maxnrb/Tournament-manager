<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:37
 */

require_once('DB_Model.php');
require_once('Tournament_Model.php');

class TournamentList_Model {
    private $tournamentList = array();

    public function loadAllTournaments() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM tournament");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function hydrate($tournaments = array()) {
        if ($tournaments != null) {
            foreach ($tournaments as $tournament) {
                $this->addTournament($tournament);
            }
        }
    }

    protected function addTournament($tournament) {
        $this->tournamentList[$tournament['tournament_id']] = Tournament_Model::loadFromArray($tournament);
    }

    public function getTournamentList() { return $this->tournamentList; }
}