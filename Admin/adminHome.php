<?php
	/**
		This is a dashboard for Administrators that would manage all the modules
	**/
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_name = htmlspecialchars($_SESSION['name']);
	$session_admin_type = htmlspecialchars($_SESSION['type']);
	if (!$session_admin_user) {
		header("location: index.php");
	} 

	include ('../connection.php');
	include ('../function/function.php');

	$notif_request_sql = mysqli_query($conn, "SELECT book_requestID FROM book_request WHERE Status = 'Pending'");
	$notif_request_count = mysqli_num_rows($notif_request_sql);

	$notif_reserved_sql = mysqli_query($conn, "SELECT book_reservationID FROM reservation WHERE Status = 'Pending'");
	$notif_reserved_count = mysqli_num_rows($notif_reserved_sql);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="author" content="College of Theology Library">
  	<meta http-equiv="Content-Type" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body oncontextmenu="return false" class="fixed-sn cyan lighten-5" onload="startTime()">
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
    <a class="navbar-brand" href="#"><img src="../img/logo/cot2.jpg" alt="Logo" height="30" width="30"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbar">
  	<ul class="navbar-nav mr-auto">
  		<li class="nav-item">
            <a class="nav-link text-white" href="adminHome.php"><span class="fa fa-home"></span> Home<span class="sr-only">(current)</span></a>
        </li>
  	</ul>
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-bell-o"></span> Notifications <span title="Requested Books">(<?php echo htmlspecialchars($notif_request_count); ?>)</span> <span title="Reserved Books">(<?php echo htmlspecialchars($notif_reserved_count); ?>)</span> </a>
				<div class="dropdown-menu">
					<?php
						notification_user_book_request();
					?>
					<hr class="theo-footer-hr">
					<?php
						notification_user_reserve_book();
					?>
					<a href="notifications.php"><u>View All Notifications</u></a>
				</div>
		</li>
    	<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo htmlspecialchars($session_admin_user); ?></a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#"><span class="fa fa-dashboard"></span> Dashboard</a>
					<a class="dropdown-item" href="admin-account.php?<?php echo htmlspecialchars($session_admin_user); ?>"><span class="fa fa-user"></span> Profile</a>
					<a class="dropdown-item" href="admin-edit-contact.php"><span class="fa fa-cog"></span> Settings</a>
					<a class="dropdown-item" href="adminLogout.php"><span class="fa fa-sign-out"></span> Logout</a>
				</div>
		</li>
    </ul>
  </div>
</nav><br><br><br>
<h6 class="pull-right" id="date_time"></h6>
<div class="container">
		<div class="page-header">
			<h1>Hello, <?php echo htmlspecialchars($session_admin_name); ?>
			<br></h1>
				<h5><span class="font-weight-bold"><?php echo htmlspecialchars($session_admin_type); ?></span> of College of Theology Library</h5>
		</div>
		<hr class="theo-footer-hr">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="my-4 text-center">Library Administration</h2>
			</div>
			<!-- View Users -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="view_users.php"><img src="../img/icons/user_acc.svg" height="200px;" width="200px;"><h3>User Accounts<br><?php numberOfUsers(); ?></h3></a>
			</div>
			<!-- Post an Annoucement -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="announcement.php"><img src="../img/icons/annoucement2.svg" height="200px;" width="200px;"><h3>Manage Annoucements<br><?php numberOfAnnouncements(); ?></h3></a>
			</div>
			<!-- View Admin Account -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-account-management.php"><img src="../img/icons/admin.svg" height="200px;" width="200px;"><h3>Management Admins<br><?php numberOfAdmins(); ?></h3></a>
			</div>
			<!-- View Book Information -->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-books.php"><img src="../img/icons/book2.svg" height="200px;" width="200px;"><h3>Manage Books<br><?php numberOfBooks();  ?></h3></a>
			</div>
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-locate-books.php"><img src="../img/icons/locate_books.png" height="200px;" width="200px;"><h3>Locate Books<br><?php numberOfBooks();  ?></h3></a>
			</div>
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-reservation.php"><img src="../img/icons/reservation.png" height="200px" width="200px;"><h3>Manage Reserved Books<br><?php numberOfReservation(); ?></h3></a>
			</div>
			<!--Manage Requested Books-->
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-requested-books.php"><img src="../img/icons/view-requested.png" height="200px;" width="200px;"><h3>Manage Requested Books<br><?php numberOfRequest(); ?></h3></a>
			</div>
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-view-feedbacks.php"><img src="../img/icons/feedback.svg" height="200px;" width="200px;"><h3>Manage Feedbacks<br><?php numberOfFeedbacks(); ?></h3></a>
			</div>
			<div class="col-lg-4 col-sm-6 text-center mb-4">
				<a style="text-decoration: none;" href="admin-manage-close-accounts.php"><img src="../img/icons/close_account.svg" height="200px;" width="200px;"><h3>Close Accounts<br><?php numberOfCloseAccounts(); ?></h3></a>
			</div>
		</div>
	</div>
	<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
        <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
    </div>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.12/js/mdb.min.js"></script>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('date_time').innerHTML = today;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

/*Night Mode*/
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});
</script>
</body>
</html>
