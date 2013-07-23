<html>

<head>

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
</head>



<div class="container">

<body>
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <a class="brand" href="#">Bay View Community Hospital</a>
    <ul class="nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Patient Bill</a></li>
      <li><a href="#">Room Utilization Report</a></li>
      <li><a href="#">Patient Report</a></li>
      <li><a href="#">Physician Report</a></li>
    </ul>
  </div>
</div>

<h2>Database Test</h2>
<pre>
<?php

$dbh = pg_connect("host=localhost dbname=test user=postgres password=hendrix");
if (!$dbh) {
	echo("Error in connection: " . pg_last_error());
}

$sql = "SELECT * FROM People";
$result = pg_query($dbh, $sql);


if (!$result) {
	echo("Error in SQL query: " . pg_last_error());
}

while ($row = pg_fetch_array($result)) {
	echo "id: " . $row[0] . "<br />";
	echo "name: " . $row[1] . "<p />";
}

pg_free_result($result);
pg_close($dbh);
?>
</pre>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


     id: <br> <input type="text" name="ccode" size="2">  


     <p>


     name: <br> <input type="text" name="cname">       


     <p>


     <input class="btn btn-primary" type="submit" name="submit">

</form> 

</div>

</body>
</html>
