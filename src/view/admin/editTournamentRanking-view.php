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

        <?php //include "navbar-view.php";?>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Edit tournament</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="index.php"><i class="fas fa-user"></i> Admin</a></div>
                        <div class="breadcrumb-item"><a href="tournament.php"><i class="fas fa-trophy"></i> Tournament</a></div>
                        <div class="breadcrumb-item active" aria-current="page"><i class="fas fa-pencil-alt"></i> Edit - Ranking</a></div>
                    </div>
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
                                <a class="nav-link" href="tournament.php?editTournament=<?php echo $tournament_id; ?>&view=match"><i class="fas fa-calendar-alt"></i> Match</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="tournament.php?editTournament=<?php echo $tournament_id; ?>&view=ranking"><i class="fas fa-trophy"></i> Ranking</a>
                            </li>
                        </ul>
                        </p>
                    </div>


                    <?php $dayNumber = 0;
                    if($rankingLists != null) {
                        foreach ($rankingLists as $rankingList) { ?>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Match day <?php echo $dayNumber; ?> :</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                            <tr>
                                                <th>Ranking</th>
                                                <th>Team Id</th>
                                                <th>Nb Point</th>
                                                <th>Win Match</th>
                                                <th>Loose Match</th>
                                                <th>Draw Match</th>
                                                <th>Goal Favor</th>
                                                <th>Goal Against</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php

                                            $rankNb = 1;
                                            foreach ($rankingList as $ranking) { ?>

                                                <tr>
                                                    <td><?php echo $rankNb; ?></td>
                                                    <td><?php echo $ranking->getTeamId(); ?></td>
                                                    <td><?php echo $ranking->getTeamPoint(); ?></td>
                                                    <td><?php echo $ranking->getWinMatch(); ?></td>
                                                    <td><?php echo $ranking->getLostMatch(); ?></td>
                                                    <td><?php echo $ranking->getDrawMatch(); ?></td>
                                                    <td><?php echo $ranking->getTotalGoalFavor(); ?></td>
                                                    <td><?php echo $ranking->getTotalGoalDifference(); ?></td>

                                                </tr>

                                                <?php
                                                $rankNb++;
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