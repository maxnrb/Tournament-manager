<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04/04/2019
 * Time: 08:37
 */

require_once('ConnectionDB_Model.php');
require_once('Tournament_Model.php');

class TournamentList_Model {
    private $tournamentList = array();

    public function loadAllTournaments() {
        $dbModel = new ConnectionDB_Model();

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

    public function loadByBufferList($bufferList) {
        $dbModel = new ConnectionDB_Model();

        $statement = "SELECT * FROM `tournament` WHERE ";

        $nbPlayDay = count($bufferList);
        $count = 1;

        foreach ($bufferList as $buffer) {
            $tournament_id = $buffer->getTournamentId();

            $statement = $statement . "tournament_id=$tournament_id";

            if($count < $nbPlayDay) {
                $statement = $statement . " OR ";
                $count++;
            }
        }

        $query = $dbModel->getConnection()->prepare($statement);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }
}