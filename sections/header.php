<header id="mainHead" class="row">
	<div class="logo ">
		 <img src="../img/hangar_logo.png" alt="Hangar Logo">
		 <h1>Expense Report Manager</h1> 
	</div>
	<div class="user-info ">
		<div class="detail">
			<h2><?php 
			echo $_SESSION["current_user"]["Name"]; 
			echo ($_SESSION["current_user"]["UserTypeId"]==1)?", Admin User":"";
			echo ($_SESSION["current_user"]["UserTypeId"]==2)?", Basic User":""; 
		?></h2>
		</div>
		<div class="logout"><a href="logout.php">Log Out</a></div>
	</div>
	
</header>