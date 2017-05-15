<?php
include ("connection.php");
$conn = Db::getConnection();

// Select all Expenses
function selectExpenses(){
	global $conn;
	$sql = "SELECT ExpenseReport.idExpenseReport, ExpenseReport.ExpenseCustomId, ExpenseReport.Name, ExpenseReport.Billable, ExpenseReport.Proyect, ExpenseReport.CreationDate, a.Name AS 'User', b.Name AS 'Supervisor', ExpenseReport.ExpenseStatusId 
			FROM ExpenseReport
			INNER JOIN User AS a ON ExpenseReport.EmployeeId=a.EmployeeNumber
			INNER JOIN User AS b ON ExpenseReport.SupervisorId=b.EmployeeNumber;";
	//cho $sql;
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

// // Select specific User by Id
// function selectSpecificUser($userId){
// 	global $conn;
// 	$sql = "SELECT * FROM User where idUser = " . $userId;
// 	$result = $conn->query($sql);
// 	if ($result->num_rows != 0){
// 		return $result;
// 	}
// 	return false;
// }

// // Select specific User By Employee Number
// function selectUserByNumber($employeeNumber){
// 	global $conn;
// 	$sql = "SELECT * FROM User where EmployeeNumber = " . $employeeNumber;
// 	$result = $conn->query($sql);
// 	if ($result->num_rows != 0){
// 		return $result;
// 	}
// 	return false;
// }

// // Add User
// function addUser($employeeNumber, $name, $email, $department, $type){
// 	global $conn;
// 	$sql = "INSERT INTO `User` (`EmployeeNumber`, `Name`, `Email`, `Department`, `UserTypeId`) VALUES ( '" . $employeeNumber . "', '" . $name . "', '" . $email . "', '" . $department . "', '" . $type . "');";
// 	$result = $conn->query($sql);
// 	return $result;

// }



// // Update User
// function updateUser($id, $employeeNumber, $name, $email, $department, $type){
// 	global $conn;
// 	$sql = "UPDATE `User` SET `EmployeeNumber` = \"" . $employeeNumber ."\" , `Name` = \"" . $name . "\" , `Email` = \"" . $email . "\" , `Department` = \"" . $department . "\" , `UserTypeId` = \"" . $type . "\" WHERE `idUser`=  \"" . $id . "\"";
// 	$result = $conn->query($sql);
// 	return $result;

// }

// //Delete User 
// function deleteUserById($id){
// 	global $conn;
// 	$sql = "DELETE FROM User WHERE `idUser`=  \"" . $id . "\"";
// 	$result = $conn->query($sql);
// 	return $result;
// }
?>


