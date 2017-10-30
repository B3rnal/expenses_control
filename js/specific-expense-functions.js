
$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	
    //loadExpensesTable();	    

    $('.filter-section').submit(function(e){
        e.preventDefault();
        var params=$(this).serialize();
        var url="specific-expense.php?action=list&"+params;
        window.location=url;
    });
});
var currentId;
var expenseLines;
var expenseInfo;
var currentExpenseTable;
function message(string){
    console.log(string);
}

function loadExpensesTable(){
   //console.log("iniciando expense");
    initExpenseTable();
}

function getCurrentId(id){
    if(id){
        currentId=id;
        //console.log("this is the current id: " + id);
         getExpenseInfo(currentId);//metodo para jalar la info del controlador de lineas de expenses
         //loadExpensesTable();
    }
    else{
    }

}

function getExpenseInfo(id){
    $.post( "/tables/listExpenses.php", { action: "expenseInfo", expId: id} ,function( data ) {
        expenseInfo=JSON.parse(data);
        if( !expenseInfo.error) {
             //console.log(expenseInfo.Name);
             initExpenseTable(expenseInfo.idExpenseReport,expenseInfo.Name,id);

        }else{
            //console.log(data.error);
        }
    });

}

function initExpenseTable(id,name,Customid){
//function initExpenseTable(){

    if(currentExpenseTable){
        $('#expensesTableContainer').jtable('destroy');
    }
    currentExpenseTable=$('#expensesTableContainer').jtable({
            title: 'Expense Report : '+name,
            //title: 'Expense Report : NAME NAME NAME',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/expenseLinesTable.php?action=list&id='+Customid,
                deleteAction: '/tables/deleteExpenses.php',
                updateAction: '/tables/updateExpenses.php',//Añadir log de fecha y user
                createAction: '/tables/expenseLinesTable.php?action=create&id='+id,
            },
            fields: {
                IdExpenseLine: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                Date: {
                    title: 'Date',
                    width: '7%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd'
                },

                Place: {
                    title: 'Place/Location',
                    type: 'textarea',
                    list: true,
                    width: '13%'
                },

                ExpenseTypeid:{
                    width: '15%',
                    title: 'Type',
                    options: { '1': 'Transportation', '2': 'Lodging, Hotel', '3': 'Auto Rental & Gas', '4': 'Parking', '5': 'Business Meals', '6': 'Personal Meals', '7': 'Internet', '8': 'Mobile', '9': 'Telephone & Fax', '10': 'Enterneiment', '11': 'Supplies', '12': 'Other'  }
                },

                Detail: {
                    title: 'Description',
                    type: 'textarea',
                    list: true,
                    width: '30%',
                },

                Amount:{
                    title: 'Amount',
                    width: '10%'
                },

                Currency:{
                    title: 'Currency',
                    options: { '1': 'US Dollar', '2': 'CA Dollar', '3': 'Colones' },
                    defaultValue: 1
                },

                Billable:{
                    title: 'Billable',
                    options: { '0': 'No', '1': 'Yes'},
                    defaultValue: 1
                },
                /*FilePath:{
                    list: false
                },*/
            }
        });
    $('#expensesTableContainer').jtable('load');
}





//Adding information to the filter drop down
//-----------------------------------
//Expenses Ids
function getAllExpIds(){
   // console.log("Entrando a la funcion de llamada de IDs")
    $.post( "/tables/listExpenses.php", { action: "listIds"} ,function( data ) {
        data=JSON.parse(data);
        //console.log(data);
        if( ! data.error) {
             data.result.forEach(listExpHTMLIds);
        }else{
            //console.log(data.error);
        }
    });
}

function listExpHTMLIds(item){
    HTMLSelect = document.getElementById("expId");
    HTMLSelect.innerHTML = HTMLSelect.innerHTML + "<option value=\""+ item + "\">"+item+"</option>";
}
getAllExpIds();

