<?php
	
	include ('../connection.php');
	session_start();
	$session_admin = htmlspecialchars($_SESSION['admin_user']);

	if (isset($_GET['show']) && is_numeric($_GET['show'])) {
		
		$show = htmlspecialchars($_GET['show']);
		$show_sql = "UPDATE announcement SET Status = 'Active', PostBy = '$session_admin', PostDate = NOW() WHERE AnnouncementID = '$show'";
		$show_res = mysqli_query($conn, $show_sql);
		
		echo "<script>
			alert('Successfully showed an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	}
?>