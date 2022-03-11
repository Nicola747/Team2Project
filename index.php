<?php
/**
 * Created by PhpStorm.
 * User: markk@uw.edu
 * Date: 7/24/2018
 * Time: 2:45 PM
*/?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Vehicle Registration Database</title>
  <meta name="description" content="Team2: Group Project - Vehicle Registration Database">
  <meta name="author" content="Nicola Mihai">
  <link rel="icon" href="media/images/team2icon_v3.png">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css?v=1.0">

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
    <div class="home-header">
        <div class="home-header-section">
          <h1 id="my-name"><br>Vehicle Registration Database<br>Team 2<br><br><br></h1>
          <!-- <h2>Background landcape scrolls with its own depth </h2> -->
        </div>
      </div>
      
      <div class="home-section-wrap">
        <div class="home-section">
        <h1>About the Database</h1>
            <!-- <img id="my-picture" src="media/images/Nicola.JPG" alt=""> -->
            <br>
            
            <!-- TEXT goes here -->
            <p>This database contains registration information regarding DOL/DMV related items. This includes, but is not limited to, vehicles, vessels, trailers, 
                etc. It also includes additional information required for those records such as person information (driver license, ownership, address) and vehicle specifications (make, model, etc.).</p>         

            <h1>About the Assignment</h1>
            <!-- <img id="my-picture" src="media/images/Nicola.JPG" alt=""> -->
            <br>
            
            <!-- TEXT goes here -->
            <p>"You will be using a MySql database hosted on UW’s shared server (such as vergil.u.washington.edu), you may use the PHP reference (css475php). 
                This is a simplified PHP client-server application that generates HTML webpages. The files of project would be stored in a subdirectory of public_html 
                or student_html folders on UW servers. You will need to customize the config.inc.php file for your DBMS specific parameters much in the same way as you 
                customized the configuration file for PhpMyAdmin. PHP code calls the mysqli database layer to interact with MySql database."</p>            
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


  <script src="js/index-scrips.js"></script>
  <footer class="container">
        <p>© Team 2 2022-2023</p>
    </footer>
</body>
</html>
