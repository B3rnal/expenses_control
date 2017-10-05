<?php
include ("../controlers/expenseReport-controler.php");
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

$action = $_GET['action']?$_GET['action']:$_POST['action'];
//var_dump(getExpenses(""));
//echo getExpenses($_POST["ExpenseCustomId"]);

if ($action =='list'){
	//var_dump(getExpenses($_POST["ExpenseCustomId"]));
	echo getAllExpenseLines($_POST["ExpenseCustomId"]);
}

else if ($action =='delete'){
  echo deleteExpense($_POST['idExpenseReport']);
}

else if ($action =='create'){
  //if (!isset($_POST["Billable"])){$_POST["Billable"]=0}
  echo newExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['EmployeeId'], $_POST['SupervisorId'], $_POST['ExpenseStatusId']);
}

else if ($action =='update'){
  echo modifyExpense($_POST['ExpenseCustomId'], $_POST['Name'], $_POST['Billable'], $_POST['Department'], $_POST['Proyect'], $_POST['CreationDate'], $_POST['StartDate'], $_POST['EndDate'], $_POST['ReportDetail'], $_POST['CashAdvance'], $_POST['Refund'], $_POST['EmployeeId'], $_POST['SupervisorId'], $_POST['ExpenseStatusId']);
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



?>