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
          <li class="active"><a href="roomutilizationreport.php">Room Utilization Report</a></li>
          <li><a href="patientreport.php">Patient Report</a></li>
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">

    <div>

    <legend>Room Utilization Report <?php echo(date('Y/m/d'));?></legend>
      <?php

        $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
        if (!$dbh) {
          echo("Error in connection: " . pg_last_error());
        }

        $sql = "select roomid, bedlabel, roomName, patientid, name, discharged from room join bed using(roomid) left join patient using(roomid,bedlabel) join roomcost using (roomName) order by roomid, bedlabel;";
        $result = pg_query($dbh, $sql);
        if (!$result) {
          echo("Error in SQL query: " . pg_last_error());
        }
        echo "<table class='table table-striped'>";
        echo "<tr>";
        echo "<th>Room #</th>";
        echo "<th>Bed</th>";
        echo "<th>Private</th>";
        echo "<th>Patient #</th>";
        echo "<th>Name</th>";
        echo "<th>Discharge Date</th>";
        echo "</tr>";
        while ($row = pg_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . $row[0] . "</td>";
          echo "<td>" . $row[1] . "</td>";
          echo "<td>" . $row[2] . "</td>";
          echo "<td>" . $row[3] . "</td>";
          echo "<td>" . $row[4] . "</td>";
          echo "<td>" . $row[5] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        pg_free_result($result);
        pg_close($dbh);
      ?>
    </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
