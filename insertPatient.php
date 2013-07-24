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
        die("<div class='alert alert-error'>Error in SQL query: " . pg_last_error() . "</div>");
      }

      echo "<div class='alert alert-success'>";
      echo "Data inserted successfully";
      echo "</div>";

      pg_free_result($result);
      pg_close($dbh);
    }
?>