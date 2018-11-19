<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = $_SESSION['admin_user'];
	if (!$session_user) {
		header("location: index.php");
	}
	
	include ('../connection.php');
	include('../function/function.php');

	$user_sql = "SELECT * FROM users";
	$user_res = mysqli_query($conn, $user_sql);
	$user_row = mysqli_fetch_assoc($user_res);
	$user_count = mysqli_num_rows($user_res);
	
	if (isset($_GET['page'])) {
		$page = htmlspecialchars($_GET['page']);
	} else {
		$page = 1;
	}

	$no_per_page = 10;
	$offset = ($page - 1) * $no_per_page;

	$page_sql = "SELECT COUNT(*) FROM users";
	$res_page = mysqli_query($conn, $page_sql);
	$page_rows = mysqli_fetch_assoc($res_page);

	$total_page_sql = "SELECT * FROM users LIMIT $offset, $no_per_page";
?>
<!DOCTYPE html>
<html>
<head>
	<title> College of Theology Library - View Users</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light text-white mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler grey darken-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<h1 class="text-center"><span class="fa fa-user"></span> User Account Information(<?php echo $user_count; ?>)</h1>
		<br>
			<ul class="nav nav-tabs md-tabs nav-justified">
				 <li class="nav-item">
                	<a class="nav-link active" data-toggle="tab" href="#activeUsers" role="tab"><span class="fa fa-plus"></span> Active Users</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#inactiveUsers" role="tab"><span class="fa fa-eye"></span> Inactive Users</a>
            	 </li>
			</ul><br><br>
		<form method="post">
			<div class="form-group">
				<div class="input-group col-md-9">
					<input type="text" name="user_search" id="user_search" onkeyup="filterSearch()" class="form-control">
					<button class="btn btn-primary" name="btn_search"><span class="fa fa-search"></span> Search</button>
				</div>
			</div>
		</form>
		<h4 class="text-center">Note: Search for Name</h4>
		<h4 class="col-md-9">Active Users: <?php countActiveUsers(); ?> <br>Inactive Users: <?php countInactiveUsers(); ?></h6>
		<div class="tab-content card mdb-color text-white">
			<div class="tab-pane fade in show active" id="activeUsers" role="tabpanel">
				<h3 class="text-center">Active Users:<?php countActiveUsers(); ?></h3>
			<div class="table-responsive">
				<table id="user_table" class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Name</th>
							<th>Gender</th>
							<th>Type</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Status</th>
							<th>Username</th>
							<th>Registered Date</th>
							<th colspan="2" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if (isset($_POST['btn_search'])) {
			$search = mysqli_real_escape_string($conn, $_POST['user_search']);
			$sql = "SELECT * FROM users WHERE 
						 UserLName LIKE '%$search%'
						OR UserFName LIKE '%$search%'
						OR UserMName LIKE '%$search%'
						OR UserType LIKE '%$search%'
						OR UserEmail LIKE '%$search%'
						OR UserContactNumber LIKE '%$search%'
						OR UserStatus LIKE '%$search%'
						OR Username LIKE '%$search%'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);

				if ($count > 0) {
							
					while ($row = mysqli_fetch_assoc($result)) {

					$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr><td>'.$fullname.'</td>';
						echo '<td>'.$row['UserType'].'</td>';
						echo '<td>'.$row['UserGender'].'</td>';
						echo '<td>'.$row['UserEmail'].'</td>';
						echo '<td>'.$row['UserContactNumber'].'</td>';
						echo '<td>'.$row['UserStatus'].'</td>';
						echo '<td>'.$row['Username'].'</td>';
						echo '<td>'.$row['UserRegisterDate'].'</td>';
						echo '<td><a class="btn btn-danger" href="crud_action.php?user_deact='.htmlspecialchars($row['UsersID']).'"><span class="fa fa-close"></span> Disabled</a></td></tr>';
					}
					echo "<h3 class='alert alert-success text-center'><span class='fa fa-check'></span>
    						".$count." results found 
  							</h3>";

				} else {
					echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-warning'></span> Keyword '$search' was not found</h3></td></tr>";
				}
			} else {

				$sql = "SELECT * FROM users WHERE UserStatus = 'Active' ORDER BY UserRegisterDate DESC";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
					?>
						<tr>
							<td><?php echo $fullname ?></td>
							<td><?php echo $row['UserGender'] ?></td>
							<td><?php echo $row['UserType'] ?></td>
							<td><?php echo $row['UserEmail'] ?></td>
							<td><?php echo $row['UserContactNumber'] ?></td>
							<td class="font-weight-bold orange-text"><?php echo $row['UserStatus'] ?></td>
							<td><?php echo $row['Username'] ?></td>
							<td><?php echo $row['UserRegisterDate'] ?></td>
							<td><a class="btn btn-danger" onclick="return confirm('Deactivate this user?')" href="crud_action.php?user_deact=<?php echo $row['UsersID'] ?>"><span class="fa fa-close"></span> Disabled</a></td>
						</tr>
			<?php 	} ?>
			<?php	} else {
					echo "<h3 class='alert alert-warning text-center'><span class='fa fa-warning'></span> No users found</h3>";
				}
			}
					?>
				</tbody>
			</table>
		</div>
		</div>
		<div class="tab-pane fade" id="inactiveUsers" role="tabpanel">
			<h3 class="text-center">Inactive Users: <?php countInactiveUsers(); ?></h3>
			<div class="table-responsive">
				<table id="user_table" class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Name</th>
							<th>Gender</th>
							<th>Type</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Status</th>
							<th>Username</th>
							<th>Registered Date</th>
							<th colspan="2" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						inactiveUsers();
					?>	
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>

	//filter search
function filterSearch() {
 	 var input, filter, table, tr, td, i;
  		input = document.getElementById("user_search");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("user_table");
  		tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[0];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        		tr[i].style.display = "none";
      		}
    	}       
  	}
}
	function print()
	{
		window.print();
	}
</script>
<!-- JavaScript Libraries -->
<script src="../js/jquery.min.js"></script>
<script src=../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>