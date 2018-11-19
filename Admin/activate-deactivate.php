<?php
	
	/*
		activate-deactivate php file for admins and users

		return keywords

		Active --> Activate user account
		Inactive --> Deactivate user account

		Hide --> Hide an announcement
		Show --> Show an annoucement
	*/
	include ('../connection.php');
	session_start();
	$session_admin = htmlspecialchars($_SESSION['admin_user']);
	$session_name = htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']);
	date_default_timezone_set('Asia/Manila');

	//For the Admin
	if (isset($_GET['act'])) {
		
		$act = htmlspecialchars($_GET['act']);
		$act_sql = "UPDATE admin SET AdminStatus = 'Active' WHERE AdminID = '$act'";
		$act_res = mysqli_query($conn, $act_sql);
		header("location: admin-account-management.php");
	
	} else if(isset($_GET['deact'])) {

		$deact = htmlspecialchars($_GET['deact']);
		$deact_sql = "UPDATE admin SET AdminStatus = 'Inactive' WHERE AdminID = '$deact'";
		$deact_res = mysqli_query($conn, $deact_sql);
		header("location: admin-account-management.php");
	}

	//For the Users
	if (isset($_GET['user_act'])) {
			
			$user_act = htmlspecialchars($_GET['user_act']);
			$user_act_sql = "UPDATE users SET UserStatus = 'Active' WHERE UsersID = '$user_act'";
			$user_act_res = mysqli_query($conn, $user_act_sql);

		echo "<script>
			alert('Successfully activated a user');
		</script>
		<meta http-equiv='refresh' content='0; url=view_users.php'>";
	
	} else if (isset($_GET['user_deact']) {
		
		$user_deact = htmlspecialchars($_GET['user_deact']);
		$user_deact_sql = "UPDATE users SET UserStatus = 'Inactive' WHERE UsersID = '$user_deact'";
		$user_deact_res = mysqli_query($conn, $user_deact_sql);
		
		echo "<script>
			alert('Successfully deactivated a user');
		</script>
		<meta http-equiv='refresh' content='0; url=view_users.php'>";
	}

	//For Announcements

	if (isset($_GET['show'])) {
		
		$show = htmlspecialchars($_GET['show']);
		$show_sql = "UPDATE announcement SET Status = 'Active', PostBy = '$session_name', PostDate = NOW() WHERE AnnouncementID = '$show'";
		$show_res = mysqli_query($conn, $show_sql);
		
		echo "<script>
			alert('Successfully showed an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	
	}else if (isset($_GET['hide'])) {
		
		$hide = htmlspecialchars($_GET['hide']);
		$hide_sql = "UPDATE announcement SET Status = 'Inactive' WHERE AnnouncementID = '$hide'";
		$hide_res = mysqli_query($conn, $hide_sql);

		echo "<script>
			alert('Successfully hide an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	}


	//For Location of Books
	if (isset($_GET['locate_on'])) {
			
			$locate_on = htmlspecialchars($_GET['locate_on']);
			$locate = htmlspecialchars($_GET['locate']);

			$loc_sql = mysqli_query($conn, "SELECT * FROM theo_books WHERE BookShelfNumber = '$locate_on'");
			$loc_row = mysqli_fetch_assoc($loc_sql);
			
			$url = urlencode('192.168.1.112:15580');



	} else if (isset($_GET['locate_off'])) {
			
			$locate_off = htmlspecialchars($_GET['locate_off']);
			$locate = htmlspecialchars($_GET['locate']);

			$loc_sql = mysqli_query($conn, "SELECT * FROM theo_books WHERE BookShelfNumber = '$locate_on'");
			$loc_row = mysqli_fetch_assoc($loc_sql);
			
			$url = urlencode('192.168.1.112:15580');
	}	
?>