<?php
/**
 * User: nmihai
 */
require_once 'config.inc.php';

?>

<html>
<head>
    <title>Sample PHP Database Program</title>
    <link rel="stylesheet" href="base.css">
</head>
<body>
<?php

?>
<div>
    <h2>Filter by VIN</h2>
    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Check the Request is an Update from User -- Submitted via Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $VIN = $_POST['VIN'];
	//echo $_POST['subject']; 
        if ($VIN === null)
            echo "<div><i>Specify a new name</i></div>";
        else if ($VIN === false)
            echo "<div><i>Specify a new name</i></div>";
        else if (trim($VIN) === "")
            echo "<div><i>Specify a new name</i></div>";
        else {
			
            /* perform update using safe parameterized sql */
            $sql = "SELECT year,make,model,VIN FROM Vehicle WHERE VIN LIKE '%?%'";
            $stmt = $conn->stmt_init();
            if (!$stmt->prepare($sql)) {
                echo "failed to prepare";
            } else {
				
				// Bind user input to statement
                $stmt->bind_param($year,$make,$model,$VIN);
				
				// Execute statement and commit transaction
                $stmt->execute();
                $conn->commit();
            }
        }
    }

    /* Refresh the Data */
    $sql = "SELECT year,make,model,VIN FROM Vehicle WHERE VIN LIKE '%?%'";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Execute the Statement
        $stmt->execute();
		
		// Loop Through Result
        $stmt->bind_result($year,$make,$model,$VIN);
        // echo "<ul>";
        echo "<div id=\"vehicle-table\">";
        echo "<table class=\"table table-striped table-bordered table-hover\">";
        echo "<thead class=theat-dark id=\"thead-dark\">";
        echo "<tr>";
        echo "<th scope=\"col\">Year</th>";
        echo "<th scope=\"col\">Make</th>";
        echo "<th scope=\"col\">Model</th>";
        echo "<th scope=\"col\">VIN Number</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
          
        while ($stmt->fetch()) {
            // echo '<li><a href="show_vehicle.php?id='  . $year . '">' . $make . '">'. $model . '</a></li>';
            // echo "<th scope=\"row\">1</th>";
            echo "<tr>";
            echo '<td>' .$year. '</td>';
            echo '<td>' .$make. '</td>';
            echo '<td>' .$model. '</td>';
            echo '<td><a href="show_vehicle.php?id='  . $VIN . '">' .$VIN. '</td>';
            echo "</tr>";
            // echo '<td><a href="show_vehicle.php?id='  . $year . '">' . $make . '">'. $model . '</a></td>';
            // echo '';
        }
        // echo "</ul>";
        echo "</tbody>";
        echo "</table>";

        echo "<div id=\"text-input\">";
        // echo '<a href="show_vehicle.php?id='  . $VIN . '">Filter by VIN</a>';
        echo '<a href="filter_registrations.php?id=" class=\"btn btn-primary\">Filter by VIN</a>';
        echo "</div>";
        echo "</div>";

        
    }
    ?><br><br>
            New Name: <input type="text" name="VIN">
            <button type="submit">Update</button>
        </form>
    <?php
    

    $conn->close();

    ?>
</>
</body>
</html>
