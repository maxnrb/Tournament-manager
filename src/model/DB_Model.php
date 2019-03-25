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
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        $this->connection = null;
    }
}