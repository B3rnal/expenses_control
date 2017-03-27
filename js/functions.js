
$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	
    loadTable();	    
});
var currentTable;

function loadHomeDatePickers(){
	
    $("#dp1").fdatepicker({
        initialDate: '02-12-1989',
        format: 'mm-dd-yyyy',
        disableDblClickSelection: true,
        leftArrow:'<<',
        rightArrow:'>>',
        closeIcon:'X',
        closeButton: true
    });

}

function loadTable(){
    $("#loadExpenseData").click(function(){
        var currentReport=$("#currentExpenseReport").val();
        var reportName=$("#currentExpenseReport :selected").text();
        initTable(reportName,currentReport);
    });
}

function initTable(name,id){
    if(currentTable){
        $('#expensesTableContainer').jtable('destroy');
    }
    currentTable=$('#expensesTableContainer').jtable({
            title: 'Expense Report : '+name,
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/listExpenses.php',
                deleteAction: '/deleteExpenses.php',
                updateAction: '/updateExpenses.php',
                createAction: '/createExpenses.php'
            },
            fields: {
                expenseId: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                date: {
                    title: 'Date',
                    width: '15%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd'
                },

                type:{
                    title: 'Type',
                    options: { '1': 'Personal Meal', '2': 'Internet', '3': 'Lodging, Hotel', '4': 'Auto Rental & Gas', '5': 'Transportation', '6': 'Parking'  }
                },

                description: {
                    title: 'Expense description',
                    type: 'textarea',
                    list: false
                },

                amount:{
                    title: 'Amount',
                    width: '15%'
                },

                currency:{
                    title: 'Currency',
                    options: { '1': 'CA Dollar', '2': 'Colones', '3': 'US Dollars' }
                },

                recordDate: {
                    title: 'Record date',
                    width: '30%',
                    type: 'date',
                    create: false,
                    edit: false
                }
            }
        });
    $('#expensesTableContainer').jtable('load');
}