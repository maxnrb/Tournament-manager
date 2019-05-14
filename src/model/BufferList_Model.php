<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/04/2019
 * Time: 20:37
 */

require_once('ConnectionDB_Model.php');
require_once('Buffer_Model.php');

class BufferList_Model {
    private $bufferList = array();

    public function loadAllBuffer() {
        $dbModel = new ConnectionDB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM buffer_teams");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function loadByTournamentId($tournament_id) {
        $connection = new ConnectionDB_Model();

        $this->hydrate( $connection->getAllById('buffer_teams', 'tournament_id', $tournament_id) );
    }

    public function loadByTeamId($team_id) {
        $connection = new ConnectionDB_Model();

        $this->hydrate( $connection->getAllById('buffer_teams', 'team_id', $team_id) );
    }

    public function hydrate($buffers = array()) {
        if ($buffers != null) {
            foreach ($buffers as $buffer) {
                $this->addBuffer($buffer);
            }
        }
    }

    protected function addBuffer($buffer) {
        $this->bufferList[] = Buffer_Model::loadFromArray($buffer);
    }

    public function getBufferList() { return $this->bufferList; }

    public function getNbTournaments($team_id) {
        $count = 0;

        foreach ($this->bufferList as $buffer) {
            if($buffer->getTeamId() == $team_id) {
                $count++;
            }
        }

        return $count;
    }
}