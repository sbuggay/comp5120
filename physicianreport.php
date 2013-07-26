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
        <li><a href="modify.php">Modify</a></li>
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
    <div class="row">
    <div class="span6">
    <legend>Get Physician Report</legend>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="well" method="post">
      <fieldset>
        
            
            <label>Physician ID:</label> <input type="number" name="cid"> 
            <br>
            <strong>OR</strong>
            <br><br>
            <label>Physician Name:</label> <input type="text" name="cname"> 
            <hr>
            <input class="btn btn-primary" type="submit" name="submit">
          </fieldset>
    </form>

    <?php
    if ($_POST['submit']) {
    $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
    if (!$dbh) {
      echo("Error in connection: " . pg_last_error());
    }
    echo "<legend>Physician Report " . date('Y/m/d') . "</legend>";
          if($_POST['cname'] == '')
          {
            $sql = "SELECT * FROM Doctor WHERE doctorid=" . $_POST['cid'];

            $result = pg_query($dbh, $sql);
            $row = pg_fetch_array($result);

            echo "Physician ID: " . $row[0] . "<br>";
            echo "Physician Name: " . $row[1] . "<br>";
            echo "Physician Phone: " . $row[2] . "<br>";
            echo "Physician Office: " . $row[3] . "<br>";


            $sql = "select patientid, patient.name, roomid, treatmenttype from doctor join patient using (doctorid) join treatment using (patientid) where treatment.doctorid=" . $_POST['cid'];

          }
          else
          {
            $sql = "select doctor.doctorid from doctor where name=" . "'" . $_POST['cname'] . "'";

            $result = pg_query($dbh, $sql);
            $row = pg_fetch_array($result);
            $id = intval($row[0]);

            $sql = "SELECT * FROM Doctor WHERE doctorid=" . $id;

            $result = pg_query($dbh, $sql);
            $row = pg_fetch_array($result);

            echo "Physician ID: " . $row[0] . "<br>";
            echo "Physician Name: " . $row[1] . "<br>";
            echo "Physician Phone: " . $row[2] . "<br>";
            echo "Physician Office: " . $row[3] . "<br>";


            $sql = "select patientid, patient.name, roomid, treatmenttype from doctor join patient using (doctorid) join treatment using (patientid) where treatment.doctorid=" . $id;
          }
    $result = pg_query($dbh, $sql);
    if (!$result) {
      echo("Error in SQL query: " . pg_last_error());
    }
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Patient #</th>";
        echo "<th>Patient name</th>";
        echo "<th>Location</th>";
        echo "<th>Treatment #</th>";
        echo "</tr>";
    while ($row = pg_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row[0] . "</td>";
          echo "<td>" . $row[1] . "</td>";
          echo "<td>" . $row[2] . "</td>";
          echo "<td>" . $row[3] . "</td>";
      echo "</tr>";
    }
    echo "</table>";

    pg_free_result($result);
    pg_close($dbh);
    }
    ?>
    </div>
    <div class="span6">
    <legend>All physicians</legend>
        <?php
        $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
        if (!$dbh) {
          echo("Error in connection: " . pg_last_error());
        }

        $sql = "SELECT * FROM Doctor";
        $result = pg_query($dbh, $sql);
        if (!$result) {
          echo("Error in SQL query: " . pg_last_error());
        }

        while ($row = pg_fetch_array($result)) {
          echo "<pre>";
          echo "ID: " . $row[0] . "<br />";
          echo "Name: " . $row[1] . "<br />";
          echo "</pre>";
        }

        pg_free_result($result);
        pg_close($dbh);
        ?> 


    </div>
    </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
