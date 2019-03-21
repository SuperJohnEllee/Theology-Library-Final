<!DOCTYPE html>
<?php
  include ('connection.php');
  $sql = "SELECT * FROM contact_us";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
?>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<title> College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/animate.css">
  	<link rel="stylesheet" href="css/nav_icons.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
  	<link rel="stylesheet" href="css/mdb.min.css">
  	<style>.img-center{ margin-left: auto; margin-right: auto; display: block; }.links{font-size: 20px;text-decoration: none;}</style>
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
	   <?php include ('library/html/navbar.php'); ?>
		<?php include('library/html/contactModal.php'); ?>
		<br><br>
	<div class="container">
		<section class="my-5">
			<h1 class="h1-responsive font-weight-bold text-center">General Policy of the Library</h1>
			<hr>
			<div class="col-lg-12">
					<h2 class="font-weight-bold text-center text-uppercase">Proper Decorum in the Library</h2>
					<ol>
						<li class="links">The Library maintains silence. Conversations and discussions should take place outside the library.</li>
						<li class="links">Food and drinks are not to be brough inside the library</li>
						<li class="links">Cellphones or any electronic and communication devices must be set in silent mode in the library.</li>
						<li class="links">Lost books or any library material should be reported at once.</li>
						<li class="links">All students and outsides entering the Library shalll deposit their bags and other belongings(except money and other valuables) at the Baggage Counter at the ground floor. Only electronic devices, books, notebooks and other writing materials-all for the aid in studying or research-are allowed inside the library premises.</li>
					</ol>
			<hr>
				<h2 class="font-weight-bold text-center text-uppercase">Library Security System</h2>
				<div class="row text-center">
					<div class="col-lg-4">
						<div class="view overlay zoom">
							<img class="card-img-top" src="img/tattle_tape.jpg">
							<a>
    							<div class="mask waves-effect waves-light rgba-white-slight"></div>
  							</a>
  						</div>
					</div>
					<div class="col-lg-5">
						<h4 style="display: inline;">The Main Library employs a security system to safeguard its resources. A <span class="font-weight-bold">magnetic tattle tape</span> inserted in the books triggers the alarm at the building's Exit doorway if a user leaves the library with a that has not been checked-out.</h4>
					</div>
				</div>
			<hr>
				<h2 class="font-weight-bold text-center  text-uppercase">Library Patrons</h2>
				<h4 class="text-center">All students, faculty, staff, and alumni of the university are entitled to the use the Theology Library facilities with priority given to those who belong to the College of THeology. The library servives are extended to pastors and workers of churches that are members of the Convention of Philippine Baptist Churches(CBCP). Researchers from other denominations and sects may also the library in accordance to its policies.</h4>
			<hr>
				<h2 class="font-weight-bold text-center text-uppercase">General Rules and Regulations</h2>
				<ol>
					<li class="links">You cannot borrow if you have an overdue books or unpaid overdue fines.</li>
					<li class="links">Students are advised <span class="font-weight-bold">not to issue books to others on their names</span></li>
					<li class="links">All library material's must be returned one(1) day before the final examination.</li>
					<li class="links">Damage/Loss Charges:</li>
						<ol type="A">
							<li class="links">Overdue fines are not charged</li>
							<li class="links">If the book/material was lost, may we request that thet be replaced with one, if not exactly like it, then of the same subject and of the same quality of material.</li>
							<li class="links"> In the case that the book cannot be replaced, then the current price is indicated at the end of each book's data. These prices are the averages of the extremes available from the indicated website accessed on the date likewise indicated, to represent the best possible cost our library would incur in acquiring these materials by this time. The currency equipment will be based on the current values on the date of the payment.</li>
							<li class="links">For each lost book there is a processing fee of <span class="fa fa-rub"></span>150.00, to be paid.</li>
							
						</ol>
					<li class="links">Students should not deface, mark, cut mutilate or damage library resources in any way. Anybody found guilty of mutilating library materials will be charged and dealt with accordingly.</li>
					<li class="links"> Any student deemed to have acted in any way dishonestly with the library resources. such as stealing or taking materials out of their designated areas, may be placed on library probation for a length of time.</li>
					<li class="links"> Library books which have been taken from the library without permission are liable to a fine as if time. overdue. Each case will be examined to ascertain its genuineness and the matter will be reported w the Dean and Director for further action. </li>
				</ol>
			</div>
		</section>
	</div>
	<hr>
<?php include('library/html/footer.php'); ?>
  <!--JavaScript Libraries-->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/function.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nav_icons.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  	<script>

        new WOW().init();
  	/*Night Mode*/
	$( ".night-button" ).click(function() {
  	$( "body" ).toggleClass('night-mode');
	});
  	</script>
</body>
</html>