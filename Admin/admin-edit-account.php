<?php
	include('../connection.php');
	include('../function/function.php');
	session_start();
	session_set_cookie_params(432000);
	$session_admin_id = htmlspecialchars($_SESSION['admin_id']);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_firstname =htmlspecialchars($_SESSION['firstname']);
	$session_admin_midname = htmlspecialchars($_SESSION['midname']);
	$session_admin_lastname = htmlspecialchars($_SESSION['lastname']);
	if (!$_SESSION['admin_user']) {
		header("location: index.php");
	}

	adminUpdateAccount();
?>

<!DOCTYPE html>
<html>
<head>
	<title>College of Theology Administration</title>
	<meta http-equiv="Content-Type" charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbar" aria-controls="navbar" aria-expanded="false" aria-lablled="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>   
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br><br>
	<h1 class="text-center"><span class="fa fa-edit"></span> Update Account Profile</h1>
	<div class="container">
		<div class="page-header">
			<h1>Edit Profile
				<small> for account <i class="text-warning"><?php echo $session_admin_user; ?></i></small>
			</h1>
		</div>
		<hr class="divider">
		<div class="col-md-9 personal-info">
			<form class="form-horizontal" role="form" method="post">
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="hidden" name="id" value="<?php echo $session_admin_id; ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="admin_lname" value="<?php echo $session_admin_lastname ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="admin_fname" placeholder="First Name" value="<?php echo $session_admin_firstname; ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="admin_mname" value="<?php echo $session_admin_midname?>">
				</div>
				<div class="md-form">
					<i class="fa fa-user prefix"></i>
					<input class="form-control" type="text" name="admin_user" value="<?php echo $session_admin_user ?>">
				</div>
				<div class="form-group">
					<div class="col-md-9">
						<div class="input-group">
							<button class="btn btn-primary" type="submit" name="save_admin"><span class="fa fa-save"></span> Save Changes</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
<!--JavaScript Libraries-->
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="..js/mdb.min.js"></script>
</body>
</html>