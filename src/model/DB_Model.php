<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 24/03/2019
 * Time: 23:29
 */

require_once(dirname(dirname(__DIR__)) . '/config/DB_Info.php');

class DB_Model extends DB_Info {
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw $e;
            // TODO Add error if connection to DB is impossible
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function verifyAvailabilityName($name, $tableName) {
        $query = $this->getConnection()->prepare("SELECT count(*) FROM $tableName WHERE name =?");
        $query->execute(array($name));
        $data = $query->fetch();

        if($data['count(*)'] != 0) {        // Team name already used in bdd
            return false;
        } else {
            return true;
        }
    }

    public function editProperty($id, $tableName, $propertyName, $value) {
        $id_name = $tableName . '_id';
        $query = $this->getConnection()->prepare("UPDATE $tableName SET $propertyName='$value' WHERE $id_name='$id'");
        $query->execute();
    }

    public function deleteLineById($id, $tableName) {
        $id_name = $tableName . '_id';
        $query = $this->getConnection()->prepare("DELETE FROM $tableName WHERE $id_name='$id'");
        return $query->execute();
    }

    public function __destruct() {
        $this->connection = null;
    }
}