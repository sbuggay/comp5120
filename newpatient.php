<!DOCTYPE html>   
<html lang="en">   

<head>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
</head>

<body>

  <div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.php">Bay View Community Hospital</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="newpatient.php">New Patient</a></li>
          <li><a href="patientbill.php">Patient Bill</a></li>
          <li><a href="roomutilizationreport.php">Room Utilization Report</a></li>
          <li><a href="patientreport.php">Patient Report</a></li>
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li><a href="#">Info</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">

    <?php
    if ($_POST['submit']) {

      $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
      if (!$dbh) {
        die("Error in connection: " . pg_last_error());
      }

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

      $sql = "INSERT INTO Patient VALUES('$id', '$name', '$street', '$city', '$state', '$zip', '$adate', '$ddate', '$doctorid', '$insurance', '$policy', '$roomid', '$bedlabel')";
      $result = pg_query($dbh, $sql);

      if (!$result) {
        echo "<div class='alert alert-error'>";
        echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
        echo "Data insert error";
        echo "<br>";
        echo (pg_last_error());
        echo "</div>";
      }
      else {

      echo "<div class='alert alert-success'>";
      echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
      echo "Data inserted successfully";
      echo "</div>";
      }

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

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
