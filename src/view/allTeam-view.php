<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:17
 */
?>

    <table class="orders_details" width="40%" border="0" cellspacing="0" cellpadding="5" style="text-align:center">
        <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            <th>Picture</th>
        </tr>
<?php

foreach ($teamList as $team) {
    $team_id = $team->getTeamId();

    echo "<td>" . $team_id . "</td>" .
        "<td>" . $team->getName() . "</td>" .
        "<td>" . $team->getPicturePath() . "</td>";

    echo "<td>" .
        '<form method="POST" action="edit_team.php">
            <input type="hidden" name="team_id" value=' . $team_id . '>
            <input type="submit" value="Edit">
        </form>' .
        '<a href="" style="text-decoration: none">Suppr </a>';

    echo "</td>" . "</tr>";
}