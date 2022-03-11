<?php
/**
 * User: nmihai
 */
require_once 'config.inc.php';

?>
<html>
<head>
    <title>Sample PHP Database Program</title>
    <meta name="description" content="Team2: Group Project - Vehicle Registration Database">
    <meta name="author" content="Nicola Mihai">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=1.0">
    <link rel="stylesheet" href="css/registration.css?v=1.0>

</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Team2 | Vehicle Registration Database</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="list_vehicles.php">List All Vehicles</a>
            </li>

            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Make Changes to Database</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <!-- <a class="dropdown-item" href="https://students.washington.edu/nmihai/bimd233/CapstoneProject/WriteUp/">Capstone Draft</a>
                        <hr> -->
                        <a class="dropdown-item" href="create_registration.php">Create New Registration</a>
                        <a class="dropdown-item" href="remove_registration.php">Remove Registration</a>
                        <a class="dropdown-item" href="modify_registration.php">Modify Registration</a> 
                        <!-- <hr>
                        <a class="dropdown-item" href="https://marine-tractor-294001.wn.r.appspot.com/">Lavender</a> -->
                    </div>
                </li>
          </ul>
          <a class="navbar-brand" id="group-names" href="">Aylin Onalan, Nicola Mihai, Kyle Kawahara, David Galenko</a>
          
          <!-- <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>

<div>
    <br>
    <br>
    <h2>Full Registration List</h2>
    <?php
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Prepare SQL Statement
    $sql = "SELECT year,make,model FROM Vehicle ORDER BY year";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Execute the Statement
        $stmt->execute();
		
		// Loop Through Result
        $stmt->bind_result($year,$make,$model);
        // echo "<ul>";
        echo "<div id=\"vehicle-table\">"
        echo "<table class=\"table\">";
        echo "<thead class=theat-dark>";
        echo "<tr>";
        echo "<th scope=\"col\">#</th>";
        echo "<th scope=\"col\">First</th>";
        echo "<th scope=\"col\">Last</th>";
        echo "<th scope=\"col\">Handle</th>";
        echo "</tr>";
        echo "</thead>";
          
        while ($stmt->fetch()) {
            echo '<li><a href="show_vehicle.php?id='  . $year . '">' . $make . '">'. $model . '</a></li>';
        }
        // echo "</ul>";
        echo "</table>";
        echo "</div>"
    }

	// Close Connection
    $conn->close();

    ?>
</div>
</body>
</html>
