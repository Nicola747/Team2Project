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
<html lang="en">

<head>
    <title>Show Registration Information</title>
    <meta name="description" content="Vehicle Registration Database">
    <meta name="author" content="Nicola Mihai">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="media/images/team2icon_v4.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/index.css?v=1.0">
    <link rel="stylesheet" href="css/registration.css?v=1.0">
    <link rel="stylesheet" href="css/divStyle.css?v=1.0">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Team2 | Vehicle Registration Database</a>
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
        // $sql = "SELECT year,make,model,VIN FROM Vehicle V " .
        //     "INNER JOIN Registration R ON V.make = R.make WHERE VIN = ?";

        $sql = "SELECT V.*,registrationNumber,taxValue,sellerIdNumber,ownerIdNumber,certificationID,iDDOL FROM Vehicle V INNER JOIN Registration R ON V.VIN = R.VIN WHERE R.VIN = ?";
        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sql)) {
            echo "failed to prepare";
        } else {

            // Bind Parameters from User Input
            $stmt->bind_param('s', $id);

            // Execute the Statement
            $stmt->execute();

            // Process Results Using Cursor
            // $stmt->bind_result($year,$make,$model,$VIN,$ownerIdNumber,$weightLbs,$color,$vehicleType,$fuelType,$registrationNumber,$taxValue,$sellerIdNumber,$ownerIdNumber,$certificationID,$iDDOL);
            $stmt->bind_result($VIN, $year, $make, $model, $color, $weightLbs, $vehicleType, $fuelType, $registrationNumber, $taxValue, $sellerIdNumber, $ownerIdNumber, $certificationID, $iDDOL);
            echo "<br><br>";
            echo "<div id=\"vehicle-info-table\">";
            echo "<table class=\"table table-striped table-bordered table-hover\">";
            echo "<thead class=theat-dark id=\"thead-dark\">";
            echo "<tr>";
            echo "<th scope=\"col\">VIN Number</th>";
            echo "<th scope=\"col\">Year</th>";
            echo "<th scope=\"col\">Make</th>";
            echo "<th scope=\"col\">Model</th>";
            echo "<th scope=\"col\">Color</th>";
            echo "<th scope=\"col\">Weight (lbs)</th>";
            echo "<th scope=\"col\">Vehicle Type</th>";
            echo "<th scope=\"col\">Fuel Type</th>";
            echo "<th scope=\"col\">Registration Number</th>";
            echo "<th scope=\"col\">Tax Value</th>";
            echo "<th scope=\"col\">Seller ID</th>";
            echo "<th scope=\"col\">Owner ID</th>";
            echo "<th scope=\"col\">Certification ID</th>";
            echo "<th scope=\"col\">DOL ID</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // while ($stmt->fetch()) {
            //     echo '<a href="show_customer.php?id='  . $year . '">' . $make . '</a>' .
            //      $model . ',' . $VIN . '  ' . $ownerIdNumber;
            // }

            while ($stmt->fetch()) {
                echo "<tr>";
                echo '<td>' . $VIN . '</td>';
                echo '<td>' . $year . '</td>';
                echo '<td>' . $make . '</td>';
                echo '<td>' . $model . '</td>';
                echo '<td>' . $color . '</td>';
                echo '<td>' . $weightLbs . '</td>';
                echo '<td>' . $vehicleType . '</td>';
                echo '<td>' . $fuelType . '</td>';
                echo '<td>' . $registrationNumber . '</td>';
                echo '<td>' . $taxValue . '</td>';
                echo '<td>' . $sellerIdNumber . '</td>';
                echo '<td>' . $ownerIdNumber . '</td>';
                echo '<td>' . $certificationID . '</td>';
                echo '<td>' . $iDDOL . '</td>';
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        ?>
            <!-- <div>
                <a href="update_customer.php?id=<?= $ownerIdNumber ?>">Update Registration</a>
            </div> -->

            <!-- <div id="buttons">
                <button type=" button" class="btn btn-primary" data-toggle="modal" data-target="#owner-info">
                    View Owner Info
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Mymodal">
                    View Seller Info
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Mymodal">
                    Update Registration
                </button>
            </div> -->



            <!-- Button trigger modal -->
            <div id="button-helper">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    View Owner Information
                </button>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="vertical-alignment-helper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Owner Information</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div>
                            
                            </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        $conn->close();

        ?>
        </>

</body>

</html>