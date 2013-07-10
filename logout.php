<?php
	if (!isset($_SESSION))
	{
		session_start();
	}
	unset($_SESSION["account"]);
	unset($_SESSION["name"]);
	unset($_SESSION["permission"]);
	header("Location: ../index.php");
?>