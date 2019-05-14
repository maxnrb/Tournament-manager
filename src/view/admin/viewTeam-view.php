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
                    <h1>View Team</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="index.php"><i class="fas fa-user"></i> Admin</a></div>
                        <div class="breadcrumb-item"><a href="team.php"><i class="fas fa-futbol"></i> Team</a></div>
                        <div class="breadcrumb-item active" aria-current="page"><i class="fas fa-eye"></i> View</a></div>
                    </div>
                </div>

                <div class="section-body">

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon">
                                    <img alt="image" style="display: flex; align-items: center" src="<?php echo BASE_URL . $team_picturePath; ?>" class="rounded" width="80" data-toggle="tooltip" title="Team logo">
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Team Name</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $teamName; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">

                                <div class="card-icon bg-info">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Number of tournaments</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $nbTournaments; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Number of visits</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo  $nbVisits; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>W/L Ratio</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $ratio; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Participating tournaments :</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                            <tr>
                                                <th>Tournament Name</th>
                                                <th>Nb Teams</th>
                                                <th>Nb Add Teams</th>
                                                <th>Teams</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            foreach ($tournamentList as $tournament) {
                                                $tournament_id = $tournament->getTournamentId();
                                                $tournament_name = $tournament->getName();
                                                $tournament_nbTeams = $tournament->getNbTeams();

                                                $statusMsg = $tournament->getStatusMsg();
                                                ?>

                                                <tr>
                                                    <td><?php echo $tournament_name; ?></td>
                                                    <td><?php echo $tournament_nbTeams; ?></td>
                                                    <td>X</td>

                                                    <td>
                                                        <img alt="image" src="<?php echo BASE_URL.'/assets/img/avatar/avatar-1.png'; ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                                        <img alt="image" src="<?php echo BASE_URL.'/assets/img/avatar/avatar-2.png'; ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                                        <img alt="image" src="<?php echo BASE_URL.'/assets/img/avatar/avatar-3.png'; ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                                    </td>
                                                    <td><div class="badge badge-<?php echo $statusMsg["btn"]; ?>"><?php echo $statusMsg["msg"]; ?></div></td>
                                                    <td>
                                                        <form method="POST" action="" style="display: inline-block;">
                                                            <input type="hidden" name="tournament_id" value='<?php echo $tournament_id; ?>'>
                                                            <input type="hidden" name="action" value="view">
                                                            <button data-toggle="tooltip" title="View" type="submit" class="btn btn-icon btn-info"><i class="fas fa-eye"></i></button>
                                                        </form>

                                                        <form method="GET" action="" style="display: inline-block;">
                                                            <input type="hidden" name="editTournament" value='<?php echo $tournament_id; ?>'>
                                                            <button data-toggle="tooltip" title="Edit" type="submit" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></button>
                                                        </form>

                                                        <form method="POST" action="" style="display: inline-block;">
                                                            <input type="hidden" name="tournament_id" value='<?php echo $tournament_id; ?>'>
                                                            <input type="hidden" name="action" value="delete">
                                                            <button data-toggle="tooltip" title="Delete" type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        </form>


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

                        </div>
                    </div>

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