<?php
include ("connection.php");
$conn = Db::getConnection();



function returnSeverDate(){
	date_default_timezone_set('America/Costa_Rica');
	return date('m/d/Y - h:i:s a', time());
}

//Select all the lines of one specific Expense Report
function selectExpenseLines($expenseCustomId){
	global $conn;
	$sql = "SELECT ExpenseLine.*, e.ExpenseCustomId 
			FROM ExpenseLine 
			INNER JOIN ExpenseReport AS e ON ExpenseLine.ExpenseReportId=e.idExpenseReport
			WHERE ExpenseCustomId='".$expenseCustomId."';";	
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}

function selectSpecificLine($id){
	global $conn;
	//var_dump("ingresando a la consulta del ultimo ID:".$id);
	$sql = "SELECT ExpenseLine.*, e.ExpenseCustomId 
			FROM ExpenseLine 
			INNER JOIN ExpenseReport AS e ON ExpenseLine.ExpenseReportId=e.idExpenseReport
			WHERE idExpenseLine='".$id."';";	
	//var_dump("<br>".$sql."<br>");
	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result->fetch_assoc();
	}
	return false;
}

// Add Line
function addExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable){
	global $conn;
	$last_id;
	$sql = "INSERT INTO `ExpenseLine`(`ExpenseReportId`, `ExpenseTypeid`, `Date`, `Detail`, `Place`, `Amount`, `Currency`, `Billable`, `ModificationLog`) VALUES ( '" . $expenseId . "', '" . $typeId . "', '" . $date . "', '" . $detail . "', '" .$place . "', '" .$amount . "', '" .$currency . "', '" .$billable . "', '" .returnSeverDate(). "');";
	if ($conn->query($sql) === TRUE) {
	    $last_id = $conn->insert_id;
	} else {
	    $conn->error;
	}
	//var_dump($last_id . "<br>");
	$result=selectSpecificLine($last_id);

	//var_dump(json_encode($result));
	return $result;
}


//Delete Line
function deleteLineById($id){
	global $conn;
	$sql = "DELETE FROM ExpenseLine where idExpenseLine = \"" . $id . "\"";
	$result = $conn->query($sql);
	return $result;
}

// Update Expense 
function updateExpenseLine($expenseId, $typeId, $date, $detail, $place, $amount, $currency, $billable, $user){
	global $conn;
	$sql = "UPDATE `ExpenseLine` SET `ExpenseTypeid` = \"" . $typeId . "\" ,
	 `Date` = \"" . $date . "\" , 
	 `Detail` = \"" . $detail . "\" , 
	 `Place` = \"" . $place . "\" , 
	 `Amount` = \"" . $amount . "\" , 
	 `Currency` = \"" . $currency . "\" , 
	 `Billable` = \"" . $billable . "\" , 
	 `ModificationLog` = \"" .returnSeverDate()." by ".$user."\" 
	 WHERE `idExpenseLine`=  \"" . $expenseId . "\"";
	 //echo $sql;
	$result = $conn->query($sql);
	return $result;
}

//Total from all lines
function getTypeTotal($id){
	global $conn;
	$sql="SELECT ExpenseTypeId , e.ExpenseName as Type, sum(Amount) as Total
		FROM ExpRep_DB.ExpenseLine
		Inner Join ExpenseType AS e ON ExpenseLine.ExpenseTypeid=e.idExpenseType
		Where ExpenseReportId = ". $id .
		" group by ExpenseTypeId";
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result){ //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		return json_encode($rows);
	}
	return null;
}

//Get Billable or Non Billable Total
function getBillableTypeTotal($id, $billable){
	global $conn;
	$sql="SELECT ExpenseTypeId , e.ExpenseName as Type, sum(Amount) as Total
		FROM ExpRep_DB.ExpenseLine
		Inner Join ExpenseType AS e ON ExpenseLine.ExpenseTypeid=e.idExpenseType
		Where ExpenseReportId = ". $id . " AND Billable = ". $billable ."
		 group by ExpenseTypeId";
	//var_dump($sql);
	$result = $conn->query($sql);
	if ($result){ //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		return json_encode($rows);
	}
	return null;
}




//Custom^^^^------------------------------------------------------------------------------------
//var_dump(addExpenseLine(3, 1, "2017-10-08", "uber", "canada", 10, 1, 1));
//function selectExpenses($expenseCustomId,$employeeId,$department,$status,$billable)

//var_dump(getBillableTypeTotal(4,1));
?>