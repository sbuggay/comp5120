<!DOCTYPE html>   
<html lang="en">   

<head>
  <style type="text/css">
    /*.form-container {
        width: 300px;
        clear: both;
    }
    .form-container input {
        width: 100%;
        clear: both;
    }
    */
  </style>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
</head>



<div class="container">

  <body>
    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <a class="brand" href="#">Bay View Community Hospital</a>
        <ul class="nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Patient Bill</a></li>
          <li><a href="#">Room Utilization Report</a></li>
          <li><a href="#">Patient Report</a></li>
          <li><a href="#">Physician Report</a></li>
        </ul>
      </div>
    </div>


    <?php

// insert form into database
    if ($_POST['submit']) {
    // attempt a connection
      $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
      if (!$dbh) {
        die("Error in connection: " . pg_last_error());
      }
    // escape strings in input data
      $id = pg_escape_string($_POST['cid']);
      $name = pg_escape_string($_POST['cname']);
      $street = pg_escape_string($_POST['cstreet']);
      $city = pg_escape_string($_POST['ccity']);
      $state = pg_escape_string($_POST['cstate']);
      $zip = pg_escape_string($_POST['czip']);
      $adate = pg_escape_string($_POST['cadate']);
      $ddate = pg_escape_string($_POST['cddate']);
      $doctorid = pg_escape_string($_POST['cdid']);
      $insurance = pg_escape_string($_POST['cinsurancename']);
      $policy = pg_escape_string($_POST['cpolicy']);
      $roomid = pg_escape_string($_POST['croomid']);
      $bedlabel = pg_escape_string($_POST['cbedlabel']);

    // execute query
      $sql = "INSERT INTO Patient VALUES('$id', '$name', '$street', '$city', '$state', '$zip', '$adate', '$ddate', '$doctorid', '$insurance', '$policy', '$roomid', '$bedlabel')";
      $result = pg_query($dbh, $sql);

      if (!$result) {
        die("Error in SQL query: " . pg_last_error());
      }

      echo "Data successfully inserted!";

      pg_free_result($result);
      pg_close($dbh);
    }
    ?>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="well" method="post">
      <fieldset>
        <legend>New Patient</legend>
        <label>Patient ID:</label> <input type="number" name="cid"> 
        <label>name:</label> <input type="text" name="cname"> 
        <label>Street:</label> <input type="text" name="cstreet"> 
        <label>City:</label> <input type="text" name="ccity"> 
        <label>State:</label> <input type="text" name="cstate"> 
        <label>ZIP:</label> <input type="text" name="czip"> 
        <label>Admitted Date:</label> <input type="date" name="cadate"> 
        <label>Discharged Date:</label> <input type="date" name="cddate"> 
        <label>DoctorID:</label> <input type="number" name="cdid"> 
        <label>Insurance Name:</label> <input type="text" name="cinsurancename"> 
        <label>Policy Number:</label> <input type="text" name="cpolicy"> 
        <label>Room ID:</label> <input type="number" name="croomid"> 
        <label>Bed Label:</label> <input type="text" name="cbedlabel"> 
        <br>
        <input class="btn btn-primary" type="submit" name="submit">
      </fieldset>
    </form>

    <h3>Patients</h3>
    <?php
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM Patient";
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }

    while ($row = pg_fetch_array($result)) {
      echo "<pre>";
      echo "ID: " . $row[0] . "<br />";
      echo "Name: " . $row[1] . "<br />";
      echo "Street: " . $row[2] . "<br />";
      echo "City: " . $row[3] . "<br />";
      echo "State: " . $row[4] . "<br />";
      echo "ZIP: " . $row[5] . "<br />";
      echo "Admitted Date: " . $row[6] . "<br />";
      echo "Discharged Date: " . $row[7] . "<br />";
      echo "Doctor ID: " . $row[8] . "<br />";
      echo "Policy Number: " . $row[9] . "<br />";
      echo "Room ID: " . $row[10] . "<br />";
      echo "Bed Label: " . $row[11] . "<br />";
      echo "</pre>";
    }

    pg_free_result($result);
    pg_close($dbh);
    ?> 

    <h3>Insurances</h3>
    <?php
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM Insurance";
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }

    while ($row = pg_fetch_array($result)) {
      echo "<pre>";
      echo "Name: " . $row[0] . "<br />";
      echo "Phone: " . $row[1] . "<br />";
      echo "</pre>";
    }

    pg_free_result($result);
    pg_close($dbh);
    ?>

    <h3>Treatment Types</h3>
    <?php
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM TreatmentType";
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }

    while ($row = pg_fetch_array($result)) {
      echo "<pre>";
      echo "Treatment: " . $row[0] . "<br />";
      echo "Cost: " . $row[1] . "<br />";
      echo "Ordered: " . $row[2] . "<br />";
      echo "</pre>";
    }

    pg_free_result($result);
    pg_close($dbh);
    ?>

    <h3>Employee Costs</h3>
    <?php
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM EmployeeCost";
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }
    
    while ($row = pg_fetch_array($result)) {
      echo "<pre>";
      echo "Type: " . $row[0] . "<br />";
      echo "Cost: " . $row[1] . "<br />";
      echo "</pre>";
    }
    
    pg_free_result($result);
    pg_close($dbh);
    ?>



  </div>

  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $(".tabs").tabs();
    });
  </script>    
  <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>
