$(document).ready(function(){
    $(document).foundation();
    loadHomeDatePickers();  
    loadExpensesTable();
    
            
});
var currentExpenseTable;
var currentExpenseNumber;
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
    message('entrando al currentExpenses');     currentExpenseTable=$('#expensesTableContainer').jtable({

            title: '    ',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            selecting: true, //Enable selecting
            //multiselect: true, //Allow multiple selecting
            //selectingCheckboxes: true, //Show checkboxes on first column
            //9selectOnRowClick: true,
            actions: {
                listAction: '/tables/listExpenses.php?action=list',
                deleteAction: '/tables/listExpenses.php?action=delete',
                updateAction: '/tables/listExpenses.php?action=update',
                createAction: '/tables/listExpenses.php?action=create'
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

                EmployeeId: {
                    title: 'User',
                    //type: 'textarea',
                    options: '/tables/listUsers.php?action=listUsers',
                    list: true,
                    inputClass:"chosen-select",
                    // width: '13%'
                },

                SupervisorId: {
                    title: 'Supervisor',
                    options: '/tables/listUsers.php?action=listUsers',
                    list: true,
                    inputClass:"chosen-select",
                    // width: '13%'
                },


                Proyect:{
                    title: 'Proyect',
                    type: 'textarea',
                    list: false,
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
                    list: false,
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
                    list: false,
                    // width: '13%'
                },

               CashAdvance:{
                    title: 'Cash Advance (USD)',
                    list: true,
                    defaultValue: 0
                    // width: '10%'
                },

                Refund:{
                    title: 'Refund',
                    list: false,
                    defaultValue: 0
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
                /*TestColumn: {
                    title: 'Test',
                    dependsOn: 'ExpenseCustomId',
                    display: function (data) {
                        //return '<button onclick="myFunction()">Click me</button>'; //here you can call JavaScript function using  onclick
                        //return '<input class="' + $ExpenseCustomId + '" type="button">';


                    },
                    width: '3%',
                }*/
            },
            //Initialize validation logic when a form is created
            formCreated: function (event, data) {
                data.form.find('input[name="ExpenseCustomId"]').addClass('validate[required]');
                /*data.form.find('input[name="EmailAddress"]').addClass('validate[required,custom[email]]');
                data.form.find('input[name="Password"]').addClass('validate[required]');
                data.form.find('input[name="BirthDate"]').addClass('validate[required,custom[date]]');
                data.form.find('input[name="Education"]').addClass('validate[required]');*/
                data.form.validationEngine();
                data.form.find('.chosen-select').chosen({}); 
            },
            //Validate form when it is being submitted
            formSubmitting: function (event, data) {
                return data.form.validationEngine('validate');
            },
            //Dispose validation logic when form is closed
            formClosed: function (event, data) {
                data.form.validationEngine('hide');
                data.form.validationEngine('detach');
            },
            //Check Id of the selected row
            selectionChanged: function () {
                //message("columna seleccionada");
                $( ".ExpenseSelected" ).prop( "disabled", false );
                //Get all selected rows
                var $selectedRows = $('#expensesTableContainer').jtable('selectedRows');
                $('#SelectedRowList').empty();
                if ($selectedRows.length > 0) {
                    //Show selected rows
                    $selectedRows.each(function () {
                        var record = $(this).data('record');
                       currentExpenseNumber=record.ExpenseCustomId;
                       console.log(currentExpenseNumber);
                    });
                } else {
                    //No rows selected
                    console.log('No row selected! Select rows to see here...');
                }
            }

        });
    //Load the table for the first time
    $('#expensesTableContainer').jtable('load');
    //Load the table according tho the search filters
    $('#search').click(function (e) {
            e.preventDefault();
            $('#expensesTableContainer').jtable('load', {
                ExpenseCustomId:$("#expId").val(),
                EmployeeId:$("#usrId").val(),
                Department:$("#deptId").val(),
                ExpenseStatusId:$("#expStatus").val(),
                BillableExpense:$("#billiable").val()
            });
        });
    $('#CheckExpense').click(function (e) {
            e.preventDefault();
            var url="specific-expense.php?id="+currentExpenseNumber;
            message(url);
            window.location=url;
        });
}



//Adding information to the filter drop down
//-----------------------------------
//Expenses Ids
function getAllExpIds(){
    $.post( "/tables/listExpenses.php", { action: "listIds" } ,function( data ) {
        data=JSON.parse(data);
        console.log(data.result[0]);
        if( ! data.error) {
             data.result.forEach(listExpHTMLIds);
        }else{
            console.log(data.error);
        }
    });
}

function listExpHTMLIds(item){
    HTMLSelect = document.getElementById("expId");
    HTMLSelect.innerHTML = HTMLSelect.innerHTML + "<option value=\""+ item + "\">"+item+"</option>";
}

//Users Ids
function getAllUsersIds(){
    $.post( "/tables/listUsers.php", { action: "listUsersJS" } ,function( data ) {
        data=JSON.parse(data);
        console.log(data.result[0].Value);
        if( ! data.error) {
             data.result.forEach(listUsrHTMLIds);
        }else{
            console.log(data.error);
        }
    });
}
function listUsrHTMLIds(item){
    HTMLSelect = document.getElementById("usrId");
    HTMLSelect.innerHTML = HTMLSelect.innerHTML + "<option value=\""+ item.Value + "\">"+ item.DisplayText +"</option>";
}

//Departments 
function getAllDepartments(){
    $.post( "/tables/listExpenses.php", { action: "listDep" } ,function( data ) {
        data=JSON.parse(data);
        console.log(data.result[0].Value);
        if( ! data.error) {
             data.result.forEach(listDepHTMLIds);

        }else{
            console.log(data.error);
        }
    });
}
function listDepHTMLIds(item){
    HTMLSelect = document.getElementById("deptId");
    HTMLSelect.innerHTML = HTMLSelect.innerHTML + "<option value=\""+ item + "\">"+ item +"</option>";
}
getAllExpIds();
getAllUsersIds();
getAllDepartments();
//-------------------------------------
