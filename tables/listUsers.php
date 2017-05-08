<?php
include ("../controlers/user-controler.php");


if($_GET['action']=='list'){
	echo getUsers();
}

// echo '{
//  "Result":"OK",
//  "Records":[
//   {
//   	"Id":318,
//     "name":"Bernal Araya",
//     "department":"Nissan CA",
//     "type":"Administrator",
//     "email":"bernala@thehangar.cr"
//   }
//  ]
// }';

?>