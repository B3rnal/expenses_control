<?php
include ("connection.php");
$conn = Db::getConnection();

// Select all values
function selectValues(){
	global $conn;
	$sql = "SELECT * FROM CurrencyValue";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		return false;
	}
	return $result;
}


// Add Value
function addValue($date, $value, $id){
	global $conn;
	$sql = "INSERT INTO `CurrencyValue` (`Date`, `Value`, `Currency_id`) VALUES ( '" . $date . "', '" . $value . "', '" . $id ."');";
	//var_dump($sql);
	$result = $conn->query($sql);
	return $result;

}

// Select specific value Id by date 
function selectValueByDate($date, $id){
	global $conn;
	$sql = "SELECT Value FROM CurrencyValue where Date = '" . $date . "' and Currency_id = " . $id ;
	//var_dump($sql);

	$result = $conn->query($sql);
	if ($result->num_rows != 0){
		return $result;
	}
	
	return false;
}

?>


