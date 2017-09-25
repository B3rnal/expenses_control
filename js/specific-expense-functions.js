
$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	
    loadExpensesTable();	    
});
var currentId;
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
function getCurrentId(id){
    currentId=id;
    console.log("this is the current id" + id);
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
                listAction: '/tables/listExpenseLines.php',
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

//Adding information to the filter drop down
//-----------------------------------
//Expenses Ids
function getAllExpIds(){
    $.post( "/tables/listExpenses.php", { action: "listIds" } ,function( data ) {
        data=JSON.parse(data);
        //console.log(data.result[0]);
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
getAllExpIds();

