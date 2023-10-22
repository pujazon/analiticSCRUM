<!DOCTYPE html>
<html>
    <head>
        <title>SCRUM Analitics</title>
    </head>
	<body bgcolor="#1B003A" text="#E2FFDC">
<?php
require_once 'libs/HTML/Table.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "tsanalitics";

$dev="TBD";
$N = 8;
$Sprint=array(63,64,65,66,67,68,69,70,71,72,73,74,75);
$cplxSet=array(0,1,2,3);
$projectSet=array('lyra','artemis','fullpsm','speedscope','sli1m5');

echo "<h1> Dev Stats : ".$dev."</h1>";
echo "Internally there's a local variable that you've to set in order to perform the stats. in the future will have a input or even somenthign to select, and of course depends on DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    echo "<hr><br>";
    $result = mysqli_query($conn, "SELECT SUM(sp) FROM `tickets` ORDER BY `sprint` DESC ") or die ("Could not search");
    $allData = $result->fetch_all();
	$spTeam = $allData[0][0];
	echo "<br>Total SP closed all team = ".$allData[0][0];
	echo "<br>#team = ".$N;
	$spDevMean = intval($spTeam)/$N;
    $result = mysqli_query($conn, "SELECT SUM(sp) FROM `tickets` WHERE `developer` LIKE '".$dev."' ORDER BY `sprint` DESC ") or die ("Could not search");
    $allData = $result->fetch_all();
	$spDev = $allData[0][0];
	$devPerformance = intval($spDev)/intval($spDevMean);
	echo "<h2><b>SP/Dev = ".$spDevMean."</b></h2>";
	echo "<h2><b>Total SP closed Dev[i]= ".$spDev."</b></h2>";
	echo "<h2><b>Performance= ".$devPerformance."</b></h2>";
	
	echo "<hr><hr><hr>";
	echo "<h1> Developer Performance per Sprint </h1>";
	echo "<h2> 2 Graficas, 1 la propia para ver crecimiento, la otra con la normalizacion para comparar con equipo </h2>";
	echo "{Dev sp, Mean sp}";
	foreach($Sprint as $sp) {
        $result = mysqli_query($conn, "SELECT SUM(sp)  FROM `tickets` WHERE `developer` LIKE '".$dev."' AND `sprint` = ".$sp." ORDER BY `sprint`  DESC") or die ("Could not search");
        $result2 = mysqli_query($conn, "SELECT SUM(sp)  FROM `tickets` WHERE `sprint` LIKE '".$sp."' ORDER BY `sprint`  DESC") or die ("Could not search");
        $allData = $result->fetch_all();
        $allData2 = $result2->fetch_all();
	    $spSprintDev = $allData[0][0];
        $spSprintDevMean = intval($allData2[0][0])/intval($N);
        $perfDevSprint = intval($spSprintDev)/intval($spSprintDevMean);
        echo "<h4> Sprint ".$sp." = {".$spSprintDev.",".$spSprintDevMean."} -> ".$perfDevSprint."</h4>";
	}

	echo "<hr><hr><hr>";
	echo "<h1> Developer Complexity per Sprint </h1>";
	echo "{Dev Cplx, Mean Cplx}";
	foreach($Sprint as $sp) {
		echo "<hr>";
		foreach($cplxSet as $cplx) {
            $result = mysqli_query($conn, "SELECT COUNT(*) FROM `tickets` WHERE `developer` LIKE '".$dev."' AND `sprint` = ".$sp." AND `complexity` = ".$cplx." ORDER BY `sprint`  DESC") or die ("Could not search");
            $result2 = mysqli_query($conn, "SELECT COUNT(*) FROM `tickets` WHERE `sprint` LIKE '".$sp."' AND `complexity` = ".$cplx."  ORDER BY `sprint`  DESC") or die ("Could not search");
            $allData = $result->fetch_all();
            $allData2 = $result2->fetch_all();
	        $cplxSprintDev = $allData[0][0];
            //$cplxSprintDevMean = intval($allData2[0][0])/intval($N);
            //echo "<h4> Sprint ".$sp." Complexity ".$cplx."= {".$cplxSprintDev.",".$cplxSprintDevMean."}</h4>";
            echo "<h4> Sprint ".$sp." Complexity ".$cplx."= {".$cplxSprintDev."}</h4>";
		}
	}

	echo "<hr><hr><hr>";
	echo "<h1> Developer Performance per Project </h1>";
	foreach($projectSet as $project) {
        $result = mysqli_query($conn, "SELECT SUM(sp) FROM `tickets` WHERE `developer` LIKE '".$dev."' AND `project` LIKE '".$project."' ORDER BY `sprint`  DESC") or die ("Could not search");
        $result2 = mysqli_query($conn, "SELECT SUM(sp) FROM `tickets` WHERE `project` LIKE '".$project."' ORDER BY `sprint`  DESC") or die ("Could not search");
        $allData = $result->fetch_all();
        $allData2 = $result2->fetch_all();
	    $spProjectDev = $allData[0][0];
        $spProject = intval($allData2[0][0]);
        $perfDevProj = intval($spProjectDev)/intval($spProject);
        echo "<h4> Project: ".$project." = {".$spProjectDev.",".$spProject."} -> ".$perfDevProj."</h4>";
	}

	echo "<hr><hr><hr>";
	echo "<h1> Developer Complexity per Project </h1>";
	foreach($projectSet as $project) {
		echo "<h2>".$project."</h2>";
		foreach($cplxSet as $cplx) {
			$result = mysqli_query($conn, "SELECT COUNT(*) FROM `tickets` WHERE `developer` LIKE '".$dev."' AND `project` LIKE '".$project."'  AND `complexity` = ".$cplx." ORDER BY `sprint`  DESC") or die ("Could not search");
			$result2 = mysqli_query($conn, "SELECT COUNT(*) FROM `tickets` WHERE `project` LIKE '".$project."' AND `complexity` = ".$cplx." ORDER BY `sprint`  DESC") or die ("Could not search");
            $allData = $result->fetch_all();
            $allData2 = $result2->fetch_all();
	        $cplxProjDev = $allData[0][0];
	        $cplxProj = $allData2[0][0];
			if (intval($cplxProj) == 0) {
				$cplxPerfProject = "NA";
			} else {
				$cplxPerfProject = intval($cplxProjDev)/intval($cplxProj);
			}
            //$cplxSprintDevMean = intval($allData2[0][0])/intval($N);
            //echo "<h4> Sprint ".$sp." Complexity ".$cplx."= {".$cplxSprintDev.",".$cplxSprintDevMean."}</h4>";
            echo "<h4> Complexity ".$cplx."= {".$cplxProjDev.", Perf: ".$cplxPerfProject."}</h4>";
		}
	}
?>
    </body>
</html>
