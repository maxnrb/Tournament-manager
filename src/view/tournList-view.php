<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 25/04/2019
 * Time: 09:07
 */
?>

    <table class="orders_details" width="40%" border="0" cellspacing="0" cellpadding="5" style="text-align:center">
    <tr>
        <th>Tourn ID</th>
        <th>Tourn Name</th>
        <th>Nb Teams</th>
    </tr>
<?php

foreach ($tournamentList as $tournament) {
    $tournament_id = $tournament->getTournamentId();

    echo "<td>" . $tournament_id . "</td>" .
        "<td>" . $tournament->getName() . "</td>" .
        "<td>" . $tournament->getNbTeams() . "</td>" .
        "<td>" .

        '<form method="POST" action="edit_tournament.php">
            <input type="hidden" name="tournament_id" value=' . $tournament_id . '>
            <input type="submit" value="Edit">
        </form>' .
        '<a href="view-admin.php?action=deleteStudent&id=' . $tournament_id . '" style="text-decoration: none"> Suppr</a>';


    echo "</td>" . "</tr>";
}