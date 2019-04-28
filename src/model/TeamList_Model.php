<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:15
 */

require_once('DB_Model.php');
require_once('Team_Model.php');
require_once('Buffer_Model.php');

class TeamList_Model {
    private $teamList = array();
    private $addTeamList = array();

    public function loadAllTeams() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM team");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function hydrate($teams = array()) {
        if ($teams != null) {
            foreach ($teams as $team) {
                $this->addTeam($team);
            }
        }
    }

    protected function addTeam($team) {
        $this->teamList[ $team['team_id'] ] = Team_Model::loadFromArray($team);
    }

    public function getTeamList() { return $this->teamList; }
    public function getAddTeamList() { return $this->addTeamList; }

    public function parseWithBufferList($bufferList) {
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

}