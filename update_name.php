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
  <title>Update Name</title>
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
    <h2>Update Name</h2>
    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Check the Request is an Update from User -- Submitted via Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $CustomerName = $_POST['CustomerName'];
      //echo $_POST['subject']; 
      if ($CustomerName === null)
        echo "<div><i>Specify a new name</i></div>";
      else if ($CustomerName === false)
        echo "<div><i>Specify a new name</i></div>";
      else if (trim($CustomerName) === "")
        echo "<div><i>Specify a new name</i></div>";
      else {

        /* perform update using safe parameterized sql */
        $sql = "UPDATE customer SET CustomerName = ? WHERE CustomerNumber = ?";
        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sql)) {
          echo "failed to prepare";
        } else {

          // Bind user input to statement
          $stmt->bind_param('ss', $CustomerName, $id);

          // Execute statement and commit transaction
          $stmt->execute();
          $conn->commit();
        }
      }
    }

    /* Refresh the Data */
    $sql = "SELECT CustomerNumber,CustomerName,StreetAddress,CityName,StateCode,PostalCode FROM customer C " .
      "INNER JOIN address A ON C.DefaultAddressID = A.AddressID WHERE CustomerNumber = ?";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
      echo "failed to prepare";
    } else {
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $stmt->bind_result($CustomerNumber, $CustomerName, $StreetName, $CityName, $StateCode, $PostalCode);
    ?>
      <div id="text-input">
        <form name="form" action="" method="post">
          <table>
            <tr>
              <td>
                <input class="form-control mr-sm-2" placeholder="Enter VIN" type="text" name="VIN-num" id="VIN-num" value="">
              </td>
              <td>
                <button type="submit" class="btn btn-primary">Filter</button>
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