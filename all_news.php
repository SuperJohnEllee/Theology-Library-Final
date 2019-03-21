<!DOCTYPE html>
<?php
session_start();
include ('connection.php');
$announcement_sql = "SELECT AnnouncementID FROM announcement";
$announcement_res = mysqli_query($conn, $announcement_sql);
$announcement_count = mysqli_num_rows($announcement_res);

$sql = "SELECT * FROM contact_us";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
date_default_timezone_set('Asia/Manila');

?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<title> College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
  	<link rel="stylesheet" href="css/mdb.css">
    <link rel="stylesheet" href="css/animate.css">
  	<link rel="stylesheet" href="css/nav_icons.css">
  	<link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icons{font-size: 25px;}.links{font-size: 20px;text-decoration: none;} .img-center{ margin-right: auto; margin-left: auto; display: block;  }</style>
</head>
<body oncontextmenu="return false;" onselectstart="return false;" role="document" class="yellow lighten-4">
<nav class="navbar navbar-expand-lg fixed-top brown darken-4">
    <a class="navbar-brand text-white waves-effect waves-dark" href="#"><img src="img/logo/cot2.jpg" align="Logo" height="30" width="30" style="display: inline-block;">&nbsp;CPU COT Library</a>
      <button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
      </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-dark text-white" href="index.php"><i class="fa fa-home "></i> Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-white dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><span class="fa fa-info-circle"></span> About</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item waves-effect waves-dark" href="about.php"><span class="fa fa-info-circle"></span> About the Library</a>
          <a class="dropdown-item waves-effect waves-dark" href="policy.php"><span class="fa fa-lock"></span> General Policy</a> 
          <a class="dropdown-item waves-effect waves-dark" href="services.php"><span class="fa fa-cogs"></span> Services</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-white dropdown-toggle waves-dark waves-effect" id="navbarDrop" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><span class="fa fa-briefcase"></span> Collections</a>
        <div class="dropdown-menu waves-effect waves-dark" aria-labelledby="navbarDrop">
          <a class="dropdown-item waves-effect waves-dark" href="gallery.php"><span class="fa fa-briefcase"></span> Library Collections</a>
          <a class="dropdown-item waves-effect waves-dark" href="library_collections.php"><span class="fa fa-briefcase"></span> Special Collections</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-white dropdown-toggle waves-dark waves-effect" id="navbarDrop" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><span class="fa fa-chain"></span> Free Access Links</a>
        <div class="dropdown-menu waves-effect waves-dark" aria-labelledby="navbarDrop">
          <a class="dropdown-item waves-effect waves-dark" href="https://www.globethics.net/web/gtl" target="_blank">GlobeTheoLib</a>
          <a class="dropdown-item waves-effect waves-dark" href="http://www.globethics.net/" target="_blank"> Globe Ethics</a>
          <a class="dropdown-item waves-effect waves-dark" href="http://www.ntslibrary.com/">NTSLibrary</a>
          <a class="dropdown-item waves-effect waves-dark" href="https://oadtl.org/" target="_blank">Open Access Digital Theological Library</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto" id="navbar">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-dark text-white" href="news.php"><i class="fa fa-bullhorn "></i> Annoucement</a>
      </li>
        <li class="nav-item">
        <a class="nav-link waves-effect waves-dark text-white" href="Register.php"><i class="fa fa-user-plus"></i> Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-dark text-white" href="login.php"><i class="fa fa-sign-in"></i> Login</a>
      </li>
    </ul>
  </div>
</nav><br>
<?php include('library/html/contactModal.php'); ?>
<div class="container mt-5">
    <div class="team-section text-center">
            <h1 class="text-center">College of Theology Announcements</h1>
            <p class="text-center">This announcement is intended for the College of Theology Students and Alumnis<br>We have <?php echo htmlspecialchars($announcement_count); ?> new announcements posted here</p>
          <div class="row">
          		<div class="col-sm-12 col-sm-offset-3">
        			<div class="md-form" id="imaginary_container">
            			<form method="get" class="form-inline md-form form-sm">
                  			<input class="form-control form-control-sm ml-3 w-75" id="search_announcements" type="text" name="search_announcements" required placeholder="Search any keywords">
                  		<button type="submit" name="btn_search_announcements" class="btn btn-primary"><span class="fa fa-search"></span>Searh</button>
            			</form>
          			</div>
       			</div>
       		</div>
       	<?php

       		function get_timeago( $ptime )
			{
    			$estimate_time = time() - $ptime;

    			if( $estimate_time < 1 )
    			{
        			return 'less than 1 second ago';
    			}
    			$condition = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                						 30 * 24 * 60 * 60  =>  'month',
                							  24 * 60 * 60  =>  'day',
               									   60 * 60  =>  'hour',
                										60  =>  'minute',
                										1   =>  'second');
    			foreach( $condition as $secs => $str )
    			{
        			$d = $estimate_time / $secs;

        			if( $d >= 1 )
        			{
            			$r = round( $d );
           			 	return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        			}
    			}
			}

        
       		function microtime_float()
        	{
          		list($usec, $sec) = explode(" ", microtime());
          			return ((float)$usec + (float)$sec);
        	}
        	$time_start = microtime_float();
        	usleep(100);
        	$time_end = microtime_float();
        	$time_search = $time_end - $time_start;

        	if (isset($_GET['btn_search_announcements'])) {
        		
        		$search_announcements = mysqli_real_escape_string($conn, $_GET['search_announcements']);

        		$search_sql = mysqli_query($conn, "SELECT * FROM announcement WHERE Title LIKE '%$search_announcements%' OR Content LIKE '%$search_announcements%'");
        		$search_count = mysqli_num_rows($search_sql);

        		   echo '<div class="ml-5 mb-2">
                      <div class="card-body text-center ml-5">
                        <h1 class="card-title">Search results for keyword
                         "<span class="font-weight-bold red-text">'.$search_announcements.'</span>"</h1>
                        <h3 class="font-weight-bold">Found '.$search_count.' results in '.round($time_search, 5).' in seconds</h3>
                    </div>
                </div>';
        	}
       	?>
       	<div class="row">
              <?php
              	if (isset($_GET['btn_search_announcements'])) {
              		if ($search_count > 0) {
              			while ($search_row = mysqli_fetch_assoc($search_sql)) {
              				  $search_image = 'announcement_image/'.htmlspecialchars($search_row['Image']);
                    		$search_timeago = get_timeago(strtotime($search_row['PostDate']));
              				?>
                <div class="col-lg-5">
                    <div class="view overlay">
                      <img class="card-img-top" src="<?php echo $search_image ?>">
                       <a>
                        <div class="mask rgba-white-slight waves-effect waves-dark"></div>
                      </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h1 class="h1-responsive mt-2 card-title"><strong><?php echo $search_row['Title']; ?></strong></h1>
                    <h6 class="text-dark mb-4">Posted by <span class="font-weight-bold"><?php echo $search_row['PostBy']; ?></span> on <span class="font-weight-bold"><?php echo date('F j, Y - g:i A', strtotime($search_row['PostDate'])); ?></span><br><span class="green-text font-weight-bold"><?php echo $search_timeago; ?></span></h6>
                    <div class="d-flex justify-content-center">
                      <h4 class="card-text" style="max-width: 43rem;"><?php echo $search_row['Content']; ?></h4>
                    </div>
                </div>
              		<!--<div class="col-lg-6 col-md-6 mb-1 wow fadeInUp">
                    	<div class="card">
                        	<div class="view overlay zoom">
                          		<img height="300" width="540" src="<?php echo $image; ?>" alt="<?php echo $search_row['Title']; ?>">
                           		<a>
                           			<div class="mask rgba-white-slight waves-effect waves-light"></div>
                          		</a>
                          		<div class="card-body text-center">
                              		<h2 class="card-title"><span class="fa fa-bookmark"></span> <?php echo $search_row['Title']; ?></h2>
                              		<p>Posted by <span class="font-weight-bold"><?php echo $search_row['PostBy']; ?></span> on <span class="blue-text font-weight-bold"><?php echo date('F j, Y - g:i A', strtotime($search_row['PostDate'])); ?></span><br><span class="green-text font-weight-bold"><?php echo $search_timeago; ?></span></p>
                                <h5 style="font-size: 20px;" class="text-dark card-text"><?php echo $search_row['Content']; ?></h5>
                          		</div>
                        	</div>
                    	</div>
                	</div> -->
              		<?php	
              			}
              		}

              	} else {

                    $sql = "SELECT * FROM announcement ORDER BY PostDate DESC";
                    $result = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($result);
    
            if ($count >  0) {
                $i=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = 'announcement_image/'.htmlspecialchars($row['Image']);
                    $title = htmlspecialchars($row['Title']);
                    $content = htmlspecialchars($row['Content']);
                    $postBy = htmlspecialchars($row['PostBy']);
                    $postDate = htmlspecialchars($row['PostDate']);
                    $i++;
                    $timeago = get_timeago(strtotime($row['PostDate']));
                ?>
                <div class="col-lg-5">
                    <div class="view overlay">
                      <img class="wow zoomIn card-img-top" src="<?php echo $image ?>">
                       <a>
                        <div class="mask rgba-white-slight waves-effect waves-dark"></div>
                      </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h1 class="h1-responsive mt-2 card-title"><strong><?php echo $title; ?></strong></h1>
                    <h6 class="text-dark mb-4">Posted by <span class="font-weight-bold"><?php echo $postBy; ?></span> on <span class="font-weight-bold"><?php echo date('F j, Y - g:i A', strtotime($postDate)); ?></span><br><span class="green-text font-weight-bold"><?php echo $timeago; ?></span></h6>
                    <div class="d-flex justify-content-center">
                      <h4 class="card-text" style="max-width: 43rem;"><?php echo $content; ?></h4>
                    </div>
                </div>
                <!--<div class="col-lg-6 col-md-6 mb-1 wow fadeInUp">
                    <div class="card">
                        <div class="view overlay zoom">
                          <img height="300" width="540" src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                           <a>
                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                          </a>
                          <div class="card-body text-center">
                              <h2 class="card-title"><span class="fa fa-bookmark"></span> <?php echo $title; ?></h2>
                              <p>Posted by <span class="font-weight-bold"><?php echo $postBy; ?></span> on <span class="blue-text font-weight-bold"><?php echo date('F j, Y - g:i A', strtotime($postDate)); ?></span><br><span class="green-text font-weight-bold"><?php echo $timeago; ?></span></p>
                                <h5 style="font-size: 20px;" class="text-dark card-text"><?php echo $content; ?></h5>
                          </div>
                        </div>
                    </div>
                </div> -->

          <?php } ?>
        <?php } else { 
            echo '<div class="card ml-5">
                    <div class="view overlay">
                      <img class="card-img-top" src="img/no_news.jpg" alt="No Announcement">
                      <a>
                          <div class="mask waves-effect waves-light rgba-white-slight"></div>
                      </a>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="card-title">No Announcement Posted</h1>
                        <h4>Please wait for the upcoming new announcements</h4>
                        <h5>To view previous news, click here <a class="text-center" href="all_news.php">All Announcements</a>
                    </div>
                  </div>';
            /*echo '<h1 class="card-title h2-responsive mt-2 font-weight-bold "><strong>There are no announcements posted</strong><br>
          </h1><div class="d-flex justify-content-center">
          <h4 class="lime accent-2">Please wait for the incoming announcements</h4>
    </div>'; */
        }
    }
          ?>
        </div>
    </div>
  </div>
  <hr>
  <!--JavaScript Libraries-->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.0/js/mdb.min.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/function.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nav_icons.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
<script>

  new WOW().init();

$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});

/*$(document).ready(function(){
 $('#search_announcements').keyup(function(){
 
  // Search text
  var text = $(this).val();
 
   //Hide all content class element
  $('.col-lg-6').hide();
  $('.col-lg-6 .card-title:contains("'+text+'")').closest('.col-lg-6').show(); //Title
  $('.col-lg-6 .card-text:contains("'+text+'")').closest('.col-lg-6').show(); //Content
 
 });
});

$.expr[":"].contains = $.expr.createPseudo(function(arg) {
  return function( elem ) {
   return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  };
}); */

</script>
</body>
</html>