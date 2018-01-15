<?php
	session_start();
	unset($_SESSION["current_user"]);
	session_destroy();
	header("Location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER ["HTTP_HOST"]."/myExpenses.php");
	die();
?>