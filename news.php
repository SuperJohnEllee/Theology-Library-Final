<!DOCTYPE html>
<?php
session_start();
include ('connection.php');
$announcement_sql = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR AND Status = 'Active'";
$announcement_res = mysqli_query($conn, $announcement_sql);
$announcement_count = mysqli_num_rows($announcement_res);


date_default_timezone_set('Asia/Manila');
?>
 <html>
<head>
  <meta http-equiv="Content-Type" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<title> College of Theology Announcement</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icons{font-size: 25px;}</style>
</head>
<body oncontextmenu="return false" role="document" class="cyan lighten-5">
	
<!-- Navbar here -->
<?php include ('library/html/navbar.php'); ?><br><br><br>
    <div class="jumbutron cyan lighten-5 text-center">
            <h1 class="text-center">College of Theology Announcements</h1>
            <p class="text-center">This announcement is intended for the College of Theology Students and Alumnis<br>We have <?php echo htmlspecialchars($announcement_count); ?> announcements posted here</p>
              <?php 
                    $sql = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR AND Status = 'Active' ORDER BY PostDate DESC";
                    $result = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($result);
    
            if ($count >  0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = 'announcement_image/'.htmlspecialchars($row['Image']);
                    $title = htmlspecialchars($row['Title']);
                    $content = htmlspecialchars($row['Content']);
                    $postBy = htmlspecialchars($row['PostBy']);
                    $postDate = htmlspecialchars($row['PostDate']);
                ?>   
            <img height="350" width="400" src="<?php echo $image; ?>">
            <h1 class="card-title h2-responsive mt-2"><strong><?php echo $title; ?></strong></h1>
              <p class="text-dark mb-4">Posted By <span class="font-weight-bold"><?php echo $postBy; ?></span> on <span class="font-weight-bold"><?php echo date('F j, Y - g:i A', strtotime($postDate)); ?></span></p>
            <div class="d-flex justify-content-center">
                <h4 class="card-text mb-3 lime accent-2" style="max-width: 43rem;"><?php echo $content; ?></h4>
            </div>
            <hr>
          <?php } ?>
        <?php } else { 
            echo '<h1 class="card-title h2-responsive mt-2 font-weight-bold "><strong>There are no announcements posted</strong><br>
          </h1><div class="d-flex justify-content-center">
          <h4 class="lime accent-2">Please wait for the incoming announcements</h4>
    </div>';
        }
          ?>
    </div>
    <!--<div style="padding: 15px 0;" class="mdb-color darken-4 text-white text-center">
        <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
    </div>-->
  <!--JavaScript Libraries-->
  <script src="js/mdb.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<script>
$( ".night-button" ).click(function() {
  $( "body" ).toggleClass('night-mode');
});
</script>
</body>
</html>