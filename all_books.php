<?php 
    include ('connection.php'); 
    include ('session.php');
    $book_sql = "SELECT BookID FROM theo_books"; // 7days
    $books_result = mysqli_query($conn, $book_sql);
    $books_count = mysqli_num_rows($books_result);


  $notif_request_sql = mysqli_query($conn, "SELECT book_requestID FROM book_request 
    WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_request_count = mysqli_num_rows($notif_request_sql);

  $notif_reserved_sql = mysqli_query($conn, "SELECT book_reservationID FROM reservation WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_reserved_count = mysqli_num_rows($notif_reserved_sql);


  $search_result = "";
  
  $session_id = htmlspecialchars($_SESSION['userid']);

  $notif_request_sql = mysqli_query($conn, "SELECT book_requestID FROM book_request 
    WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_request_count = mysqli_num_rows($notif_request_sql);

  $notif_reserved_sql = mysqli_query($conn, "SELECT book_reservationID FROM reservation WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_reserved_count = mysqli_num_rows($notif_reserved_sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title> College of Theology Library </title>
	<meta name="viewport" charset="utf-8">
  <meta name="description" content="width=device-width, initial-scale=1.1">
  <meta name="author" content="College of Theology">
  <link rel="icon" href="img/logo/cot2.jpg">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/nav_icons.css">
  <link rel="stylesheet" href="css/style.css">
  <style>body{padding-top: 54px;}@media(min-width: 992px){body{padding-top: 56px; }}</style>
</head>
<body oncontextmenu="return false;" onselectstart="return false;" class="yellow lighten-4" onload="startTime()">
<!-- Navbar here -->
<nav class="navbar navbar-expand-lg brown darken-4 fixed-top">
  <a class="navbar-brand" href="#"><img src="img/logo/cot2.jpg" align="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
      </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="request.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>"><i class="fa fa-bookmark"></i>&nbsp;Request</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="all_books.php"><span class="fa fa-book"></span> All Books</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto" id="navbar">
        <li class="nav-item">
          <span class="nav-link text-white" id="date_time"></span>
        </li>
    </ul>
  </div>
</nav>
  <div class="container">
    <div class="page-header">
      <h1 class="my-4 text-center">College of Theology Library Books</h1>
    </div>
  <div class="row">
        <div class="col-sm-12 col-sm-offset-3">
            <div id="imaginary_container"> 
                <!-- Search form -->
              <form method="get" class="form-inline md-form form-sm">
                  <input class="form-control form-control-sm ml-3 w-75" id="book_search" type="text" name="search_book" required>
                  <button type="submit" name="btn_search" class="btn btn-primary"><span class="fa fa-search"></span> SEARCH</button>
                  <label for="search">Search</label>
              </form>
            </div>
        </div>
  </div>
    <?php
        function microtime_float()
        {
          list($usec, $sec) = explode(" ", microtime());
          return ((float)$usec + (float)$sec);
        }
        $time_start = microtime_float();
        usleep(100);
        $time_end = microtime_float();
        $time_search = $time_end - $time_start;

      if (isset($_GET['btn_search'])) {
          $search = mysqli_real_escape_string($conn, $_GET['search_book']);

          $search_sql = "SELECT * FROM theo_books 
          WHERE BookName LIKE '%$search%' 
          OR Author LIKE '%$search%'
          OR BookType LIKE '%$search%' 
          OR ISBN LIKE '%$search%'";
          $search_res = mysqli_query($conn, $search_sql);
          $search_count = mysqli_num_rows($search_res);

           echo '<div class="ml-5 mb-2">
                      <div class="card-body text-center ml-5">
                        <h1 class="card-title">Search results for keyword
                         "<span class="font-weight-bold red-text">'.$search.'</span>"</h1>
                        <h3 class="font-weight-bold">Found '.$search_count.' results in '.round($time_search, 5).' in seconds</h3>
                    </div>
                </div>';
      }
    ?>
    <div class="row text-center text-lg-left" id="search_area">
      <?php       
        if (isset($_GET['btn_search'])) {

        if ($search_count > 0) {
          while ($search_row = mysqli_fetch_assoc($search_res)) {
                  $search_id = htmlspecialchars($search_row['BookID']);
                  $search_image = 'book_image/'. htmlspecialchars($search_row['BookImage']);
                  $search_name = htmlspecialchars($search_row['BookName']);
          ?>          <div class="col-lg-4 col-md-6">
          <div class="card">
             <div class="view">
                <img height="400" src="<?php echo htmlspecialchars($search_image); ?>" class="card-img-top"
          alt="<?php echo htmlspecialchars($search_name) ?>">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
            </div>
          <div>
            <h4 class="card-title text-center"> <?php echo htmlspecialchars($search_name); ?></h4>
              <p class="card-text text-center">By <span class="text-primary"><?php echo htmlspecialchars($search_row['Author']); ?></span></p>
            <a href="book-info.php?book_id=<?php echo htmlspecialchars($search_id); ?>" class="btn btn-primary"><span class="fa fa-eye"></span> View</a>
        </div>
      </div>
    </div>
          <!--<div class="col-lg-3 col-md-4 col-xs-6">
          <a class="d-block mb-3 h-100" href="book-info.php?book_id=<?php echo htmlspecialchars($search_id); ?>">
            <img class="img-fluid img-thumbnail" src="<?php echo htmlspecialchars($search_image); ?>" alt="image">
              <h5 class="text-center"><?php echo htmlspecialchars($search_name); ?></h5>
            </a>
            </div> -->
        <?php
            } 
          }
    } 
    
    else  {
          $book_sql = "SELECT * FROM theo_books ORDER BY BookPostDate DESC";
          $result = mysqli_query($conn, $book_sql);
              while ($row = mysqli_fetch_assoc($result)) {
                    $id = htmlspecialchars($row['BookID']);
                    $name = htmlspecialchars($row['BookName']);
                    $image = 'book_image/'.htmlspecialchars($row['BookImage']);
        ?>
        <div class="col-lg-4 col-md-6">
          <div class="card">
             <div class="view">
                <img width="350" height="450" src="<?php echo htmlspecialchars($image); ?>" class="card-img-top"
          alt="<?php echo htmlspecialchars($name) ?>">
            <a>
                <div class="mask rgba-white-slight"></div>
            </a>
            </div>
          <div>
            <h4 class="card-title text-center"> <?php echo htmlspecialchars($name); ?></h4>
              <p class="card-text text-center">By <span class="text-primary"><?php echo htmlspecialchars($row['Author']); ?></span></p>
            <a href="book-info.php?book_id=<?php echo htmlspecialchars($id); ?>" class="btn btn-primary"><span class="fa fa-eye"></span> View</a>
        </div>
      </div>
    </div>
        <!--<div class="col-lg-3 col-md-4 col-xs-6">
        <a href="book-info.php?book_id=<?php echo htmlspecialchars($id); ?>" class="d-block mb-3 h-100">
          <img class="img-fluid img-thumbnail" src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo $name; ?>">
          <h5 class="text-center"><?php echo htmlspecialchars($name); ?></h5>
        </a>
      </div> -->
      <?php }
      } ?>
  </div>
</div>
 <!--<div style="padding: 15px 0;" class="mdb-color darken-4 text-white text-center">
  <h6 class="col-lg-12">Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
 </div> -->
<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/mdb.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/nav_icons.js"></script>
</body>
</html>
<script>

new WOW().init();


$(document).ready(function(){
 $('#book_search').keyup(function(){
 
  // Search text
  var text = $(this).val();
 
   //Hide all content class element
  $('.col-lg-4').hide();
  $('.col-lg-4 .card-title:contains("'+text+'")').closest('.col-lg-4').show(); //book title
  $('.col-lg-4 .card-text:contains("'+text+'")').closest('.col-lg-4').show(); //author
 
 });
});

$.expr[":"].contains = $.expr.createPseudo(function(arg) {
  return function( elem ) {
   return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  };
});


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
new WOW.init();
$('.dropdown-toggle').dropdown();
</script>