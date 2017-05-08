<?php
include ("../model/user-model.php");

// Select all users 
function getUsers(){
	$result = selectUsers();//funcition from user-model
	// echo gettype($result);
	if (gettype($result)!= 'string') {; //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		return json_encode($jTableResult);
	}
	return $result;	
}

// Select specific User by Id
function getSpecificUser($userId){
	$result = selectSpecificUser($userId);//funcition from user-model
	// echo gettype($result);
	if (gettype($result)!= 'string') {; //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		return json_encode($rows);//convertir a json
	}
	return $result;	
}


// Select specific User By Employee Number
function getUserByNumber($employeeNumber){
	$result = selectUserByNumber($employeeNumber);//funcition from user-model
	// echo gettype($result);
	if (gettype($result)!= 'string') {; //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		return json_encode($rows);//convertir a json
	}
	return $result;	
}

//Add User
function newUser($employeeNumber, $name, $email, $department, $type){
	$result = getUserByNumber($employeeNumber);
	echo "--------";
	print $result;
	echo "--------";
	print gettype($result);
	if ($result == '0 results'){
		$result = addUser($employeeNumber, $name, $email, $department, $type);//funcition from user-model
		return "<br>User Added<br>";
	}
	return "<br>Employee Number already used<br>";
}


//Update user
function modifyUser($id, $employeeNumber, $name, $email, $department, $type){
	$result = updateUser($id, $employeeNumber, $name, $email, $department, $type);
	echo "--------";
	print $result;
	echo "--------";
}

//Delete user
function deleteUser($id){
	$result = deleteUserById($id);
	echo "--------";
	print $result;
	echo "--------";
}



//print deleteUser(1);
//
// print getUserByNumber(320);


//addUser(320, "Bernal Araya" , "bernala@gmail.com",2);
// $result = selectUsers();
// while($row = $result->fetch_assoc()) {
//         echo "<br>- id: " . $row["idUser"]. " - EmpNum: " . $row["EmployeeNumber"] . " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
// }
?>	