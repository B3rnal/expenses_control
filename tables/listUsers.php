<?php
include ("../controlers/user-controler.php");

$action = $_GET['action']?$_GET['action']:$_POST['action'];


if($action == 'list'){
	echo getUsers();
}


else if ($action == 'delete'){
	echo deleteUser($_POST['idUser']);
}

else if ($action == 'create'){
	echo newUser($_POST['EmployeeNumber'], $_POST['Name'], $_POST['Email'], $_POST['Department'], $_POST['UserTypeId']);
}

else if ($action == 'update'){
	echo modifyUser($_POST['idUser'],$_POST['EmployeeNumber'], $_POST['Name'], $_POST['Email'], $_POST['Department'], $_POST['UserTypeId']);
}

else if($action == 'listUsers'){
	echo listAllUsers();
}

else if ($action =='listUsersJS'){
	
	$aResult = array();
	$list = listAllUsersJS();
	if(empty($list)) {
       $aResult['error'] = 'Empty Expenses Data';
   	}
   	else {
       $aResult['result'] = $list;
   	}
    echo json_encode($aResult);
} 

/*if($_GET['action']=='listUsersJS'){
	return listAllUsersJS();
}*/

//echo listAllUsersJS();
?>