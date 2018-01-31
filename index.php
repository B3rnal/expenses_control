<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
//unset($_SESSION["current_user"]);
//check session
	if(isset($_SESSION["current_user"])){
		header("Location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER ["HTTP_HOST"]."/myExpenses.php");
		die();
	}
//end check session

if(!empty($_POST)){
	include ("controlers/user-controler.php");
	include ("model/user-model.php");

	$id=$_POST["user_id"];
	$pass=$_POST["user_pass"];
	$is_valid=logInVal($id,$pass);
	//var_dump($user_info);
	//die();
	//$is_valid=($id=="bernala" && $pass=="password")?true:false; // aqui verifica en base de datos y devuelve los detalles de usuario
	if($is_valid){
		$_SESSION["current_user"]=$is_valid;//set actual user data here
		//$_SESSION["current_user"]=array("id"=>14,"name"=>"Bernal","is_admin"=>true,"email"=>"asdasdasd@123.com");//set actual user data here
		header("Location: ".$_SERVER["REQUEST_SCHEME"]."://".$_SERVER ["HTTP_HOST"]."/myExpenses.php");
		die();
	}else{
		unset($_SESSION["current_user"]);
	}
}else{
	$is_valid=true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="/css/main-styles.css" >
	<link rel="stylesheet" type="text/css" href="/css/login.css" >
	
</head>

<body>
	<div id="login-div" class="Aligner">
		<div class="Aligner-item">
			<h1>Login</h1>
			<form method="Post">
				<?php if(!$is_valid){
					echo "<p>Error, please check your user and password</p>";
				}?>
				<input type="text" name="user_id" required>
				<input type="password" name="user_pass" required>
				<button type="submit" >Login</button>
			</form>
			
		</div>
	</div>
</body>

</html>