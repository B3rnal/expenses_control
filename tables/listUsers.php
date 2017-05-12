<?php
include ("../controlers/user-controler.php");


if($_GET['action']=='list'){
	echo getUsers();
}


if($_GET['action']=='delete'){
	echo deleteUser($_POST['idUser']);
}

if($_GET['action']=='create'){
	echo newUser($_POST['EmployeeNumber'], $_POST['Name'], $_POST['Email'], $_POST['Department'], $_POST['UserTypeId']);
}

if($_GET['action']=='update'){
	echo modifyUser($_POST['idUser'],$_POST['EmployeeNumber'], $_POST['Name'], $_POST['Email'], $_POST['Department'], $_POST['UserTypeId']);
}

?>