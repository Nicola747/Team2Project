<?php
/**
 * Created by PhpStorm.
 * User: MKochanski
 * Date: 7/24/2018
 * Time: 3:07 PM
 */
require_once 'config.inc.php';
// Get Customer Number
$id = $_GET['id'];
if ($id === "") {
    header('location: list_customers.php');
    exit();
}
if ($id === false) {
    header('location: list_customers.php');
    exit();
}
if ($id === null) {
    header('location: list_customers.php');
    exit();
}
?>
<html>
<head>
    <title>Show Registration Information</title>
    <meta name="description" content="Team2: Group Project - Vehicle Registration Database">
    <meta name="author" content="Nicola Mihai">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=1.0">
    <link rel="stylesheet" href="css/registration.css?v=1.0">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="">Team2 | Vehicle Registration Database</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="list_registrations.php">List All Registrations <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="list_vehicles.php">List All Vehicles</a>
            </li>

            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Make Changes to Database</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="create_registration.php">Create New Registration</a>
                        <a class="dropdown-item" href="remove_registration.php">Remove Registration</a>
                        <a class="dropdown-item" href="modify_registration.php">Modify Registration</a> 
                    </div>
                </li>
          </ul>
          <a class="navbar-brand" id="group-names" href="">Aylin Onalan, Nicola Mihai, Kyle Kawahara, David Galenko</a>

        </div>
      </nav>
<div>
    <h2>Show Registration Information</h2>
    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Prepare SQL using Parameterized Form (Safe from SQL Injections)
    $sql = "SELECT year,make,model,VIN FROM Vehicle V " .
        "INNER JOIN Registration R ON V.VIN = R.VIN WHERE ownerIdNumber = ?";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Bind Parameters from User Input
        $stmt->bind_param('s',$id);
		
		// Execute the Statement
        $stmt->execute();
		
		// Process Results Using Cursor
        $stmt->bind_result($year,$make,$model,$VIN,$ownerIdNumber);
        echo "<div>";
        while ($stmt->fetch()) {
            echo '<a href="show_customer.php?id='  . $year . '">' . $make . '</a><br>' .
             $model . ',' . $VIN . '  ' . $ownerIdNumber;
        }
        echo "</div>";
    ?>
        <div>
            <a href="update_customer.php?id=<?= $ownerIdNumber ?>">Update Registration</a>
        </div>
    <?php
    }

    $conn->close();

    ?>
</>
</body>
</html>
