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
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="list_registrations.php">List All Vehicles<span class="sr-only">(current)</span></a>
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
        
        // Check the Request is an Update from User -- Submitted via Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cname = $_POST['uname'];
        //echo $_POST['subject']; 
        session_start();
        echo $_SESSION['myVIN'];
        if ($cname === null)
          echo "<div><i>Specify a new name</i></div>";
        else if ($cname === false)
          echo "<div><i>Specify a new name</i></div>";
        else if (trim($cname) === "")
          echo "<div><i>Specify a new name</i></div>";
        else {
  
          /* perform update using safe parameterized sql */
          $sql = "UPDATE DriverLicenseID SET name = ? WHERE idNumber = SELECT idNumber FROM Vehicle V 
          INNER JOIN Registration R ON V.VIN = R.VIN INNER JOIN Owner O ON R.ownerIdNumber = O.idNumber WHERE R.VIN = ?";
          $stmt = $conn->stmt_init();
          if (!$stmt->prepare($sql)) {
            echo "failed to prepare";
          } else {
  
            // Bind user input to statement
            $stmt->bind_param('ss', $cname, $id);
  
            // Execute statement and commit transaction
            $stmt->execute();
            $conn->commit();
          }
        }
      }

        // Prepare SQL using Parameterized Form (Safe from SQL Injections)
        // $sql = "SELECT year,make,model,VIN FROM Vehicle V " .
        //     "INNER JOIN Registration R ON V.make = R.make WHERE VIN = ?";

        $sql = "SELECT V.*,registrationNumber,taxValue,name,certificationID,iDDOL FROM Vehicle V 
        INNER JOIN Registration R ON V.VIN = R.VIN INNER JOIN Owner O ON R.ownerIdNumber = O.idNumber 
        INNER JOIN DriverLicenseID DL ON O.idNumber = DL.idNumber WHERE R.VIN = ?";
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
            $stmt->bind_result($VIN, $year, $make, $model, $color, $weightLbs, $vehicleType, $fuelType, $registrationNumber, $taxValue, $name, $certificationID, $iDDOL);
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
            echo "<th scope=\"col\">Name</th>";
            echo "<th scope=\"col\">Certification ID</th>";
            echo "<th scope=\"col\">DOL ID</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";


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
                echo '<td>' . $name . '</td>';
                echo '<td>' . $certificationID . '</td>';
                echo '<td>' . $iDDOL . '</td>';
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            // echo "<div id=\"button-helper\">";
            // echo "<form action=\"update_name.php?id=" . $VIN ."\"> <button type=\"submit\" class=\"btn btn-primary\">Update Name</button> </form>";
            // echo "</div>";

        ?>
            <div id="text-input">
                <form name="form" action="" method="post">
                    <table>
                        <tr>
                            <td>
                                <input class="form-control mr-sm-2" placeholder="Enter Name" type="text" name="uname" id="uname" value="">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php


        }

        $conn->close();

        ?>
        </>

</body>

</html>