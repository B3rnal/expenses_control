
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
        $('#usersTableContainer').jtable('destroy');
        message('Dentro del I');
    }
    message('entrando al currentExpenses');
    currentExpenseTable=$('#usersTableContainer').jtable({

            title: '    ',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listUsers.php?action=list',
                deleteAction: '/tables/listUsers.php?action=delete',
                updateAction: '/tables/listUsers.php?action=update',
                createAction: '/tables/listUsers.php?action=create'
            },
            fields: {
                idUser: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                EmployeeNumber: {
                    title: 'Id',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                Name: {
                    title: 'Name',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },
                Department: {
                    title: 'Department',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },
                Email:{
                    title: 'EMail',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                UserTypeId:{
                    title: 'Permission',
                    options: { '1': 'Basic','2': 'Administrator'}
                    // width: '13%'
                }

            }
        });
    $('#usersTableContainer').jtable('load');
}