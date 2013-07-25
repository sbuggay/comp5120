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
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="newpatient.php">New Patient</a></li>
          <li><a href="patientbill.php">Patient Bill</a></li>
          <li><a href="roomutilizationreport.php">Room Utilization Report</a></li>
          <li><a href="patientreport.php">Patient Report</a></li>
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <h2>Database Tables</h2>
    <ul class="nav nav-tabs" id="tabs">
      <li class="active"><a href="#patients" data-toggle="tab">Patients</a></li>
      <li><a href="#insurances" data-toggle="tab">Insurances</a></li>
      <li><a href="#doctors" data-toggle="tab">Doctors</a></li>
      <li><a href="#rooms" data-toggle="tab">Rooms</a></li>
      <li><a href="#beds" data-toggle="tab">Beds</a></li>
      <li><a href="#treatments" data-toggle="tab">Treatments</a></li>
      <li><a href="#employees" data-toggle="tab">Employees</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="patients">
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
      </div>
      <div class="tab-pane" id="insurances">
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
      </div>
      <div class="tab-pane" id="doctors">
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
          echo "Phone: " . $row[1] . "<br />";
          echo "</pre>";
        }

        pg_free_result($result);
        pg_close($dbh);
        ?>
      </div>
      <div class="tab-pane" id="rooms">
        <?php
        $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
        if (!$dbh) {
          echo("Error in connection: " . pg_last_error());
        }

        $sql = "SELECT * FROM Room";
        $result = pg_query($dbh, $sql);
        if (!$result) {
          echo("Error in SQL query: " . pg_last_error());
        }

        while ($row = pg_fetch_array($result)) {
          echo "<pre>";
          echo "ID: " . $row[0] . "<br />";
          echo "Private: " . $row[1] . "<br />";
          echo "Number of Beds: " . $row[2] . "<br />";
          echo "Cost: " . $row[3] . "<br />";
          echo "</pre>";
        }

        pg_free_result($result);
        pg_close($dbh);
        ?>
      </div>
      <div class="tab-pane" id="beds">
        <?php
        $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
        if (!$dbh) {
          echo("Error in connection: " . pg_last_error());
        }

        $sql = "SELECT * FROM Bed";
        $result = pg_query($dbh, $sql);
        if (!$result) {
          echo("Error in SQL query: " . pg_last_error());
        }

        while ($row = pg_fetch_array($result)) {
          echo "<pre>";
          echo "ID: " . $row[0] . "<br />";
          echo "Label: " . $row[1] . "<br />";
          echo "</pre>";
        }

        pg_free_result($result);
        pg_close($dbh);
        ?>
      </div>
      <div class="tab-pane" id="treatments">
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
          echo "Ordered: " . $row[1] . "<br />";
          echo "</pre>";
        }

        pg_free_result($result);
        pg_close($dbh);
        ?>
      </div>
      <div class="tab-pane" id="employees">
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
    </div>

    </script>    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
