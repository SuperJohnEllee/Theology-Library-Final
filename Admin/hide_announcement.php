<?php

	include('../connection.php');

	if (isset($_GET['hide']) && is_numeric($_GET['hide'])) {
		
		$hide = htmlspecialchars($_GET['hide']);
		$hide_sql = "UPDATE announcement SET Status = 'Inactive' WHERE AnnouncementID = '$hide'";
		$hide_res = mysqli_query($conn, $hide_sql);

		echo "<script>
			alert('Successfully hide an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	}
?>