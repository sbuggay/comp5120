<?php
      $dbh = pg_connect("host=localhost dbname=group5db user=postgres password=hendrix");
      if (!$dbh) {
        echo("Error in connection: " . pg_last_error());
      }
      $sql = file_get_contents( 'database.sql' );
      $result = pg_query($dbh, $sql);
      if (!$result) {
        echo("Error in SQL query: " . pg_last_error());
      }
      echo "Database has been reset";
      pg_free_result($result);
      pg_close($dbh);

    ?>