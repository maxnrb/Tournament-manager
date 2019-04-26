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

foreach ($tournamentsObj as $tournament) {
        echo "<td>" . $tournament->getTournamentId() . "</td>";

    $tournament_id = $tournament['tournament_id'];
    echo "<td>";
    echo '<a href="view-admin.php?action=deleteStudent&id=' . $tournament_id . '" style="text-decoration: none">Suppr </a>' .
        '<a href="view-edit_etudiant.php?action=getStudent&id=' . $tournament_id . '" style="text-decoration: none"> Edit</a>';

    echo "</td>" . "</tr>";
}