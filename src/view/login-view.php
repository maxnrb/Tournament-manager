<?php
define('BASE_URL', rtrim( dirname(dirname($_SERVER['SCRIPT_NAME'])) , '/public'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>

  <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/bootstrap/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/modules/fontawesome/css/all.min.css'; ?>">

  <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/css/style.css'; ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL.'/assets/css/components.css'; ?>">


<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../../tests/stisla-2.2.0/dist/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                    <script>
                        document.write("<form method=\"POST\" action=\"\" class=\"needs-validation\" novalidate=\"\">");
                    </script>

                    <noscript>
                        <form method="POST" action="" class="needs-validation">
                    </noscript>


                    <input type='hidden' name='CSRF_token' value='<?php echo $CSRF_token; ?>'>

                    <div class="form-group">
                    <label for="text">Username</label>
                    <input id="text" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username !
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        Please fill in your password !
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="<?php echo BASE_URL.'/assets/modules/jquery.min.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/modules/popper.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/modules/tooltip.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/modules/bootstrap/js/bootstrap.min.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/modules/nicescroll/jquery.nicescroll.min.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/modules/moment.min.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/js/stisla.js'; ?>"></script>

  <script src="<?php echo BASE_URL.'/assets/js/scripts.js'; ?>"></script>
  <script src="<?php echo BASE_URL.'/assets/js/custom.js'; ?>"></script>

</body>
</html>