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

    echo "<td>";
    echo '<a href="view-admin.php?action=deleteStudent&id=' . $team_id . '" style="text-decoration: none">Suppr </a>' .
        '<a href="view-edit_etudiant.php?action=getStudent&id=' . $team_id . '" style="text-decoration: none"> Edit </a>' .
        '<form method="POST" action="">
            <input type="hidden" name="team_id" value=' . $team_id . '>
            <input type="submit" value="Add to Tourn">
        </form>';

    echo "</td>" . "</tr>";
}