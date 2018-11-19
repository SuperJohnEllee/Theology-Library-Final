<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!isset($_SESSION['admin_user'])) {
		session_unset();
		session_destroy();
		header("location: index.php");
	} 
	include ('../connection.php');
	include('../function/function.php');
	//Displays Number of Inactive Announcements
	$sql = "SELECT AnnouncementID FROM announcement";
	$res_sql = mysqli_query($conn, $sql);
	$announcement_count = mysqli_num_rows($res_sql);
	

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1">
	<meta name="viewport" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<style>.hello { text-align: left; }</style>
</head>
<body class="cyan lighten-5" oncontextmenu="return false">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="table-scrol">
		<h1 style="text-align: center;">Your Previous Announcements(<?php echo $announcement_count; ?>)</h1>
		<br>
		<p>Note: Delete announcements regulary if it's unused</p>
		<div class="table-responsive">
			<table class="table table-hover" id="tblAnnounce">
				<thead class="thead-inverse">
					<tr>
						<th colspan="1">Image</th>
						<th colspan="1">ID</th>
						<th colspan="1">Title</th>
						<th colspan="1">Content</th>
						<th colspan="1">Status</th>
						<th colspan="1">Posted By</th>
						<th colspan="1">Posted Date</th>
						<th class="text-center" colspan="3">Action</th>
					</tr>
				</thead>
				<?php
					allAnnouncements();
				?>
			</table>
		</div>
	</div>
	</div>
<!--JavaScript Libraries-->

<script>
	var table = document.getElementById('tblAnnounce'), rIndex;

	for (var i = 0; i < table.rows.length; i++) {
		table.rows[i].onclick = function(){
			rIndex = this.rowIndex;

			document.getElementById('txtGetID').value = this.cells[1].innerHTML;
		}
	}

	$('.datepicker').pickadate();
</script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/popper.min.js"></script>
 <script type="text/javascript" src="https://mdbootstrap.com/previews/docs/latest/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.6/js/mdb.min.js"></script>
</body>
</html>