<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/04/2019
 * Time: 20:37
 */

require_once('DB_Model.php');
require_once('Buffer_Model.php');

class BufferList_Model {
    private $bufferList = array();

    public function loadAllBuffer() {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM buffer_teams");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function loadByTournamentId($tournament_id) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT * FROM buffer_teams WHERE tournament_id=?");
        $query->execute(array($tournament_id));
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->hydrate($data);
    }

    public function hydrate($buffers = array()) {
        if ($buffers != null) {
            foreach ($buffers as $buffer) {
                $this->addBuffer($buffer);
            }
        }
    }

    protected function addBuffer($buffer) {
        $this->bufferList[ $buffer['team_id'] ] = Buffer_Model::loadFromArray($buffer);
    }

    public function getBufferList() { return $this->bufferList; }
}