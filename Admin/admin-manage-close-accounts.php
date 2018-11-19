<!DOCTYPE html>
<?php
	include('../connection.php');
	include('../function/function.php');
	session_start();
	session_set_cookie_params(432000);
	$session_user = htmlspecialchars($_SESSION['admin_user']);

	if (!$session_user) {
		header("location: index.php");
	}
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
<body>
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
	</nav><br><br><br>
	<div class="container"> 
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-close"></span> Closed User Accounts</h1>
			<h4>List of Closed Accounts</h4>
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Name</th>
						<th>Remarks</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_close_acc = mysqli_query($conn, "SELECT * FROM remarks ORDER BY RemarksDate ASC");

						if (mysqli_num_rows($disp_close_acc) > 0) {
							while ($row = mysqli_fetch_assoc($disp_close_acc)) {
						?>
							<tr>
								<td><?php echo $row['Name']; ?></td>
								<td><?php echo $row['Content']; ?></td>
								<td><?php echo $row['RemarksDate']; ?></td>
								<td><a class="btn btn-danger" onclick="return confirm('Arre you sure you want delete this?');" href="crud_action.php?close_acc_del=<?php echo $row['RemarksID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
							</tr>

						<?php	}
						} else {
				 			echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            	<span class='fa fa-warning'></span> No Close Accounts found</h3></td></tr>";
						} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>