openConnection.php
<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

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

?>
