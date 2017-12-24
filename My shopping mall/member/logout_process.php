<?

	session_start();
	session_destroy();

	SetCookie("p_sid","", time(),"/");

	echo "<meta http-equiv='Refresh' content='0;url=/index.php'>";

?>