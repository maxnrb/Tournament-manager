<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 21:16
 */

session_start();

require_once(dirname(__DIR__) . '/model/DB_Model.php');

class PlayDay_Controller {
    public function getRandomScore() {
        $random = rand(0, 100);

        switch ($random) {
            case $random < 5 :
                return rand(7,9);
                break;

            case $random >= 5 && $random < 15 :
                return rand(5,6);
                break;

            case $random >= 15 && $random < 25 :
                return 4;
                break;

            case $random >= 25 && $random < 40 :
                return 3;
                break;

            case $random >= 40 :
                return rand(0,2);
                break;
        }
        return null;
    }

    public function playNextDay() {
        $tournament_id = $_SESSION['edit_tournament_id'];

        $dbModel = new DB_Model();

        $query = $dbModel->getConnection()->prepare("SELECT day_id, MIN(dayNumber) FROM day WHERE tournament_id='$tournament_id' && played=false");
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $day_id = $data['day_id'];

        $query = $dbModel->getConnection()->prepare("SELECT match_id FROM `match` WHERE day_id='$day_id'");
        $query->execute();
        $matchList = $query->fetchAll(PDO::FETCH_ASSOC);

        var_dump($matchList);

        foreach ($matchList as $match) {
            $match_id = $match['match_id'];
            $score1 = $this->getRandomScore();
            $score2 = $this->getRandomScore();

            $query = $dbModel->getConnection()->prepare("UPDATE `match` SET team1_score='$score1', team2_score='$score2' WHERE match_id='$match_id'");
            $query->execute();
        }

        $query = $dbModel->getConnection()->prepare("UPDATE day SET played=true WHERE day_id='$day_id'");
        $query->execute();
    }
}