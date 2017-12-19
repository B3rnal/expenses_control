<?php 
session_start();
//check session
if(!isset($_SESSION["current_user"])){
	header("Location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER ["HTTP_HOST"]);
	die();
}
//end check session

?>