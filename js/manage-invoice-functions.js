
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
        $('#invoiceTableContainer').jtable('destroy');
        message('Dentro del I');
    }
    message('entrando al currentExpenses');
    currentExpenseTable=$('#invoiceTableContainer').jtable({

            title: '    ',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listInvoice.php',
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

                invCustomId: {
                    title: 'Invoice Id',
                    // width: '7%',
                    type: 'textarea',
                    
                },

                expId: {
                    title: 'Epense Id',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                client: {
                    title: 'Client',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },
                proyect:{
                    title: 'Proyect',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                detail:{
                    title: 'Detail',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

            }
        });
    $('#invoiceTableContainer').jtable('load');
}