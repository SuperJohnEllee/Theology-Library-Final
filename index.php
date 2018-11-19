<?php
  session_start();
  include ('connection.php');
  $sql = "SELECT * FROM contact_us";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  <meta name="author" content="College of Theology Library">
  <meta name="description"  content="Web Application for College of Theology with Book Locator">
  <meta name="twitter:card" value="summary">
  <title>College of Theology Library</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="icon" href="img/logo/cot2.jpg">
  <style>.cpu{font-size: 20px;}.links{font-size: 20px;text-decoration: none;} .arrow{font-size: 25px;}
</style>
</head>
<body oncontextmenu="return false" id="body" class="cyan lighten-5 index" role="document" onload="startTime()">
<!-- Navbar here -->
<?php include ('library/html/navbar.php'); ?> 
<?php include('library/html/contactModal.php'); ?>
<!--<h6 class="pull-right" id="date_time"></h6>-->
<div class="jumbotron-container cyan lighten-4" id="top-section">
  <div class="jumbotron jumbotron-fluid cyan lighten-5">
    <div class="jumbotext cyan lighten-2">
      <h2 class="jumbotext-sub text-dark">"Called & Committed to Faith, Witness & Service"</h2>
      <p class="jumbotext-main text-dark display-3">Central Philippine University<br>College of Theology</p>
      <!--<h4 class="jumbotext-sub text-dark">A Web-based Theological Library</h4> -->
    </div>
  </div>
</div>
<!--Parallax-->
    <div class="view jarallax intro-2" data-jarallax='{"speed": 0.2}' style="background-image: url(https://redeeminggod.com/wp-content/uploads/2011/06/types-of-theology1.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    </div>
<!--Carousel here -->
<?php include ('library/html/carousel.php'); ?>

<!--Journal and Book Section here -->
<?php include ('library/html/journal_book_section.php'); ?>

<!-- Mission, Vision and Philosophy & Goals-->
<?php include ('library/html/mission_vision.php'); ?>
 <div class="view jarallax intro-2" data-jarallax='{"speed": 0.2}' style="background-image: url(http://brandonchase.net/wp-content/uploads/2014/01/Theology.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  </div>


<div class="banner-1">
      <div class="container">
        <span class="banner-text">"God helps those who help themselves"</span>
      </div>
</div>
<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
    <a href="#top-section" class="btn-floating btn-large cyan darken-1">
        <i class="fa fa-arrow-up"></i>
    </a>
</div>

<!-- Promotiom here -->
<?php include ('library/html/promotion.php'); ?>

<!-- Footer here -->
<?php include('library/html/footer.php'); ?>

<!-- My footer -->
<div style="padding: 15px 0;" class="mdb-color darken-4 text-center text-white">
        <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
    </div>

<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/mdb.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/function.js"></script>
</body>
</html>