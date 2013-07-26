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
          <li class="active"><a href="patientreport.php">Patient Report</a></li>
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">


    <div class="row">
      <div class="span6">
      <legend>Get Patient Report</legend>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="well" method="post">
          <fieldset>
            
            <label>Patient ID:</label> <input type="number" name="cid"> 
            <br>
            <strong>OR</strong>
            <br><br>
            <label>Patient Name:</label> <input type="text" name="cname"> 
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
          if($_POST['cname'] == '')
          {
            $sql = "SELECT * FROM Patient WHERE patientid=" . $_POST['cid'];
          }
          else
          {
            $sql = "SELECT * FROM Patient WHERE name=" . "'" . $_POST['cname'] . "'";
          }

          $result = pg_query($dbh, $sql);
    // query error
          if (!$result) {
            echo "<div class='alert alert-error'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Error in query";
            echo "<br>";
            echo (pg_last_error());
            echo "</div>";
          }
    // no results
          if (pg_num_rows ( $result ) == 0)
          {
            echo "<div class='alert alert-error'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "No results found";
            echo "</div>";
          }

    // print results
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
            echo "Room ID: " . $row[11] . "<br />";
            echo "Bed Label: " . $row[12] . "<br />";
            echo "Insurance: " . $row[9] . ", " . $row[10] . "<br />";
            echo "</pre>";
          }

          pg_free_result($result);
          pg_close($dbh);
        }
        ?>
      </div>
      <div class="span6">
        <legend>All patients</legend>
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
