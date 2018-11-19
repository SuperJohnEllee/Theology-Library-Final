<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = htmlspecialchars($_SESSION['admin_user']);
	$session_name = htmlspecialchars($_SESSION['name']);
	$session_type = htmlspecialchars($_SESSION['type']);

	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}
	include ('../connection.php');
	include('../function/function.php');
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body id="body" onload="startTime()" oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
    <a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" alt="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler grey darken-2 text-white" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>      	
      </div>
  <div class="collapse navbar-collapse" id="navbar">
  	<ul class="navbar-nav mr-auto">
  		<li class="nav-item">
  			<a class="nav-link text-white" href="theology-dashboard.php"><span class="fa fa-home"></span> Home</a>
  		</li>
  	</ul>
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item">
    		<a class="nav-link text-white" href="#"><i class="fa fa-bell-o"></i>&nbsp;Notifications</a>
    	</li>
    	<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo htmlspecialchars($session_user); ?></a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#">Dashboard</a>
				<a class="dropdown-item" href="admin-account.php?<?php echo htmlspecialchars($session_user); ?>"><span class="fa fa-user"></span> Profile</a>
				<a class="dropdown-item" href="admin-change-password.php"><span class="fa fa-cog"></span> Settings</a>
				<a class="dropdown-item" href="adminLogout.php"><span class="fa fa-sign-out"></span> Logout</a>
			</div>
		</li>
    </ul>
  </div>
</nav><br><br><br>
<h6 class="pull-right" id="date_time"></h6>
<div class="container">
	<div class="page-header">
		<h1>Hello, <?php echo htmlspecialchars($session_name); ?></h1>
			<h5><span class="font-weight-bold"><?php echo htmlspecialchars($session_type); ?></span> of College of Theology</h5>
	</div>
	<hr class="theo-footer-hr">
	<div class="row">
		<div class="col-lg-12">
				<h1 class="my-4 text-center"> Administration</h1>
			</div>
			<!-- View Users -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="view_users.php"><img src="../img/icons/view-users.png" height="200px;" width="200px;"><h3>User Accounts<br><?php numberOfUsers(); ?></h3></a>
			</div>
			<!-- Post an Annoucement -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="announcement.php"><img src="../img/icons/annoucement.png" height="200px;" width="200px;"><h3>Manage Annoucements<br><?php numberOfAnnouncements(); ?></h3></a>
			</div>
			<!--View User Feedback-->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-feedbacks.php"><img src="../img/icons/feedback.svg" height="200px;" width="200px;"><h3>User Feedback<br><?php numberOfFeedbacks(); ?></h3></a>
			</div>
	</div>
</div>
<div style="padding: 15px 0;" class="fixed-bottom mdb-color darken-4 text-center text-white">
	<h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
</div>
<!--JavaScript Libraries-->
<script src="../js/style.js"></script>
<script src="../js/jquery.js"></script>
<script src="..js/bootstrap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>