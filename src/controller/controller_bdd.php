<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 22/03/2019
 * Time: 15:10
 */

include "../../config/bddInfo.php";

function connectBD() {
    $host = bddInfo::getHost();
    $dbName = bddInfo::getDbName();

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbName", bddInfo::getUsername(), bddInfo::getPassword());

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connexion BDD : " . $e->getMessage() . "<br>";
        return null;
    }
}

