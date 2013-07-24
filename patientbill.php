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
        <li><a href="newpatient.php">New Patient</a></li>
        <li class="active"><a href="patientbill.php">Patient Bill</a></li>
        <li><a href="#">Room Utilization Report</a></li>
        <li><a href="#">Patient Report</a></li>
        <li><a href="#">Physician Report</a></li>
      </ul>
      </div>
    </div>
  </div>

  <div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="well" method="post">
      <fieldset>
        <legend>Get Patient</legend>
        <label>Patient ID:</label> <input type="number" name="cid"> 
        <br>
        <input class="btn btn-primary" type="submit" name="submit">
      </fieldset>
    </form>

    <?php
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM Patient WHERE patientid=" . $_POST['cid'];
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

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
