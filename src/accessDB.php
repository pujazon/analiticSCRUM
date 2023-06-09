<?php
require_once 'libs/HTML/Table.php';

if(isset($_POST['allDb'])) {
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

    $attrs = array('width' => '600');
    $table = new HTML_Table($attrs);
    $table->setAutoGrow(true);
    $table->setAutoFill('n/a');

    $table->setHeaderContents(0, 0, '');
    $table->setHeaderContents(0, 1, 'Jira ticket');
    $table->setHeaderContents(0, 2, 'Developer');
    $table->setHeaderContents(0, 3, 'Project');
    $table->setHeaderContents(0, 4, 'Sprint');
    $table->setHeaderContents(0, 5, 'Story Points');
    $table->setHeaderContents(0, 6, 'Log Work');
    $table->setHeaderContents(0, 7, 'Complexity');
    $table->setHeaderContents(0, 8, 'Skill');
    $hrAttrs = array('bgcolor' => 'silver');
    $table->setRowAttributes(0, $hrAttrs, true);
    $table->setColAttributes(0, $hrAttrs);

    $result = mysqli_query($conn, "SELECT * FROM tickets") or die ("Could not search");
    $data= mysqli_fetch_array($result);

    for ($nr = 0; $nr < count($data); $nr++) {
      //TODO: Parse must be modified
      $data= mysqli_fetch_array($result);
      //DBG
      echo $data[0];
      $table->setHeaderContents($nr+1, 0, (string)$nr);
      for ($i = 0; $i < 4; $i++) {
        if ('' != $data[$nr][$i]) {
          $table->setCellContents($nr+1, $i+1, $data[$nr][$i]);
        }
      }
    }
    $altRow = array('bgcolor' => 'red');
    $table->altRowAttributes(1, null, $altRow);

    echo $table->toHtml();
}
?>