<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require_once('ConnectionDB_Model.php');
require_once('Team_Model.php');
require_once('BufferList_Model.php');

class TeamList_Model {
    private $bufferList_Model;

    private $teamList = array();
    private $addTeamList = array();

    private $associativeName = array();

    public function loadAllTeams() {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM team");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function loadAssociativeName() {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT team_id, name FROM team");
        $query->execute();
        $teamList = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($teamList as $team) {
            $this->associativeName[ $team['team_id'] ] = $team['name'];
        }
    }

    public function loadOnlyBufferTeams($tournament_id) {
        $dbModel = new ConnectionDB_Model();
        $this->bufferList_Model = new BufferList_Model();

        $this->bufferList_Model->loadByTournamentId($tournament_id);
        $bufferList = $this->bufferList_Model->getBufferList();

        foreach ($bufferList as $buffer) {
            $team_id = $buffer->getTeamId();

            $query = $dbModel->getConnection()->prepare("SELECT * FROM team WHERE team_id='$team_id'");
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $this->pushAddTeam($data);
        }
    }

    public function hydrate($teams = array()) {
        if ($teams != null) {
            foreach ($teams as $team) {
                $this->pushTeam($team);
            }
        }
    }

    protected function pushTeam($team) {
        $this->teamList[ $team['team_id'] ] = Team_Model::loadFromArray($team);
    }

    protected function pushAddTeam($team) {
        $this->addTeamList[ $team['team_id'] ] = Team_Model::loadFromArray($team);
    }


    public function getTeamList() { return $this->teamList; }
    public function getAddTeamList() { return $this->addTeamList; }

    public function parseFromBufferTeams($tournament_id) {
        $this->bufferList_Model = new BufferList_Model();
        $this->bufferList_Model->loadByTournamentId($tournament_id);

        $bufferList = $this->bufferList_Model->getBufferList();
        $teamList = $this->getTeamList();

        foreach ($teamList as $team) {
            $team_id = $team->getTeamId();

            foreach ($bufferList as $buffer) {
                if($team_id  == $buffer->getTeamId() ) {
                    $this->addTeamList[ $team_id ] = $this->teamList[ $team_id ];
                    unset( $this->teamList[ $team_id ] );
                }
            }
        }
    }

    public function searchNameById($team_id) {
        return $this->associativeName[$team_id];
    }

}