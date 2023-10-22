<?php
require_once 'libs/HTML/Table.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "tsanalitics";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
echo "<br>";

if (isset($_FILES['miArchivo'])) {
    $nombre = $_FILES['miArchivo']['name'];
    $tipo = $_FILES['miArchivo']['type'];
    $tamano = $_FILES['miArchivo']['size'];
    $temporal = $_FILES['miArchivo']['tmp_name'];
    $error = $_FILES['miArchivo']['error'];

	echo "Uploaded ".$nombre." successfull!";
	echo "<br>";
	echo "Tmp name is  ".$temporal;
    echo "<br>";
	
    $content = file_get_contents($_FILES["miArchivo"]["tmp_name"]);
    $lines = explode("\n", $content); // TAKING NEW ROW BY ' \n '
	$insertSQLCmd = "INSERT INTO `tickets` (`id`, `developer`, `project`, `sprint`, `sp`, `lw`, `complexity`, `skill`, `info`) VALUES ";

	
	echo "<hr>";
	echo "<hr>";
	echo "Preview:";
	echo "<hr>";
	
	echo "<br>";
	echo "<hr>";

	foreach ($lines as $line) {
        $fields = explode(";", $line); //IN TEXT FILE COLUMN IS SEPARATED BY ' : '
		echo $line;
		//echo "<br>"
		//echo $fields[0][0];
		$insertSQLCmd = $insertSQLCmd."(";
		foreach($fields as $field) {
			$field = str_replace("'", "`", $field);
			$insertSQLCmd = $insertSQLCmd."'".$field."', ";
		}
		$insertSQLCmd = substr_replace($insertSQLCmd ,"", -2); //Get out of sql charact of last element, not req
		$insertSQLCmd = $insertSQLCmd."), ";
	    echo "<hr>";
	}
	echo "<br>";
	echo "<hr>";
	echo "<hr>";
	echo "<h1> Query to be sent: </h1> <br>";
    $insertSQLCmd = substr_replace($insertSQLCmd ,"", -8); //Get out of sql charact of last element, not req
	echo $insertSQLCmd;

    if ($conn->query($insertSQLCmd) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "<br> <h2> Error on upload DB! " . $sql . "<br>" . $conn->error."</h2>";
    }
}
?>