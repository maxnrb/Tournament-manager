<?php
define('BASE_URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Team</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/bootstrap/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/fontawesome/css/all.min.css'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/datatables/datatables.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/css/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/css/components.css'; ?>">
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">

        <?php include "navbar-view.php";?>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Edit tournament</h1>
                </div>

                <div class="section-body">

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tournament Status</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="badge badge-<?php echo $statusMsg["btn"]; ?>"><?php echo $statusMsg["msg"]; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">

                                <div class="card-icon bg-success">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tournament Name</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $tournamentName; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Number of teams</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo  $nbTeams . '<i> (' . ($nbTeams-$nbAddTeams) . ' missing) </i>'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Teams in tournament</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $nbAddTeams; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="section-lead">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="tournament.php?editTournament=<?php echo $tournament_id; ?>&view=teams"><i class="fas fa-futbol"></i> Teams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="tournament.php?editTournament=<?php echo $tournament_id; ?>&view=match"><i class="fas fa-calendar-alt"></i> Match</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="tournament.php?editTournament=<?php echo $tournament_id; ?>&view=ranking"><i class="fas fa-trophy"></i> Ranking</a>
                            </li>
                        </ul>
                        </p>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Tournament Controller :</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-row">


                                <form method="POST" action="" style="display: inline-block;">
                                    <input type="hidden" name="tournament_id" value='<?php echo $tournament_id; ?>'>
                                    <input type="hidden" name="action" value="generateDays">
                                    <button data-toggle="tooltip" title="Generate Days" type="submit" class="btn btn-icon btn-success"><i class="fas fa-eye"></i> Generate Days</button>
                                </form>

                                <form method="POST" action="" style="display: inline-block;">
                                    <input type="hidden" name="tournament_id" value='<?php echo $tournament_id; ?>'>
                                    <input type="hidden" name="action" value="playDay">
                                    <button data-toggle="tooltip" title="Play Day" type="submit" class="btn btn-icon btn-info"><i class="fas fa-edit"></i> Play Next Day</button>
                                </form>

                                <form method="POST" action="" style="display: inline-block;">
                                    <input type="hidden" name="tournament_id" value='<?php echo $tournament_id; ?>'>
                                    <input type="hidden" name="action" value="playAllDays">
                                    <button data-toggle="tooltip" title="Play All Days" type="submit" class="btn btn-icon btn-primary"><i class="fas fa-trash-alt"></i> Play All Days</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <?php $dayNumber = 1;
                    if($matchLists != null) {
                        foreach ($matchLists as $matchList) { ?>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Match day <?php echo $dayNumber; ?> :</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                            <tr>
                                                <th>Team 1</th>
                                                <th>Team 2</th>
                                                <th>Score 1</th>
                                                <th>Score 2</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            foreach ($matchList as $match) {
                                                $team1_id = $match->getTeam1Id();
                                                $team2_id = $match->getTeam2Id();
                                                $team1_score = $match->getTeam1Score();
                                                $team2_score = $match->getTeam2Score();

                                                ?>

                                                <tr>
                                                    <td>
                                                        <img alt="image"
                                                             src="<?php echo BASE_URL . '/assets/img/avatar/avatar-1.png'; ?>"
                                                             class="rounded-circle" width="35" data-toggle="tooltip"
                                                             title="Team logo">
                                                        <?php echo $team1_id; ?>
                                                    </td>

                                                    <td>
                                                        <img alt="image"
                                                             src="<?php echo BASE_URL . '/assets/img/avatar/avatar-2.png'; ?>"
                                                             class="rounded-circle" width="35" data-toggle="tooltip"
                                                             title="Team logo">
                                                        <?php echo $team2_id; ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($team1_score === null) {
                                                            echo 'x';
                                                        } else {
                                                            echo $team1_score;
                                                        }; ?>
                                                    </td>

                                                    <td>
                                                        <?php if ($team2_score === null) {
                                                            echo 'x';
                                                        } else {
                                                            echo $team2_score;
                                                        }; ?>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $dayNumber++;
                        }
                    }?>


                </div>
            </section>
        </div>


        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
</div>

<script src="<?php echo BASE_URL.'/assets/modules/jquery.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/popper.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/tooltip.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/bootstrap/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/nicescroll/jquery.nicescroll.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/moment.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/js/stisla.js'; ?>"></script>

<script src="<?php echo BASE_URL.'/assets/modules/datatables/datatables.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/modules/jquery-ui/jquery-ui.min.js'; ?>"></script>

<script src="<?php echo BASE_URL.'/assets/js/page/modules-datatables.js'; ?>"></script>

<script src="<?php echo BASE_URL.'/assets/js/scripts.js'; ?>"></script>
<script src="<?php echo BASE_URL.'/assets/js/custom.js'; ?>"></script>

<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

</body>
</html