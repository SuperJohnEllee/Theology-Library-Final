<?php
	
	include ('../connection.php');

	if ($_GET['locate']) {

		$url = '192.168.1.112:15580';
		$locate = htmlspecialchars($_GET['locate']);

	}
?>