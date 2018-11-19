<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	include('../connection.php');
	include('../function/function.php');
	
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");	
	}

	//Request
	$notif_sql_request = mysqli_query($conn, "SELECT book_requestID FROM book_request WHERE Status = 'Pending'");
	$notif_sql_request_count = mysqli_num_rows($notif_sql_request);

	//Reservation
	$notif_sql_reservation = mysqli_query($conn,"SELECT book_reservationID FROM reservation WHERE Status = 'Pending'");
	$notif_sql_reservation_count = mysqli_num_rows($notif_sql_reservation);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=Edge">
	<meta name="author" name="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#">
			<img src="../img/logo/cot2.jpg" height="30" width="30">
		</a>
			<button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<h1 class="text-center">Your Notifications <br><span>For Request (<?php echo $notif_sql_request_count; ?>)</span><span> ----- For Reservation (<?php echo $notif_sql_reservation_count; ?>)</span></h1>
		<div class="page-header">
			<h3>Your Notifications</h3>
			<hr>
		</div>
		<p>New</p>
		<h3><span>For Request</span><?php notification_book_request(); ?></h3>
		<br><hr class="theo-footer-hr">
		<h3><span>For Reservation</span><?php notification_reserve_book(); ?></h3>
	</div>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>
<script src=../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>