<?php
define('BASE_URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>User</title>

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
                    <h1>User</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="index.php"><i class="fas fa-user"></i> Admin</a></div>
                        <div class="breadcrumb-item active" aria-current="page"><i class="fas fa-futbol"></i> User</a></div>
                    </div>
                </div>

                <div class="section-body">

                    <div class="row">
                        <div class="col-12">

                            <?php if ($this->editionMode == true) { ?>
                                <div class="card card-warning">
                                        <form action='' method="POST" enctype="multipart/form-data">

                                    <div class="card-header">
                                        <h4>Edit admin :</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-row">

                                            <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">
                                            <input type="hidden" name="form" value="edit">

                                            <div class="form-group col-md"  >
                                                <input type="text" name="name" class="form-control" placeholder="<?php echo $this->admin_Model->getName(); ?>"/>
                                                <label>Admin name</label>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="password" id="inputPassword5" class="form-control" pattern=".{5,}" name="password" placeholder="Password" title="5 char min">
                                                <label for="inputPassword5">Password</label>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="password" id="inputPassword5" class="form-control" pattern=".{5,}" name="password" placeholder="Confirmation Password" title="5 char min">
                                                <label for="inputPassword5">Confirmation password</label>
                                            </div>

                                            <div class="my-1">
                                                <button data-toggle="tooltip" title="Create" type="submit" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div>
                            <?php } else { ?>
                                <div class="card card-primary">

                                    <script>
                                        document.write("<form class=\"needs-validation\"  novalidate=\"\" action='' method=\"POST\" enctype=\"multipart/form-data\">");
                                    </script>

                                    <noscript>
                                        <form class="needs-validation" action='' method="POST" enctype="multipart/form-data">
                                    </noscript>

                                    <div class="card-header">
                                        <h4>Create new admin :</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-row">

                                            <input type="hidden" name="CSRF_token" value="<?php echo $CSRF_token; ?>">
                                            <input type="hidden" name="form" value="create">

                                            <div class="form-group col-md">
                                                <input type="text" name="name" class="form-control" placeholder="Name" required/>
                                                <label>Team name</label>
                                                <div class="invalid-feedback">
                                                    Choose a name !
                                                </div>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <input type="password" id="inputPassword5" class="form-control" pattern=".{5,}" name="password" placeholder="Password" title="5 char min" required>
                                                <label for="inputPassword5">Password</label>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <input type="password" id="inputPassword5" class="form-control" pattern=".{5,}" name="password" placeholder="Confirmation Password" title="5 char min" required>
                                                <label for="inputPassword5">Confirmation password</label>
                                            </div>

                                            <div class="my-1">
                                                <button data-toggle="tooltip" title="Create" type="submit" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                </div>
                            <?php } ?>

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>List of all admins :</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                            <tr>
                                                <th>Admin Name</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            foreach ($adminList as $admin) {
                                                $admin_id = $admin->getAdminId();
                                                $admin_mane = $admin->getName();
                                                ?>

                                                <tr>
                                                    <td><?php echo $admin_mane; ?></td>
                                                    <td>
                                                        <form method="POST" action="" style="display: inline-block;">
                                                            <input type="hidden" name="admin_id" value='<?php echo $admin_id; ?>'>
                                                            <input type="hidden" name="action" value="edit">
                                                            <button data-toggle="tooltip" title="Edit" type="submit" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></button>
                                                        </form>

                                                        <form method="POST" action="" style="display: inline-block;">
                                                            <input type="hidden" name="admin_id" value='<?php echo $admin_id; ?>'>
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