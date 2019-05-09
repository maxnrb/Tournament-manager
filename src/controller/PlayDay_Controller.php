<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28/04/2019
 * Time: 21:16
 */

if (session_status() == PHP_SESSION_NONE) { session_start(); }

spl_autoload_register(function($className) {
    $dir = strtolower(substr(strrchr($className, '_'), 1));
    require_once dirname(dirname(__DIR__)) . '/src/' . $dir . "/" . $className . '.php';
});

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

    public function playNextDay($tournament_id) {
        $status = Tournament_Model::getStatusByID($tournament_id);

        if($status >= 11) {
            $dayNumber = $status - 10;

            $dbModel = new DB_Model();

            $query = $dbModel->getConnection()->prepare("SELECT day_id FROM day WHERE tournament_id='$tournament_id' && dayNumber='$dayNumber'");
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $day_id = $data['day_id'];

            $query = $dbModel->getConnection()->prepare("SELECT match_id FROM `match` WHERE day_id='$day_id'");
            $query->execute();
            $matchList = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($matchList as $match) {
                $match_id = $match['match_id'];
                $score1 = $this->getRandomScore();
                $score2 = $this->getRandomScore();

                $query = $dbModel->getConnection()->prepare("UPDATE `match` SET team1_score='$score1', team2_score='$score2' WHERE match_id='$match_id'");
                $query->execute();
            }

            $query = $dbModel->getConnection()->prepare("UPDATE day SET played=true WHERE day_id='$day_id'");
            $query->execute();

            Tournament_Model::incrementStatus($tournament_id);
            iziToast_Model::printNotification('success', 'Day played successfully');
        } elseif ($status == 0) {
            iziToast_Model::printNotification('warning', 'Please add team for generation');
        } elseif ($status == 1) {
            iziToast_Model::printNotification('warning', 'Please generate days');
        } elseif ($status == 2) {
            iziToast_Model::printNotification('warning', 'Tournament finished');
        }

    }
}