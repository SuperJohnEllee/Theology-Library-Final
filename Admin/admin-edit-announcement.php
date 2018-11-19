<!DOCTYPE html>
<?php 
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_name = htmlspecialchars($_SESSION['name']);
	if (!$session_admin_user) {
		header("location: index.php");
	}

	include('../connection.php');
	include('../function/function.php');

	//Update Announcement function
	updateAnnouncement();

	$id = htmlspecialchars($_GET['announce_edit']);
	$sql = "SELECT * FROM announcement WHERE AnnouncementID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row_content = htmlspecialchars($row['Content']);
	$row_image = '../announcement_image/'. htmlspecialchars($row['Image']);
	//$_REQUEST['content'] = $row_content;
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5" role="document">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</div>
	</nav><br><br>
<div class="container"><br>
	<div class="page-header">
		<h1><span class="fa fa-edit"></span> Edit announcement</h1>
	</div>
	<hr class="divider"><br>
	<div class="row">
		<div class="col-md-6">
			<form action="admin-edit-announcement.php" method="post" enctype="multipart/form-data">
				<div class="md-form">
					<input type="hidden" name="id" name="id" value="<?php echo htmlspecialchars($row['AnnouncementID']); ?>">
				</div>
				<div class="md-form">
					<img height="250" width="250" src="<?php echo htmlspecialchars($row_image); ?>">
					<input class="form-control" type="file" name="image" 
					value="<?php echo htmlspecialchars($row_image); ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-header prefix"></i>
					<input class="form-control" type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['Title']); ?>">
					<label for="title">Title</label>
				</div>
				<div class="md-form">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" id="AddAnnounceForm_Cont" onFocus="countChars('AddAnnounceForm_Cont','text-counter',1000)" onKeyDown="countChars('AddAnnounceForm_Cont','text-counter',1000)"
					onKeyUp="countChars('AddAnnoucementForm','text-counter',1000)" name="content" rows="7" style="resize: none; margin-bottom:8px;"autofocus maxlength="1001"><?php echo $row['Content']; ?></textarea>
					<label for="content">Content</label>
				</div>
				<span style="color: gray;">Edit as <span class="font-weight-bold"><?php echo $session_admin_user; ?></span></span>
				<button type="submit" class="btn btn-info pull-right" name="btn_save"><span class="fa fa-save"></span> Save Changes</button>
				<span class="pull-right" id="text-counter" style="margin-top:8px;margin-right:8px; color:gray;">&nbsp;1000</span>
			</form>
		</div>
	</div>
</div>
<script>
	function countChars(textbox, counter, max) {
  var count = max - document.getElementById(textbox).value.length;
  if (count < 0) { document.getElementById(counter).innerHTML = "<span style=\"color: red;\">" + count + "</span>";
  	  document.getElementById('AddNewsForm_Submit').disabled = true;
} else { document.getElementById(counter).innerHTML = count;
		document.getElementById('AddNewsForm_Submit').disabled = false;
   }
}
</script>
<!--JavaScript Libraries-->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/mdb.min.js"></script>
<script>
	new WOW().init();
	$(document).ready(function(){
		$('.mdb-select').material_select();
	});
</script>
</body>
</html>