<?php
include ("../controlers/expenseReport-controler.php");
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/



if($_GET['action']=='list'){
	//debug("hola");
	//var_dump("hola");
	echo getExpenses();
}


if($_GET['action']=='delete'){
  echo deleteExpense($_POST['idExpenseReport']);
}

if($_GET['action']=='create'){
  //if (!isset($_POST["Billable"])){$_POST["Billable"]=0}
  echo newExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['EmployeeId'], $_POST['SupervisorId'], $_POST['ExpenseStatusId']);
  // $expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status
}

if($_GET['action']=='update'){
  echo modifyExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['EmployeeId'], $_POST['SupervisorId'], $_POST['ExpenseStatusId']);
}



// echo '{
//  "Result":"OK",
//  "Records":[
//   {
//   	"expenseId":1,
//   	"expCustomId":"20170405",
//   	"userName":"Bernal Araya",
//     "suppervisorName":"Luis Angel Rodriguez",
//   	"proyect":"1503",
//   	"bill":1,
//   	"detail":"Toronto - ene 20 2017",
//     "initDate":"\/Date(1320259705710)\/",
//     "end":"\/Date(1320259705710)\/",
//     "cashAdvance":"$300",
//     "status":3
//   }
//  ]
// }';

?>