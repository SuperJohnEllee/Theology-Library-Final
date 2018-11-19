<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	include('../connection.php');
	include('../function/function.php');

	if (!$session_admin_user) {
		header("location: index.php");
	}

	//function change password
	adminChangePassword();
?>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="author">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4" role="document">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br>
	<div class="container"><br>
		<div class="page-header">
			<h1>
				Change Password
				<small> for account <i class="text-warning"><?php echo $session_admin_user; ?></i></small>
			</h1>
			<hr class="theo-footer-hr">
		</div>
		<div class='row'>
			<div class='col-lg-7'>
				<div id='CP_msgbox'></div>
				<form id='ChangePassForm' action='' method='post'>

					<!--Current Password-->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='oldpass' maxlength='50' id='oldpassword' required>
					<label>Current Password</label>
				</div>

					<!-- New Password -->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='newpass' maxlength='50' id='newpassword' required>
					<label>New Password</label>
				</div>

					<!-- Retype Password-->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='conf_pass' maxlength='50' id='conf_pass' required>
					<label>Retype Password</label>
				</div>
				<div class='form-group'>
					<button type='submit' name='btn_change' class='btn btn-primary' id='ChangePassForm_Submit' data-loading-text='Changing Password...''><span class='fa fa-download'></span> Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/mdb.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>