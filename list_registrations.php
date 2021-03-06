<?php
/**
 * Team 2
 * 
 * Aylin Onalan, Nicola Mihai, Kyle Kawahara, David Galenko
 */

require_once 'config.inc.php';
?>
<html>

<head>
    <title>Show All Registrations</title>
    <meta name="description" content="Vehicle Registration Database">
    <meta name="author" content="Nicola Mihai">
    <link rel="icon" href="media/images/team2icon_v4.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=1.0">
    <link rel="stylesheet" href="css/registration.css?v=1.0">
    <link rel="stylesheet" href="css/divStyle.css?v=1.0">

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
            </ul>
            <a class="navbar-brand" id="group-names" href="">Aylin Onalan, Nicola Mihai, Kyle Kawahara, David Galenko</a>
        </div>
    </nav>

    <div>
        <br>
        <br>
        <br>
        <br>
        <h2 id="table-title">Full Registration List</h2>
        <?php
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database, $port);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL Statement
        $sql = "SELECT year,make,model,VIN FROM Vehicle ORDER BY year";
        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sql)) {
            echo "failed to prepare";
        } else {

            // Execute the Statement
            $stmt->execute();

            // Loop Through Result
            $stmt->bind_result($year, $make, $model, $VIN);

            // build table head
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

            // build table rows
            while ($stmt->fetch()) {
                echo "<tr>";
                echo '<td>' . $year . '</td>';
                echo '<td>' . $make . '</td>';
                echo '<td>' . $model . '</td>';
                echo '<td><a href="show_vehicle.php?id='  . $VIN . '">' . $VIN . '</td>';
                echo "</tr>";
            }

            // table end
            echo "</tbody>";
            echo "</table>";

            // filter registration button
            echo "<div id=\"button-helper\">";
            echo "<form action=\"filter_registrations.php?id=\"> <button type=\"submit\" class=\"btn btn-primary\">Filter by VIN</button> </form>";
            echo "</div>";
            echo "</div>";
        }

        // Close Connection
        $conn->close();

        ?>
    </div>
</body>

</html>