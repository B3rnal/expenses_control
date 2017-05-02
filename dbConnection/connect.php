<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ExpRep_DB"

// Create connection
$conn = new mysqli($servername, $username, $password,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br><br>";

// choosing DB
echo "<br>Selecting DB<br>";
$conn->select_db( "ExpRep_DB" );
echo "<br>DB Selected<br>";
// /choosing DB

// querys
//select

$sql = "SELECT idUser, Name, Email FROM User";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "- id: " . $row["idUser"]. " - Name: " . $row["Name"]. " - Email " . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}
// /select
//include
$adding = "INSERT INTO `ExpRep_DB`.`User` (`EmployeeNumber`, `Name`, `Email`, `UserTypeId`) VALUES ('3', 'Nancy', 'nanaromo@gmail.com', '2');";
echo $adding;


if ($conn->query($adding) === TRUE) {
    echo "<br>New record created successfully";
} else {
    echo "<br>Error: " . $sql . "<br>" . $conn->error;
}
// /include

	
// close connection
$conn->close();
?>


