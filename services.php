<!DOCTYPE html>
<?php
	include ('connection.php');
  	$sql = "SELECT * FROM contact_us";
  	$res = mysqli_query($conn, $sql);
  	$row = mysqli_fetch_assoc($res);
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> College of Theology Library - Developers</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/animate.css">
	<link rel="icon" href="img/logo/cot.jpg">
  	<link rel="stylesheet" href="css/nav_icons.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
  	<link rel="stylesheet" href="css/mdb.css">
  	<style> .links{font-size: 20px;text-decoration: none;} .img-center{ margin-left: auto; margin-right: auto; display: block; } </style>
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
	<?php include('library/html/navbar.php'); ?><
	<?php include('library/html/contactModal.php'); ?><br><br>
	<div class="container mt-5">
		<section class="my-5">
			<h1 class="h1-responsive font-weight-bold text-center">Services of the Library</h1>
		</section>
		<hr>
		<div class="row">
			 <div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
			 	<img height="200" class="img-center" src="img/borrow.png">
       			<h2 class="font-weight-bold mt-4 mb-3 text-center">Borrowing of Books</h2>
      			<h5 class="text-center">The rights to which a library borrower is entitled, usually established by registering to receive a library card. Such privileges normally include the right to check out books and other materials from the circulating collection for a designated period of time, interlibrary loan, use of special collections, etc. They may be suspended if fines remain unpaid. In most public libraries, all registered users enjoy the same privileges, but in academic libraries, certain privileges, such as length of loan period, may depend on borrower status. In special libraries, borrowing privileges may be determined by a person's rank in the parent organization.</h5>
      		</div>
     		<div class="col-lg-4 col-md-6 mb-lg-0 mb-5">
     			<img height="200" class="img-center" src="img/research.png">
       			<h2 class="font-weight-bold mt-4 mb-3 text-center">Destiny</h2>
      			<h5 class="text-center"><span  class="font-italic">Destiny Library Manager</span> is a centralized installed software system where different library tools are available: circulation, cataloging, searching, reporting, and management.</h5>
    		</div>
    		<div class="col-lg-4 col-md-6 mb-lg-0 mb-5 ">
     			<img height="200" class="img-center" src="img/database.svg">
       			<h2 class="font-weight-bold mt-4 mb-3 text-center">ProQuest(Online Database)</h2>
      			<h5 class="text-center">ProQuest Research Library provides one-stop access to thousands of full-text periodicals from one of the broadest,  most inclusive general reference databases ProQuest has to offer</h5>
    		</div>
		</div>
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