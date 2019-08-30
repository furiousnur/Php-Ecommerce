<?php 

	session_start();

	session_destroy();

	echo "<script>window.location.href='admin_login.php?logout=You successfully logged out!'</script>";
	


 ?>