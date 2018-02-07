
$(document).ready(function(){
    loadHomeDatePickers();
    $('.filter-section').submit(function(e){
        e.preventDefault();
        var params=$(this).serialize();
        var url="myExpenses.php?action=list&"+params;
        window.location=url;
    });
    getAllExpIds();
});

//Global var
var LogedUser;//SOLO PARA PRUEBAS
var currentId,
    expenseLines,
    g_expenseInfo,
    currentExpenseTable,
    billableLines, 
    billableTotal, 
    nonBillableLines,
    nonBillableTotal, 
    refund,
    cashAdvance,
    expenseBillable



//Functions

function initCurrentExpenseInfo(id){

    if(id){
        currentId=id;
        $.post( "/tables/listExpenses.php", { action: "expenseInfo", expId: currentId} ,function( data ) {
                g_expenseInfo=JSON.parse(data);
                //Table Init
                initExpenseTable(g_expenseInfo.idExpenseReport,g_expenseInfo.Name,currentId);
                //Calcule Lines
                /*calculateExpense(g_expenseInfo.idExpenseReport,g_expenseInfo.Billable,g_expenseInfo.CashAdvance);*/
                cashAdvance=g_expenseInfo.CashAdvance;
                expenseBillable=g_expenseInfo.Billable;
            });
    }
}

function initExpenseTable(id,name,Customid){
    $("#tableMenu").show(); 
    $("#expenseStatus").show(); 
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
                deleteAction: '/tables/expenseLinesTable.php?action=delete',
                updateAction: '/tables/expenseLinesTable.php?action=update&user=318',//Añadir log de fecha y user
                createAction: '/tables/expenseLinesTable.php?action=create&id='+id,
            },
            fields: {
                idExpenseLine: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },

                Date: {
                    title: 'Date',
                    width: '10%',   
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
                    width: '10%',
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

                CurrencyChange:{
                    title: 'Exchange',
                    width: '10%',
                    edit: false,
                    create: false,
                },

                AmountUS:{
                    title: 'Amount (USD)',
                    width: '12%',
                    edit: false,
                    create: false,
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
    $('#expensesTableContainer').jtable('load', undefined, function(){
        var $rows = $('#expensesTableContainer').find('.jtable-data-row');
        var billable=Array();
        var nonBillable=Array();

        $.each($rows,function(){
            var record = $(this).data('record');
            if(record.Billable==0){
                if(nonBillable[record.ExpenseTypeid]){
                    nonBillable[record.ExpenseTypeid]=nonBillable[record.ExpenseTypeid]+record.AmountUS;
                }else{
                    nonBillable[record.ExpenseTypeid]=record.AmountUS;
                }
            }else{
                if(billable[record.ExpenseTypeid]){
                    billable[record.ExpenseTypeid]=billable[record.ExpenseTypeid]+record.AmountUS;
                }else{
                    billable[record.ExpenseTypeid]=record.AmountUS;
                }
            }
            
        });
        calculateExpense(currentId,expenseBillable,cashAdvance,billable,nonBillable);

    });
}


//Adding information to the filter drop down
//-----------------------------------
//Expenses Ids
function getAllExpIds(){
    $.post( "/tables/listExpenses.php", { action: "listIdsByUser", userId: LogedUser} ,function( data ) {
        data=JSON.parse(data);
        console.log(data);
        if( ! data.error) {
            //console.log("inside if")
             data.result.forEach(listExpHTMLIds);
        }else{
            console.log(data.error);
        }
    });
}

function listExpHTMLIds(item){
    //console.log(item.Name);
    HTMLSelect = document.getElementById("expIdList");
    HTMLSelect.innerHTML = HTMLSelect.innerHTML + "<option value=\""+ item.ExpenseCustomId + "\">"+item.ExpenseCustomId+" - "+item.Name+"</option>";
    $('#expIdList').trigger("chosen:updated");

}
//-----------------------------------

//Calculate Expense Lines
//-----------------------------------
function setBillableLines(data){
    billableLines=data;
}

function setNonBillableLines(data){
    nonBillableLines=data;
}

function lineTypeToString(typeId){
    var currentType="";
    switch(typeId) { 
        case 1: currentType='Transportation'; break; 
        case 2: currentType='Lodging, Hotel'; break; 
        case 3: currentType='Auto Rental & Gas'; break; 
        case 4: currentType='Parking'; break; 
        case 5: currentType='Business Meals'; break; 
        case 6: currentType='Personal Meals'; break; 
        case 7: currentType='Internet'; break; 
        case 8: currentType='Mobile'; break; 
        case 9: currentType='Telephone & Fax'; break;  
        case 10: currentType='Enterneiment'; break; 
        case 11: currentType='Supplies'; break; 
        case 12: currentType='Other'; break; 
    }
    return currentType;
}

function calculateExpense(expId,billable,cashAdvance,billableLines,nonBillableLines){
    var billableHTML, nonBillableHTML;
    nonBillableTotal=0;
    billableTotal= 0;
    //cashAdvance=0;
    /*$.ajax({
        type: "post",
        url: "/tables/expenseLinesTable.php",
        data: { action: "calculateBillable", id:expId },
        success:  function( data ) {
            data=JSON.parse(data);
            setBillableLines(data);
        },
        async:   false

    });
    $.ajax({
        type: "post",
        url: "/tables/expenseLinesTable.php",
        data: { action: "calculateNonBillable", id:expId },
        success:  function( data ) {
            data=JSON.parse(data);
            setNonBillableLines(data);
        },
        async:   false

    });*/
   
    if (billableLines) {
        billableHTML = "<tr class=\"billable-header\"><th>Billable Lines</th><th>Total</th></tr>";
        billableHTML += "<tr class=\"cash-advance\"><td>Cash Advance Total</td><td>$" + cashAdvance + "</td></tr>";
        billableLines.forEach(function (value, i) {
            billableHTML += "<tr class=\"billable-lines\"><td>" + lineTypeToString(i)  + "</td><td>$" + value + "</td></tr>";
            billableTotal += Number(value);
        });

        billableHTML += "<tr class=\"billable-total\"><td>Billable Total</td><td>$" + billableTotal + "</td></tr>";
        refund = Number(cashAdvance) - (billableTotal);
        if (refund >= 0) {
             billableHTML += "<tr class=\"cash-remaining\"><td>Cash Advance Remaining</td><td>$" + refund + "</td></tr>";

        }
        else{
             billableHTML += "<tr class=\"refund-total\"><td>Refund Total</td><td>$" + refund * -1 + "</td></tr>";
        }
        //console.log(billableHTML);
        billableToHTML(billableHTML);
    }

    if (nonBillableLines) {
        nonBillableHTML = "<tr class=\"non-billable-header\"><th>Non Billable Lines</th><th>Total</th></tr>";
        nonBillableLines.forEach(function (value, i) {
            nonBillableHTML += "<tr class=\"billable-lines\"><td>" + lineTypeToString(i)  + "</td><td>$" + value + "</td></tr>";
            nonBillableTotal += Number(value);
        });
        nonBillableHTML += "<tr class=\"non-billable-total\"><td>Non Billable Total</td><td>$" + nonBillableTotal + "</td></tr>";
        nonBillableToHTML(nonBillableHTML);
    }


}

function billableToHTML(string){
    HTMLSelect = document.getElementById("billableChart");
    HTMLSelect.innerHTML = string;

}

function nonBillableToHTML(string){
    HTMLSelect = document.getElementById("nonBillableChart");
    HTMLSelect.innerHTML = string;

}

function getUserId(id){
    LogedUser=id;
}