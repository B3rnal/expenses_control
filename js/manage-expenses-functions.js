
$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	
    loadExpensesTable();	    
});
var currentExpenseTable;
function message(string){
    console.log(string);
}

// Index.php
// load Expenses Table
function loadExpensesTable(){
        var currentReport=$("#currentExpenseReport").val();
        message('Entrando a loadExpenses');
        initExpenseTable();
}

function initExpenseTable(){
    message('If del init');
    if(currentExpenseTable){
        $('#expensesTableContainer').jtable('destroy');
        message('Dentro del I');
    }
    message('entrando al currentExpenses');
    currentExpenseTable=$('#expensesTableContainer').jtable({

            title: '    ',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listManageExp.php',
                deleteAction: '/tables/deleteExpenses.php',
                updateAction: '/tables/updateExpenses.php',
                createAction: '/tables/createExpenses.php'
            },
            fields: {
                expenseId: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                expCustomId: {
                    title: 'Expense Id',
                    // width: '7%',
                    type: 'textarea',
                    
                },

                userName: {
                    title: 'User Name',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                suppervisorName: {
                    title: 'Suppervisor',
                    type: 'textarea',
                    list: false,
                    // width: '13%'
                },


                proyect:{
                    title: 'Proyect',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                bill:{
                    title: 'Billable',
                    options: { '0': 'No', '1': 'Yes'}
                },

                detail:{
                    title: 'Detail',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                initDate: {
                    title: 'Start Date',
                    // width: '7%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd'
                },
                endDate: {
                    title: ' End Date',
                    // width: '7%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd',
                    list: false,
                },

               cashAdvance:{
                    title: 'Cash Advance',
                    // width: '10%'
                },

                status:{
                    title: 'Status',
                    options: { '1': 'Open', '2': 'Waiting Approval', '3': 'Approved' , '4': 'Closed'},
                    list: true,
                }
            }
        });
    $('#expensesTableContainer').jtable('load');
}