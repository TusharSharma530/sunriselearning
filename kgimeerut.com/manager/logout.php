<?php include 'config.php';
	session_destroy();
	echo "<script>window.location.href='{$path}manager/index.php';</script>";
 ?>