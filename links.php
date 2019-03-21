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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Central Philippine University College College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/mdb.css">
	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/animate.css">
  	<link rel="stylesheet" href="css/nav_icons.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
  	<link rel="stylesheet" href="css/mdb.min.css">
  	<style>.links{font-size: 20px;text-decoration: none;} .img-center{ margin-left: auto; margin-right: auto; display: block; }</style>
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
<?php include('library/html/navbar.php'); ?><br>
<?php include('library/html/contactModal.php'); ?>
<div class="container mt-5">
			<section class="my-5">
			<h1 class="h1-responsive text-center font-weight-bold text-uppercase text-center"> Free Access Links</h1>
			<hr>
			<div class="col-lg-12">
				<h2 class="font-weight-bold">Collection of Works</h2>
					<ol>
						<h3><a href="https://www.hathitrust.org/" target="_blank">HathiTrust</a></h3>
						<ol>
							<ul>
								<li class="links">A partnership of academic institutions, offering a collection of millions of titles digitized from libraries around the world. Most books in HathiTrust are published before 1923, but not all – e.g. The church in Southeast Asia by Winburn T. Thomas and Rajah B. Manikam, published 1956.</li>
							</ul>
						</ol>
						<h3><a href="http://commons.ptsem.edu/" target="_blank">Princeton Theological Seminary Theological Commons</a></h3>
						<ol>
							<ul>
								<li class="links">Digital library of around 110,000 books and periodicals on theology and religion, mostly published before 1923, but not all – e.g. God Hidden and Revealed by John Dillenberger, published in 1953.</li>
							</ul>
						</ol>
						<h3><a href="http://purl.oclc.org/ATSRW/ccel" target="_blank">Christian Classics Ethereal Library</a></h3>
						<ol>
							<ul>
								<li class="links">Classic Christian texts, including Patristic writings, various versions of the Bible, hymns, denominational works, reference works, and theological texts. It is possible to browse the CCEL by subject.</li>
							</ul>
						</ol>
						<h3><a href="http://onlinebooks.library.upenn.edu/search.html" target="_blank">Online Books from the University of Pennsylvania</a></h3>
						<ol>
							<ul>
								<li class="links">Listing over 3 million free books on the Web</li>
							</ul>
						</ol>
					</ol>
				<h2 class="font-weight-bold">Journal articles / online journals</h2>
				<ol>
					<h3><a href="http://www.users.csbsju.edu/~eknuth/itr/jour.html" target="_blank">Online Theology-Related Periodicals</a></h3>
						<ol>
							<ul>
								<li class="links">Listing over 3 million free books on the Web</li>
							</ul>
						</ol>
				</ol>
				<h2 class="font-weight-bold">Biblical Studies</h2>
				<ol>
					<h3><a href="http://sites.utoronto.ca/religion/synopsis/meta-5g.htm" target="_blank">The Five Gospel Parallels</a></h3>
					<h3><a href="http://www.ntgateway.com/" target="_blank">New Testament Gateway</a></h3>
				</ol>
				<h2 class="font-weight-bold">Theology</h2>
				<ol>
					<h3><a href="https://reformed.org/" target="_blank">Center for Reformed Theology & Apologetics</a></h3>
						<ol>
							<ul>
								<li class="links">Listing over 3 million free books on the Web</li>
							</ul>
						</ol>
					<h3><a href="http://www.users.csbsju.edu/~eknuth/itr/syst/index.html" target="_blank">Internet Theology Resources: Systematic Theology</a></h3>
				</ol>
			</div>
		</section>
</div>
   <?php include('library/html/footer.php'); ?>
  <!--JavaScript Libraries-->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/function.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/carousel.js"></script>
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