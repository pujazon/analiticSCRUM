<?php
if(isset($_POST['allDb'])) {
    $servername = "localhost";
    $username = "X";
    $password = "Y";
    $database = "Z";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    echo "<br>";

    $result = mysqli_query($conn, "SELECT * FROM tickets") or die ("Could not search");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "SCXBB-", $row['id'], ' | ', $row['developer'],' | ';
        echo $row['project'], ' | ', $row['sprint'],' | ';
        echo $row['sp'], ' | ', $row['lw'],' | ';
        echo $row['complexity'], ' | ', $row['skill'],' | ';
        echo $row['info'],' | ';
        echo "<br>";
    }
}
?>