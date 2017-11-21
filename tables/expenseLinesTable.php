<?php
include ("../controlers/expenseLines-controler.php");
$action = $_GET['action']?$_GET['action']:$_POST['action'];
$id = $_GET['id']?$_GET['id']:$_POST['id'];
$user = $_GET['user']?$_GET['user']:$_POST['user'];

switch ($action) {
  case 'list':
    echo getAllExpenseLines($id);
    break;
  case 'create':
    echo newExpenseLine($id, $_POST['ExpenseTypeid'], $_POST['Date'], $_POST['Detail'], $_POST['Place'], $_POST['Amount'], $_POST['Currency'], $_POST['Billable']);
    break;

  case 'delete':
    echo deleteLine($_POST['IdExpenseLine']);
    break;

  case 'update':
    echo modifyExpenseLine($id, $_POST['ExpenseTypeid'], $_POST['Date'], $_POST['Detail'], $_POST['Place'], $_POST['Amount'], $_POST['Currency'], $_POST['Billable'],$user);
    break;
  
  default:
    # code...
    break;
}


/*else if ($action =='delete'){
  echo deleteExpense($_POST['idExpenseReport']);
}

else if ($action =='create'){
  //if (!isset($_POST["Billable"])){$_POST["Billable"]=0}
  echo newExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['EmployeeId'], $_POST['SupervisorId'], $_POST['ExpenseStatusId']);
}


else if ($action =='listIds'){
  
  $aResult = array();
  $list = getExpenseIds();
  if(empty($list)) {
       $aResult['error'] = 'Empty Data';
    }
    else {
       $aResult['result'] = $list;
    }
    echo json_encode($aResult);
} 

else if ($action =='listDep'){
  
  $aResult = array();
  $list = getDepartments();
  if(empty($list)) {
       $aResult['error'] = 'Empty Data';
    }
    else {
       $aResult['result'] = $list;
    }
    echo json_encode($aResult);
}
*/
?>