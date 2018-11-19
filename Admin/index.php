<!DOCTYPE html>
<?php 
	include('../connection.php');
    include('../function/function.php');

    adminLogin();
 ?>
<html>
<head>
	<title>College of Theology Library</title>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
    <style>.error{font-size: 25px;}</style>
</head>
<body class="elegant-color-dark">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center text-white mb-4"> College of Theology Administration</h2>
				<div class="row">
					<div class="col-md-6 mx-auto">
						<div class="card rounded-0 cyan darken-5">
							<div class="card-header cyan lighten-4">
								<h3 class="text-center"><span class="fa fa-sign-in"></span> Log In Credentials</h3>
							</div>
							<div class="card-body">
								<form class="form" method="POST" role="form" autocomplete="off" id="formLogin">
									<div class="md-form">
                                        <i class="fa fa-user prefix text-white"></i>
										<input class="form-control form-control-lg rounded-0" type="text" name="admin_user" id="admin_user" required>
                                        <label class="text-white" for="username">Username</label>
									</div>
									<div class="md-form">
                                        <i class="fa fa-lock prefix text-white"></i>
										<input class="form-control form-control-lg rounded-0" type="password" name="admin_pass" id="admin_pass" required="" autocomplete="new-password">
                                        <label class="text-white" for="password">Password</label>
									</div>
									<button class="btn btn-success btn-lg float-right" type="submit" name="login" id="btnLogin"><i class="fa fa-sign-in"></i> Login
									</button>
								</form>
								<!--<div class="form-group">
									<p><a class="btn btn-dark" href="signup.php">Create Account</a></p>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--JavaScript Libraries-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="..js/popper.min.js"></script>
    <script src="../js/mdb.min.js"></script>
</body>
</html>