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

	
	echo "<hr>";
	echo "<hr>";
	echo "Preview:";
	echo "<hr>";
	
	echo "<br>";
	echo "<hr>";

	foreach ($lines as $line) {
        $row = explode(":", $line); //IN TEXT FILE COLUMN IS SEPARATED BY ' : '
		echo $row[0];
	    echo "<hr>";
	}
	echo "<br>";
	echo "<hr>";
	echo "<hr>";
}
?>