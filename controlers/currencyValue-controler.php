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
	$result=selectValueByDate($date, $id);
	return $result;
}


function getCurrencyExchange($typeFrom, $value,$date){
	$dateValue=getSpecificValue($date,$typeFrom);
	if(!$dateValue){
		$serviceData=getServiceCurrencyExchange($date,$typeFrom);
		var_dump($serviceData);
	}

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
	$date = date("d/m/Y", strtotime($date));
	switch ($typeFrom) {
		case 3:
			$type=317;
			break;

		case 2:
			$type=328;
			break;

		default:
			$type=false;
			break;
	}
	$data= array(
		'tcIndicador' => $type, 
		'tcFechaInicio' => $date,
		'tcFechaFinal' => $date,
		'tcNombre' =>'n',
		'tnSubNiveles' =>'n',
	);
	$result=httpPost($url,$data);
	var_dump($result);
	$xml = simplexml_load_string($result);
	var_dump("<br><br>");
	$string = $xml[0];
	print_r($string[10]);

}

var_dump(getCurrencyExchange(3,10,"2018-01-05"));

?>