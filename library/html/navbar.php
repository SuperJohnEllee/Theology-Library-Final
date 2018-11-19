<?php
  include('function/function.php');
  //include('session.php');
  	
    if (!isset($_SESSION['username'])) {
		{
	}
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top mdb-color darken-4">
    <a class="navbar-brand" href="#"><img src="img/logo/cot2.jpg" align="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="personnel.php"><i class="fa fa-users"></i>&nbsp;Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="courses.php"><i class="fa fa-graduation-cap"></i>&nbsp;Courses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="about.php"><i class="fa fa-info-circle"></i>&nbsp;Brief History</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="news.php"><i class="fa fa-bullhorn"></i>&nbsp;Annoucement</a>
      </li>
        <li class="nav-item">
        <a class="nav-link text-white" href="Register.php"><i class="fa fa-user-plus"></i>&nbsp;Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="login.php"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
  else {

  $session_id = $_SESSION['userid'];  
  $notif_request_sql = mysqli_query($conn, "SELECT book_requestID FROM book_request 
    WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_request_count = mysqli_num_rows($notif_request_sql);

  $notif_reserved_sql = mysqli_query($conn, "SELECT book_reservationID FROM reservation WHERE Status = 'Approved' AND UsersID = '$session_id'");
  $notif_reserved_count = mysqli_num_rows($notif_reserved_sql);
?>
<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
    <a class="navbar-brand" href="#"><img src="img/logo/cot2.jpg" align="Logo" height="30" width="30" style="display: inline-block;"></a>
      <button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="request.php?id=<?php echo htmlspecialchars($_SESSION['userid']); ?>"><i class="fa fa-bookmark"></i>&nbsp;Request</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="news.php"><i class="fa fa-bullhorn"></i>&nbsp;Annoucement</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-bell-o"></span> Notifications <span title="Requested Books">(<?php echo $notif_request_count; ?>)</span> <span title="Reserved Books">(<?php echo $notif_reserved_count; ?>)</span></a>
          <div class="dropdown-menu">
            <span>Requested Books</span>
            <?php
                notification_approved_request();
                notification_rejected_request();
            ?>
            <hr class="theo-footer-hr">
            <span>Reserved Books</span>
            <?php
              notification_approved_reserved();
              notification_rejected_reserved();
            ?>
            <a href="notification.php"><u>See All</u></a>
          </div>
      </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="profile.php?<?php echo htmlspecialchars($_SESSION['username']);?>"><span class="fa fa-user"></span>&nbsp;<?php echo htmlspecialchars($_SESSION['username'])?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick="return confirm('Are you sure you want to logout?');" href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>