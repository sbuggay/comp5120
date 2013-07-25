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
        <li><a href="patientbill.php">Patient Bill</a></li>
        <li><a href="roomutilizationreport.php">Room Utilization Report</a></li>
        <li><a href="patientreport.php">Patient Report</a></li>
        <li class="active"><a href="physicianreport.php">Physician Report</a></li>
        <li><a href="admin.php">Admin</a></li>
      </ul>
      </div>
    </div>
  </div>

  <div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="well" method="post">
      <fieldset>
        <legend>Get Physician Report</legend>
        <label>Physician ID:</label> <input type="number" name="cdoctorid"> 
        <br>
        <input class="btn btn-primary" type="submit" name="submit">
      </fieldset>
    </form>

    <?php
    if ($_POST['submit']) {
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }

    $sql = "SELECT * FROM Doctor WHERE doctorid=" . $_POST['cdoctorid'];
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }

    while ($row = pg_fetch_array($result)) {
      echo "<pre>";
      echo "ID: " . $row[0] . "<br />";
      echo "Private: " . $row[1] . "<br />";
      echo "Beds: " . $row[2] . "<br />";
      echo "Cost: " . $row[3] . "<br />";
      echo "</pre>";
    }

    pg_free_result($result);
    pg_close($dbh);
    }
    ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
