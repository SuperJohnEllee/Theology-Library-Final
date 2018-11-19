<!DOCTYPE html>
<?php 
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = $_SESSION['admin_user'];

	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	include ('../connection.php'); // connection
	include('../function/function.php'); // functions
	
	//Displays Number of Active Announcements
	$act_sql = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR AND Status = 'Active'";
	$res_sql = mysqli_query($conn, $act_sql);
	$announcement_row = mysqli_fetch_assoc($res_sql);
	$act_announcement_count = mysqli_num_rows($res_sql);

	//Displays Number of Inactive Announcements
	$inact_sql = "SELECT AnnouncementID FROM announcement WHERE Status = 'Inactive'";
	$res_sql = mysqli_query($conn, $inact_sql);
	$inact_announcement_count = mysqli_num_rows($res_sql);

	//Displays All Announcements
	$announcement_sql = "SELECT AnnouncementID FROM announcement";
	$res_sql = mysqli_query($conn, $announcement_sql);
	$announcement_count = mysqli_num_rows($res_sql);
 	
	createAnnouncement(); //function --> create Announcements

?>
<html> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<style>.icon{font-size: 30px;}</style>
<body class="cyan lighten-5" role="document" oncontextmenu="return false">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
<div class="container"><br>
	<div class="page-header">
		<h1 class="text-center"><span class="fa fa-bullhorn"></span> Post an Announcement(<?php numberOfAnnouncements(); ?>)</h1>
		<br>
		<hr class="theo-footer-hr">
	</div>
	<br>
	 <ul class="nav nav-tabs md-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#create_announcements" role="tab"><span class="fa fa-pencil"></span> Create Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewActiveAnnouncements" role="tab"><span class="fa fa-eye"></span> View Active Announcements</a>
            </li>
            <li class="nav-item">
            	<a class="nav-link" data-toggle="tab" href="#viewInactiveAnnouncements" role="tab"><span class="fa fa-eye-slash"></span> View Inactive Announcements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewAllAnnouncements" role="tab"><span class="fa fa-bullhorn"></span> View All Announcements</a>
            </li>
       </ul>
       <div class="tab-content card">
       		<div class="tab-pane fade in show active" id="create_announcements" role="tabpanel">
       			<br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">	
			<form id="AddAnnoucementForm" method="post" enctype="multipart/form-data">
				<p>Note: Please input an image when you post an announcement</p>
				<div class="md-form">
					<i class="fa fa-image prefix"></i>
					<input type="file" name="image" id="image" required>
				</div>
				<div class="md-form">
					<i class="fa fa-header prefix"></i>
					<input class="form-control" type="text" id="title" name="title" required>
					<label>Title</label>
				</div>
				<div class="md-form">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" id="AddAnnounceForm_Cont" length="1000" onFocus="countChars('AddAnnounceForm_Cont','text-counter',1000)" onKeyDown="countChars('AddAnnounceForm_Cont','text-counter',1000)"
					onKeyUp="countChars('AddAnnoucementForm','text-counter',1000)" name="content" rows="7" style="resize: none; margin-bottom:8px;"autofocus required></textarea>
					<label for="content">Content</label>
				</div>
				<span style="color: gray;">Post as <span class="font-weight-bold"><?php echo htmlspecialchars($session_admin_user); ?></span></span>
				<button class="btn btn-info pull-right" type="submit" name="btn_post" id="btn_post"><i class="fa fa-paper-plane-o"></i>Post</button>
				<span class="pull-right" id="text-counter" style="margin-top:8px;margin-right:8px; color:gray;">&nbsp;1000</span>
			</form>
		</div>
		</div>
       	</div>
       	<div class="tab-pane fade" id="viewActiveAnnouncements">
       		<br>
       	<div class="table-scrol">
		<h1 class="text-center">Your Latest Announcement(<?php echo $act_announcement_count; ?>)</h1>
		<br>
		<!--<a class="btn btn-primary" href="admin-view-previous-announcement.php"><span class="fa fa-history"></span> View All Announcements</a>
		<h6>Note: Delete an announcement every 4-5 Days</h6> -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Status</th>
						<th colspan="1">Posted By</th>
						<th colspan="1">Posted Date</th>
						<th class="text-center" colspan="1">Action</th>
					</tr>
				</thead>
				<?php
					$view_announcement = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR AND Status = 'Active' ORDER BY PostDate DESC";
					$res_announce = mysqli_query($conn, $view_announcement);
					$count = mysqli_num_rows($res_announce);

					if ($count > 0) {			
						while ($row = mysqli_fetch_array($res_announce)) {
							$image = "../announcement_page/".$row['Image'];
						?>
							<tr>
								<td><img src="<?php echo $image; ?>" style="width:200px; height:200px;"></td>
							<td><?php echo $row['Title'] ?></td>
							<td class="font-weight-bold"><?php echo $row['Content'] ?></td>
							<td class="font-weight-bold text-warning"><?php echo $row['Status']?></td>
							<td><?php echo $row['PostBy'] ?></td>
							<td class="font-weight-bold text-secondary"><?php echo date('F j, Y - g:i A',(strtotime($row['PostDate'])))?></td>
							<td><a class="btn btn-teal" onclick="return confirm('Hide this announcement?');" href="crud_action.php?hide=<?php echo $row['AnnouncementID']; ?>"><span class="fa fa-eye-slash"></span> Hide </a></td>
			<?php	}  ?>
			<?php	} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-info-circle'></span> There are no Announcements Posted</h3></td></tr>";
				}
				?>
			</table>
		</div>
		</div>
       	</div>
       	<div class="tab-pane fade" id="viewInactiveAnnouncements">
       		<br>
       	<div class="table-scrol">
		<h1 class="text-center">Your Inactive Announcement(<?php echo $inact_announcement_count; ?>)</h1>
		<br>
		<!--<a class="btn btn-primary" href="admin-view-previous-announcement.php"><span class="fa fa-history"></span> View All Announcements</a>
		<h6>Note: Delete an announcement every 4-5 Days</h6> -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Status</th>
						<th colspan="1">Posted By</th>
						<th colspan="1">Posted Date</th>
						<th class="text-center" colspan="1">Action</th>
					</tr>
				</thead>
				<?php
					$view_announcement = "SELECT * FROM announcement WHERE Status = 'Inactive' ORDER BY PostDate DESC";
					$res_announce = mysqli_query($conn, $view_announcement);
					$count = mysqli_num_rows($res_announce);

					if ($count > 0) {			
						while ($row = mysqli_fetch_array($res_announce)) {
							$image = "../announcement_page/".$row['Image'];
						?>
							<tr>
								<td><img src="<?php echo $image; ?>" style="width:200px; height:200px;"></td>
								<td><?php echo $row['Title'] ?></td><td class="font-weight-bold"><?php echo $row['Content'] ?></td>
								<td class="font-weight-bold text-warning"><?php echo $row['Status']?></td>
								<td><?php echo $row['PostBy'] ?></td>
								<td class="font-weight-bold text-secondary"><?php echo date('F j, Y - g:i A',(strtotime($row['PostDate'])))?></td>
								<td><a class="btn btn-default" onclick="return confirm('Show this announcement?');" href="crud_action.php?show=<?php echo $row['AnnouncementID']; ?>"><span class="fa fa-eye"></span> Hide </a></td>
							</tr>
			<?php	} ?>
			<?php } else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-info-circle'></span> There are no Announcements Posted</h3></td></tr>";
				}
				?>
			</table>
		</div>
		</div>
       	</div>
       	<div class="tab-pane fade" id="viewAllAnnouncements" role="tabpanel">
       		<div class="table-scrol">
		<h1 style="text-align: center;">All Announcements(<?php echo $announcement_count; ?>)</h1>
		<br>
		<p>Note: Delete announcements regulary if it's unused</p>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Status</th>
						<th colspan="1">Posted By</th>
						<th colspan="1">Posted Date</th>
						<th class="text-center" colspan="3">Action</th>
					</tr>
				</thead>
				<?php
					$view_announcement = "SELECT * FROM announcement ORDER BY PostDate DESC";
					$res_announce = mysqli_query($conn, $view_announcement);
					$count = mysqli_num_rows($res_announce);
					if ($count > 0) {		
						while ($row = mysqli_fetch_assoc($res_announce)) {
							$image = "../announcement_image/".$row['Image'];
					?>
					<tr>
						<td><img height="200" width="250" src="<?php echo $image ?>"></td>
						<td><?php echo $row['Title']; ?></td>
						<td class="font-weight-bold"><?php echo $row['Content']; ?></td>
						<td class="font-weight-bold"><?php echo $row['Status']; ?></td>
						<td><?php echo $row['PostBy']; ?></td>
						<td class="font-weight-bold text-secondary"><?php echo htmlspecialchars(date('F j, Y - g:i A',(strtotime($row['PostDate'])))); ?></td>
						<td><a class="btn btn-default" onclick="return confirm('Show this announcement?');" href="crud_action.php?show=<?php echo $row['AnnouncementID']; ?>"><span class="fa fa-eye"></span> Show</a></td>
						<td><a class="btn btn-primary" href="admin-edit-announcement.php?announce_edit=<?php echo $row['AnnouncementID']; ?>"><span class="fa fa-edit"></span> Edit</a></td>
						<td><a class="btn btn-danger" onclick="return confirm('Delete this announcement?');" href="crud_action.php?del_announce=<?php echo $row['AnnouncementID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
					</tr>
			<?php	} ?>

			<?php } else {
					echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> There no Announcements</h3></td></tr>";
				} ?>
			</table>
		</div>
	</div>
       	</div>
       </div>
</div>
<script>
	function countChars(textbox, counter, max) {
  var count = max - document.getElementById(textbox).value.length;
  if (count < 0) { document.getElementById(counter).innerHTML = "<span style=\"color: red;\">" + count + "</span>";
  	  document.getElementById('btn_post').disabled = true;
} else { document.getElementById(counter).innerHTML = count;
		 document.getElementById('btn_post').disabled = false; }
}
</script>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>
<script src=../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
   <script>
     new WOW().init();
		// Material Select Initialization
	$(document).ready(function() {
   	$('.mdb-select').material_select();
 	});
	</script>
</body>
</html>