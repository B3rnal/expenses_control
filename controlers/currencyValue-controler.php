<?php
include ("../model/currency-value-model.php");

// Select all values 
function getValues(){
	$result = selectValues();//funcition from currency-value-model
	if ($result){ //cheking type of data.
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows[] = $r;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		return json_encode($jTableResult);
	}
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = "Emtpy Data";
	return json_encode($jTableResult);
}


// add New Value 
function newValue($date, $id, $value){ 
	$result = addValue($date, $value,$id);//funcition from currency-value-model
	return $result;
}

//get specific value
function getSpecificValue($date, $id){
	$timestamp = strtotime($date);
	$day= date("N", $timestamp);
	if($day==6){ //saturday
		$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
		$date = date ( 'Y-m-d' , $newdate );
	}else if($day==7){ //saturday
		$newdate = strtotime ( '-2 day' , strtotime ( $date ) ) ;
		$date = date ( 'Y-m-d' , $newdate );
	}
	$result=selectValueByDate($date, $id);
	return $result;
}


function getCurrencyExchange($typeFrom, $value,$date){//If the value its in the DB will call it, otherwise will take it from the webservice
	$result=getSpecificValue($date,$typeFrom);
	if ($result){ 
		$rows = array();
		while($r = $result->fetch_assoc()) {
		    $rows = $r;
		}
		$dateValue = $rows['Value'];
	}
	else{
		$timestamp = strtotime($date);
		$day= date("N", $timestamp);
		if($day==6){ //saturday
			$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
			$date = date ( 'Y-m-d' , $newdate );
		}else if($day==7){ //saturday
			$newdate = strtotime ( '-2 day' , strtotime ( $date ) ) ;
			$date = date ( 'Y-m-d' , $newdate );
		}
		
		$dateValue=getServiceCurrencyExchange($date,$typeFrom);
	}
	return (round(($value /$dateValue), 2));
}

function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getServiceCurrencyExchange($date,$typeFrom){
	$url = "http://indicadoreseconomicos.bccr.fi.cr/indicadoreseconomicos/WebServices/wsIndicadoresEconomicos.asmx/ObtenerIndicadoresEconomicosXML";
	$serviceDate = date("d/m/Y", strtotime($date));
	switch ($typeFrom) {
		case 3: //Colones
			$type=317;
			break;

		case 2: //Dollar CA
			$type=328;
			break;

		default:
			$type=false;
			break;
	}
	if($type){
		$data= array(
			'tcIndicador' => $type, 
			'tcFechaInicio' => $serviceDate,
			'tcFechaFinal' => $serviceDate,
			'tcNombre' =>'n',
			'tnSubNiveles' =>'n',
		);
		$result=httpPost($url,$data);
		//echo ($result);
		$value="";
		for ($i=324; $i < 330 ; $i++) { //String of the currency value inside $result
			$value=$value.$result[$i];	
		}
		//secho ($value);
		$value=floatval($value);
		//echo ($value);
		//echo "here";
		addValue($date, $value, $typeFrom);
		return $value;
	}
	return 1;
}


/*$sql="select CreationDate from ExpenseReport";
$result = $conn->query($sql);
while($r = $result->fetch_assoc()) {
    getServiceCurrencyExchange($r["CreationDate"],3);
}*/
?>