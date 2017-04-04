
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
        $('#proyectTableContainer').jtable('destroy');
        message('Dentro del I');
    }
    message('entrando al currentExpenses');
    currentExpenseTable=$('#proyectTableContainer').jtable({

            title: '    ',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                // listAction: '/tables/listProyects.php',
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

                Id: {
                    title: 'Id',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                name: {
                    title: 'Name',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },
                department: {
                    title: 'Department',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },
                email:{
                    title: 'eMail',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                type:{
                    title: 'type',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                }

            }
        });
    $('#proyectTableContainer').jtable('load');
}