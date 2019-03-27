<?php
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'/assets/css/login/util.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL.'/assets/css/login/main.css'; ?>">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form action='' method='post' class="login100-form flex-sb flex-w">
					<input type='hidden' name='CSRF_token' value='<?php echo $CSRF_token; ?>'>

					<span class="login100-form-title p-b-32">
						Admin Login
					</span>

					<span class="txt1 p-b-11">
                        <?php
                        if($error_msg != null) {
                            echo '<h3 style="color: red">' . $error_msg . '</h3><br>';
                        }
                        ?>

						Username
					</span>
					<div class="wrap-input100 m-b-36">
						<input class="input100" type="text" name="username" required>
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 m-b-40">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password" pattern='.{5,}' title='5 characters min.' required>
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<button type="submit" value="submit" class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>


	<script src="<?php echo BASE_URL.'/assets/js/jquery-3.2.1.min.js'; ?>"></script>
	<script src="<?php echo BASE_URL.'/assets/js/login/main.js'; ?>"></script>

</body>
</html>