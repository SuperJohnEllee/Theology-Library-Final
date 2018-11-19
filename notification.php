<!DOCTYPE html>
<?php
	include('connection.php');
	include('session.php');
	include('function/function.php');

	$notif_req_sql = mysqli_query($conn,"SELECT book_requestID FROM book_request INNER JOIN users USING(UsersID)  WHERE UsersID = '$session_id'");
	$notif_req_count = mysqli_num_rows($notif_req_sql);

	$notif_res_sql = mysqli_query($conn, "SELECT book_reservationID FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Approved' AND UsersID = '$session_id'");
	$notif_res_count = mysqli_num_rows($notif_res_sql);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
			<h1 class="text-center">Your Notifications</h1>
		<div class="page-header">
			<h3>Notifications by <span class="font-weight-bold text-warning"><?php echo $session_name; ?></span></h3>
			<hr>
		</div>
		<h2>For Requisition of Books(<?php echo $notif_req_count; ?>)</h2>
		<?php display_notification_requested_approved();
		?>
		<hr>
		<?php display_notification_requested_rejected(); ?>
		<br>
		<h2>For Reservation of Books(<?php echo $notif_res_count; ?>)</h2>
		<?php display_notification_reserve_approved(); ?>
		<hr>
		<?php display_notification_reserve_rejected(); ?>
	</div>

<!-- JavaScript Libraries -->
<script src="js/jquery.min.js"></script>
<script src=js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>