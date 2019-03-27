<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 27/03/2019
 * Time: 17:19
 */

class match {
    private $day_id;
    private $team1_id;
    private $team2_id;
    private $team1_score;
    private $team2_score;

    public function __construct($team1_id, $team2_id) {
        $this->team1_id = $team1_id;
        $this->team2_id = $team2_id;
    }
}

$teams = array('team1','team2','team3','team4', 'team5', 'team6', 'team7');
$nbTeams = count($teams);

if($nbTeams%2 != 0) {
    array_push($teams, 'rest_day');
    $nbTeams++;
}

shuffle($teams);    // Random teams

$visitors = array_splice($teams, $nbTeams/2);
$home = $teams;

for ($dayNumber = 1; $dayNumber < $nbTeams; $dayNumber++) {
    print_r($home);
    echo '<br>';
    print_r($visitors);
    echo '<br><br>';

    for ($i = 0; $i < $nbTeams/2; $i++) {
        $days[$dayNumber][$i] = new match($home[$i], $visitors[$i]);
    }

    $var1_array = array_splice($home, 1, 1);  // Return an array
    $var2_string = array_pop($visitors);   // Return a string

    array_unshift($visitors, $var1_array[0]);
    array_push($home, $var2_string);
}

var_dump($days);




