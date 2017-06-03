<?php
include ("../controlers/expenseReport-controler.php");


if($_GET['action']=='list'){
  echo getExpenses();
}


if($_GET['action']=='delete'){
  echo deleteExpense($_POST['idExpenseReport']);
}

if($_GET['action']=='create'){
  //if (!isset($_POST["Billable"])){$_POST["Billable"]=0}
  echo newExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['User'], $_POST['Supervisor'], $_POST['ExpenseStatusId']);
  // $expenseCustomId, $name, $billable, $department, $proyect, $creationDate, $startDate, $endDate, $detail, $cashAdvance, $refund, $employeeId, $supervisorId, $status
}

if($_GET['action']=='update'){
  echo modifyExpense($_POST['idUser'],$_POST['EmployeeNumber'], $_POST['Name'], $_POST['Email'], $_POST['Department'], $_POST['UserTypeId']);
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