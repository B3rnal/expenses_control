<?php
include ("connection.php");
$conn = Db::getConnection();

// Select all Users
function selectUsers(){
	global $conn;
	$sql = "SELECT * FROM User";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return "0 results";
	}
	return $result;
}

// Select specific User by Id
function selectSpecificUser($userId){
	global $conn;
	$sql = "SELECT * FROM User where idUser = " . $userId;
	echo"<br>Select from selectSpecificUser: "  . $sql . "<br>";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return "0 results";
	}
	return $result;
}

// Select specific User By Employee Number
function selectUserByNumber($employeeNumber){
	global $conn;
	$sql = "SELECT * FROM User where EmployeeNumber = " . $employeeNumber;
	echo"<br>Select from selecUserByNumber: "  . $sql . "<br>";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return "0 results";
	}
	return $result;
}

// Add User
function addUser($employeeNumber, $name, $email, $department, $type){
	global $conn;
	//INSERT INTO `ExpRep_DB`.`User` (`EmployeeNumber`, `Name`, `Email`, `UserTypeId`) VALUES ('318', 'Bernal', 'bernala@thehanger.cr', '1');
	$sql = "INSERT INTO `User` (`EmployeeNumber`, `Name`, `Email`, `Department`, `UserTypeId`) VALUES ( '" . $employeeNumber . "', '" . $name . "', '" . $email . "', '" . $department . "', '" . $type . "');";
	echo "<br>Select from add User:" . $sql . "<br>";
	$result = $conn->query($sql);
	echo "<br>" . $result ."<br>";
	return $result;

}



// Update User
function updateUser($id, $employeeNumber, $name, $email, $department, $type){
	global $conn;
	$sql = "UPDATE `User` SET `EmployeeNumber` = \"" . $employeeNumber ."\" , `Name` = \"" . $name . "\" , `Email` = \"" . $email . "\" , `Department` = \"" . $department . "\" , `UserTypeId` = \"" . $type . "\" WHERE `idUser`=  \"" . $id . "\"";
	echo"<br>Select from selectSpecificUser=" . $sql . "<br>";
	$result = $conn->query($sql);
	//echo "<br>" . $result ."<br>";
	return $result;

}

//Delete User 
function deleteUserById($id){
	global $conn;
	$sql = "DELETE FROM User WHERE `idUser`=  \"" . $id . "\"";
	echo"<br>Select from selectSpecificUser=" . $sql . "<br>";
	$result = $conn->query($sql);
	return $result;
}


// $result = selectUsers();
// $rows = array();
// while($r = $result->fetch_assoc()) {
//     $rows[] = $r;
// }
// print json_encode($rows);

?>


