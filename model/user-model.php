<?php
include ("connection.php");
$conn = Db::getConnection();

// Select all Users
function selectUsers(){
	global $conn;
	$sql = "SELECT * FROM User";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

// Select specific User by Id
function selectSpecificUser($userId){
	global $conn;
	$sql = "SELECT * FROM User where idUser = " . $userId;
	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result;
	}
	return false;
}

// Select specific User By Employee Number
function selectUserByNumber($employeeNumber){
	global $conn;
	$sql = "SELECT * FROM User where EmployeeNumber = " . $employeeNumber;
	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result;
	}
	return false;
}

// Add User
function addUser($employeeNumber, $name, $email, $department, $type){
	global $conn;
	$sql = "INSERT INTO `User` (`EmployeeNumber`, `Name`, `Email`, `Department`, `UserTypeId`) VALUES ( '" . $employeeNumber . "', '" . $name . "', '" . $email . "', '" . $department . "', '" . $type . "');";
	$result = $conn->query($sql);
	return $result;

}



// Update User
function updateUser($id, $employeeNumber, $name, $email, $department, $type){
	global $conn;
	$sql = "UPDATE `User` SET `EmployeeNumber` = \"" . $employeeNumber ."\" , `Name` = \"" . $name . "\" , `Email` = \"" . $email . "\" , `Department` = \"" . $department . "\" , `UserTypeId` = \"" . $type . "\" WHERE `idUser`=  \"" . $id . "\"";
	$result = $conn->query($sql);
	return $result;

}

//Delete User
function deleteUserById($id){
	global $conn;
	$sql = "DELETE FROM User WHERE `idUser`=  \"" . $id . "\"";
	$result = $conn->query($sql);
	return $result;
}

//Selecting  Users and Employee numbers
function listUsers(){
	global $conn;
	$sql = "SELECT EmployeeNumber as Value, Name as DisplayText FROM User ORDER BY DisplayText ASC";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

//Login  verification
function validateUser($email,$pass){
	global $conn;
	$sql = "SELECT * FROM User where Email = '" . $email . "' AND Password = '" .$pass . "'";
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result;
	}
	return false;
}

//var_dump( validateUser("Bernal", "password"));

?>
