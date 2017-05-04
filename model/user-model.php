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

// Select specific User
function selectSpecificUser($userId){
	global $conn;
	$sql = "SELECT * FROM User where idUser = " . $userId;
	echo"<br>Select from selectSpecificUser: "  . $sql;
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return "0 results";
	}
	return $result;
}

// Update User
function updateUser($id, $employeeNumber, $name, $email, $type){
	global $conn;
	$sql = "UPDATE `User` SET `EmployeeNumber` = \"" . $employeeNumber ."\" , `Name` = \"" . $name . "\" , `Email` = \"" . $email . "\" , `UserTypeId` = \"" . $type . "\" WHERE `idUser`=  \"" . $id . "\"";
	echo"<br>Select from selectSpecificUser=" . $sql;
	$result = $conn->query($sql);
	echo "<br>" . $result ."<br>";
	return $result;

}

//Delete User 
function deleteUser($id){
	global $conn;
	$sql = "DELETE FROM User WHERE `idUser`=  \"" . $id . "\"";
	echo"<br>Select from selectSpecificUser=" . $sql;
	$result = $conn->query($sql);
	return $result;
}

deleteUser(5);
$result = selectUsers();
while($row = $result->fetch_assoc()) {
        echo "<br>- id: " . $row["idUser"]. " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
}


// $sql = "SELECT idUser, Name, Email FROM User";

// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "- id: " . $row["idUser"]. " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

?>


