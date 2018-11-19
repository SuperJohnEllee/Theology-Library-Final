<!DOCTYPE html>
<?php
	include ('../connection.php');
	include('../function/function.php');

	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!isset($_SESSION['admin_user'])) {
		session_unset();
		session_destroy();
		header("location: index.php");
	} 

	$feed_sql = "SELECT * FROM feedback";
	$feed_res = mysqli_query($conn, $feed_sql);
	$feed_row = mysqli_fetch_assoc($feed_res);

	$feed_id = htmlspecialchars($feed_row['feedbackID']);
	$feed_name = htmlspecialchars($feed_row['Name']);

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> College of Theology Library - View Users</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo/cot2.jpg">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
</head>
<body class="cyan lighten-5">
 <nav class="navbar navbar-expand-lg navbar-light text-white mdb-color darken-4 fixed-top">
	<a class="navbar-brand" href="#"><img src="../img/logo/cot2.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler cyan lighten-2" type="button" data-toggle="collapse" data-target="#navbar" 
	aria-controls="navbar aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<h1 class="text-center"><span class="fa fa-user"></span> Feedbacks(<?php numberOfFeedbacks(); ?>)</h1>
		<br>
		<div class="table-responsive">
			<table id="user_table" class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Feedback ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Date Send</th>
						<th colspan="2" class="text-center">Action</th>
					</tr>
				</thead>
				<?php
					$fb_sql = "SELECT * FROM feedback ORDER BY DateSend DESC";
					$fb_res = mysqli_query($conn, $fb_sql);
					$fb_count = mysqli_num_rows($fb_res);

					if ($fb_count > 0) {
				
						while ($fb_row = mysqli_fetch_assoc($fb_res)) {
					?>
					<tr>
						<td><?php echo $fb_row['feedbackID']; ?></td>
						<td class="font-weight-bold text-info"><?php echo $fb_row['Name']; ?></td>
						<td><?php echo $fb_row['Email']; ?></td>
						<td class="font-weight-bold"><?php echo $fb_row['Subject']; ?></td>
						<td class="font-weight-bold text-warning"><?php echo $fb_row['Message']; ?></td>
						<td><?php echo $fb_row['DateSend']; ?></td>
						<td><a class='btn btn-primary' href='admin-reply-feedback.php?feed_reply=<?php echo $fb_row['feedbackID'] ?>'><span class='fa fa-reply'></span> Reply</a></td>      
						<td><a class='btn btn-danger' onclick="return confirm('Delete this feedback?');" href='crud_action.php?feed_del=<?php echo $fb_row['feedbackID'] ?>'><span class='fa fa-trash'></span> Delete</a></td>
					</tr>

				<?php }	 ?>

				<?php } else {
						echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    			<span class='fa fa-warning'></span> No Feedbacks Found</h3></td></tr>";
					}

				?>
			</table>
	</div>
</div>

<!-- JavaScript Libraries -->
<script>
	function countChars(textbox, counter, max) {
  var count = max - document.getElementById(textbox).value.length;
  if (count < 0) { document.getElementById(counter).innerHTML = "<span style=\"color: red;\">" + count + "</span>";
  	  document.getElementById('btn_post').disabled = true;
} else { document.getElementById(counter).innerHTML = count;
		 document.getElementById('btn_post').disabled = false; }
}
</script>
<script src="../js/bootstrap.js"></script>
<script src="../js.jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src=../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>