$(document).ready(function(){
    $(document).foundation();
	loadHomeDatePickers();	    
});

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