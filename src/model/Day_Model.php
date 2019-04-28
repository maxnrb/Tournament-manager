<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 03:19
 */

require_once('DB_Model.php');

class Day_Model {
    private $day_id;
    private $tournament_id;
    private $dayNumber;
    private $played;

    public static function newDayDB($tournament_id, $dayNumber) {
        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("INSERT INTO day (tournament_id, dayNumber) VALUES (:tournament_id, :dayNumber)");
        $query->execute(array(':tournament_id' => "$tournament_id", ':dayNumber' => "$dayNumber"));

        $query = $dbModel->getConnection()->prepare("SELECT day_id FROM day WHERE tournament_id='$tournament_id' && dayNumber='$dayNumber'");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['day_id'];
    }
}