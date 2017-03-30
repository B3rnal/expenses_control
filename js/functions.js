
$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	
    loadExpensesTable();
    message("cargando");
    loadUserTable();	    
});
var currentExpenseTable;
var currentUserTable;

function message(string){
    console.log(string);
}

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

// Index.php
// load Expenses Table
function loadExpensesTable(){
    $("#loadExpenseData").click(function(){
        var currentReport=$("#currentExpenseReport").val();
        var reportName=$("#currentExpenseReport :selected").text();
        initExpenseTable(reportName,currentReport);
    });
}

function initExpenseTable(name,id){
    if(currentExpenseTable){
        $('#expensesTableContainer').jtable('destroy');
    }
    currentExpenseTable=$('#expensesTableContainer').jtable({
            title: 'Expense Report : '+name,
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listExpenses.php',
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

                date: {
                    title: 'Date',
                    width: '7%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd'
                },

                place: {
                    title: 'Place/Location',
                    type: 'textarea',
                    list: true,
                    width: '13%'
                },

                type:{
                    width: '15%',
                    title: 'Type',
                    options: { '1': 'Transportation', '2': 'Lodging, Hotel', '3': 'Auto Rental & Gas', '4': 'Parking', '5': 'Business Meals', '6': 'Personal Meals', '7': 'Internet', '8': 'Mobile', '9': 'Telephone & Fax', '10': 'Enterneiment', '11': 'Supplies', '12': 'Other'  }
                },

                description: {
                    title: 'Description',
                    type: 'textarea',
                    list: true,
                    width: '30%',
                },

                amount:{
                    title: 'Amount',
                    width: '10%'
                },

                currency:{
                    title: 'Currency',
                    options: { '1': 'US Dollar', '2': 'CA Dollar', '3': 'Colones' }
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

// Users.php
// load users Table
function loadUserTable(){
    message("dentro de load User");
    initUserTable();
}

function initUserTable(){
    if(currentUserTable){
        $('#usersTableContainer').jtable('destroy');
    }
    currentUserTable=$('#usersTableContainer').jtable({
            title: 'Users',
            paging: true, //Enable paging
            pageSize: 20, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listUsers.php',
                deleteAction: '/tables/deleteUsers.php',
                updateAction: '/tables/updateUsers.php',
                createAction: '/tables/createUsers.php'
            },
            fields: {
                userId: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false

                },

                name: {
                    title: 'Name',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                department: {
                    title: 'Department',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                type: {
                    title: 'User Type',
                    options: { '1': 'Admin', '2': 'Basic'},
                    width: '20%',
                },

                email: {
                    title: 'Email',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                phone: {
                    title: 'Phone',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                }
            }
        });
    $('#usersTableContainer').jtable('load');
}