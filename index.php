<html>

<head>


</head>

<body>


<?php
echo "database test";
$dbh = pg_connect("host=localhost dbname=test user=postgres password=hendrix");
if (!$dbh) {
	die("Error in connection: " . pg_last_error());
}

$sql = "SELECT * FROM People";
$result = pg_query($dbh, $sql);


if (!$result) {
	die("Error in SQL query: " . pg_last_error());
}

while ($row = pg_fetch_array($result)) {
	echo "id: " . $row[0] . "<br />";
	echo "name: " . $row[1] . "<p />";
}

pg_free_result($result);
pg_close($dbh);
?>


</body>
</html>
