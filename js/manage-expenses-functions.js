

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
                listAction: '/tables/listManageExp.php?action=list',
                deleteAction: '/tables/listManageExp.php?action=delete',
                updateAction: '/tables/listManageExp.php?action=update',
                createAction: '/tables/listManageExp.php?action=create'
            },
            fields: {
                idExpenseReport: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                ExpenseCustomId: {
                    title: 'Id',
                    // width: '7%',
                    type: 'text',
                    edit: false,

                    
                },

                Name: {
                    title: 'Expense Name',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                Billable:{
                    title: 'Billable',
                    type: 'radiobutton',
                    options: { '0': 'No', '1': 'Yes' },
                    defaultValue: '0',
                },

                Department: {
                    title: 'Department',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                User: {
                    title: 'User',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                Supervisor: {
                    title: 'Supervisor',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },


                Proyect:{
                    title: 'Proyect',
                    type: 'textarea',
                    list: true,
                    // width: '13%'
                },

                ReportDetail:{
                    title: 'Detail',
                    type: 'textarea',
                    list: false,
                    // width: '13%'
                },

                CreationDate:{
                    title: 'Creation Date',
                    type: 'date',
                    displayFormat: 'yy-mm-dd',
                    list: true,
                    // width: '13%'
                },

                StartDate:{
                    title: 'StartDate',
                    type: 'date',
                    displayFormat: 'yy-mm-dd',
                    list: false,
                    // width: '13%'
                },

                EndDate:{
                    title: 'End Date',
                    type: 'date',
                    displayFormat: 'yy-mm-dd',
                    list: true,
                    // width: '13%'
                },

               CashAdvance:{
                    title: 'Cash Advance (USD)',
                    list: true
                    // width: '10%'
                },

                Refund:{
                    title: 'Refund',
                    list: false
                    // width: '10%'
                },

                ExpenseStatusId:{
                    title: 'Status',
                    options: { '1': 'Open', '2': 'Waiting Approval', '3': 'Approved' , '4': 'Processed', '5': 'Closed'},
                    list: true,
                },

                Value:{
                    title: 'USD Value',
                    list: false,
                    edit:false,
                    create:false,
                },
            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.find('input[name="ExpenseCustomId"]').addClass('validate[required]');
                /*data.form.find('input[name="EmailAddress"]').addClass('validate[required,custom[email]]');
                data.form.find('input[name="Password"]').addClass('validate[required]');
                data.form.find('input[name="BirthDate"]').addClass('validate[required,custom[date]]');
                data.form.find('input[name="Education"]').addClass('validate[required]');*/
                data.form.validationEngine();
            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            }
        });
    $('#expensesTableContainer').jtable('load');
}