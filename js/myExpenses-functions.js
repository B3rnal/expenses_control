
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

            if(record.Billable==0){//If the line is billable
                if(!nonBillable[record.ExpenseTypeid]){
                    nonBillable[record.ExpenseTypeid]=Array();
                }
                if(record.ExpenseTypeid==5||record.ExpenseTypeid==6){
                    if(!nonBillable[record.ExpenseTypeid][record.Date]){
                        nonBillable[record.ExpenseTypeid][record.Date]=0;
                    }
                    nonBillable[record.ExpenseTypeid][record.Date]=nonBillable[record.ExpenseTypeid][record.Date]+record.AmountUS;
                }else{
                    nonBillable[record.ExpenseTypeid]["no-date"]=nonBillable[record.ExpenseTypeid]+record.AmountUS;
                }
            }else{
                if(!billable[record.ExpenseTypeid]){
                    billable[record.ExpenseTypeid]=Array();
                }
                if(record.ExpenseTypeid==5||record.ExpenseTypeid==6){
                    if(!billable[record.ExpenseTypeid][record.Date]){
                        billable[record.ExpenseTypeid][record.Date]=0;
                    }
                    billable[record.ExpenseTypeid][record.Date]=billable[record.ExpenseTypeid][record.Date]+record.AmountUS;
                }else{
                    billable[record.ExpenseTypeid]["no-date"]=billable[record.ExpenseTypeid]+record.AmountUS;
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
        //console.log(data);
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
    amount=0;
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
        billableHTML = "<tr class=\"billable-header\"><th class=\"info\">Billable Lines</th><th>Total</th></tr>";
        billableHTML += "<tr class=\"cash-advance\"><td>Cash Advance Total</td><td>$" + Number(cashAdvance).toFixed(2) + "</td></tr>";
        billableLines.forEach(function (value, i) {
            if (i != 5 && i != 6) {//If it is not a Personal os Busines meal
                amount=Number(value["no-date"]); //add an empty date to the billable line
                billableHTML += "<tr class=\"billable-lines\"><td>" + lineTypeToString(i)  + "</td><td>$" + amount.toFixed(2) + "</td></tr>";
                billableTotal += Number(amount);//Amount total
            }else{//If it´s an Personal or Busines meal
                for (var j = 0; j < Object.keys(billableLines[i]).length; j++) {//Looking into each day of personal meals 
                    var date=Object.keys(billableLines[i])[j];
                    amount=Number(billableLines[i][date]);
                    billableHTML += "<tr class=\"billable-lines\"><td>" + lineTypeToString(i)  + " " + date + "</td><td>$" + amount.toFixed(2) + "</td></tr>";
                    billableTotal += Number(amount.toFixed(2)); //Adding to the amount total
                }
            }
        });

        billableHTML += "<tr class=\"billable-total\"><td>Billable Total</td><td>$" + billableTotal.toFixed(2) + "</td></tr>";        
        billableToHTML(billableHTML);
    }

    if (nonBillableLines) {
        nonBillableHTML = "<tr class=\"non-billable-header\"><th class=\"info\">Non Billable Lines</th><th>Total</th></tr>";
        nonBillableLines.forEach(function (value, i) {
            if (i != 5 && i != 6) {//If it is not a Personal os Busines meal
                console.log(value,i);
                amount=Number(value["no-date"]); //add an empty date to the non billable line
                nonBillableHTML += "<tr class=\"non-billable-lines\"><td>" + lineTypeToString(i)  + "</td><td>$" + amount.toFixed(2) + "</td></tr>";
                nonBillableTotal += Number(amount);//Amount total
            }else{//If it´s an Personal or Busines meal
                for (var j = 0; j < Object.keys(nonBillableLines[i]).length; j++) {//Looking into each day of personal meals 
                    var date=Object.keys(nonBillableLines[i])[j];
                    amount=Number(nonBillableLines[i][date]);
                    nonBillableHTML += "<tr class=\"non-billable-lines\"><td>" + lineTypeToString(i)  + " " + date + "</td><td>$" + amount.toFixed(2) + "</td></tr>";
                    nonBillableTotal += Number(amount.toFixed(2)); //Adding to the amount total
                }
            }
        });
        nonBillableHTML += "<tr class=\"non-billable-total\"><td>Non Billable Total</td><td>$" + Number(nonBillableTotal).toFixed(2) + "</td></tr>";
        nonBillableToHTML(nonBillableHTML);
    }
    refund = Number(cashAdvance) - (billableTotal+nonBillableTotal);
    if (refund >= 0) {
         globalBillableHTML = "<tr class=\"cash-remaining\"><td class=\"info\">Cash Advance Remaining</td><td>$" + refund + "</td></tr>";

    }
    else{
         globalBillableHTML  = "<tr class=\"refund-total\"><td class=\"info\">Refund Total</td><td>$" + refund * -1 + "</td></tr>";
    }
   //console.log(globalBillableHTML);
    globalBillableToHTML(globalBillableHTML);


}

function billableToHTML(string){
    HTMLSelect = document.getElementById("billableChart");
    HTMLSelect.innerHTML = string;

}

function nonBillableToHTML(string){
    HTMLSelect = document.getElementById("nonBillableChart");
    HTMLSelect.innerHTML = string;

}

function globalBillableToHTML(string){
    HTMLSelect = document.getElementById("globalBillableChart");
    HTMLSelect.innerHTML = string;
}

function getUserId(id){
    LogedUser=id;
}