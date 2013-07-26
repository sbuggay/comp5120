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
          <li class="active"><a href="patientbill.php">Patient Bill</a></li>
          <li><a href="roomutilizationreport.php">Room Utilization Report</a></li>
          <li><a href="patientreport.php">Patient Report</a></li>
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="span6">
        <legend>Get Patient Bill</legend>
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

          echo "Bay View Community Hospital<br>";
          echo "200 Lakeshore Dr. Bay View, AL<br>";
          echo(date('Y/m/d'));
          echo "<br>";
          echo "Statement account for:<br><br>";

          $sql = "SELECT name, patientid, addrStreet, addrState, addrZIP, admitted, discharged FROM Patient WHERE " . ($_POST['cname'] == '' ? "patientid=".$_POST['cid'] : "name='".$_POST['cname']."'");
          $result = pg_query($dbh, $sql);
          $row = pg_fetch_array($result);
          
          echo "Patient name: " . $row[0] . " Patient #: " . $row[1] . "<br>";
          echo "Patient address: " . $row[2] . ". " . $row[3] . " " . $row[4] . "<br>";
          echo "Date admitted: " . $row[5] . "<br>";
          echo "Date discharged: " . $row[6] . "<br>";

          $sql = "select treatmenttype as type, cost from treatment join treatmenttype using(treatmenttype) where patientid = " . $row[1] . " union select employeetype as type, cost*sum(duration) as cost from treatment join treatmentinvolvement using(treatmentid) join employeecost using(employeetype) where patientid = " . $row[1] . " group by employeetype,cost union select roomname as type, (discharged-admitted)*roomcost as cost from patient join room using(roomid) join roomcost using (roomname) where patientid = " . $row[1] . " and discharged is not null;";
          $result = pg_query($dbh, $sql);



          if (!$result) {
            echo "<div class='alert alert-error'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "Error in query";
            echo "<br>";
            echo (pg_last_error());
            echo "</div>";
          }
          if (pg_num_rows ( $result ) == 0)
          {
            echo "<div class='alert alert-error'>";
            echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
            echo "No results found";
            echo "</div>";
          }
          echo "<table class='table table-striped'>";
          echo "<tr>";
          echo "<th>Description</th>";
          echo "<th>Charge</th>";
          echo "</tr>";
          
          $total = 0;
          while ($row = pg_fetch_array($result)) {
            $total += intval($row[1]);
            
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "</tr>";
          }
          
          echo "<tr><td>Total</td><td>" . $total . "</td></tr>";
          echo "</table>";

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
