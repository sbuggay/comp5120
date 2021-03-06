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
          <li><a href="physicianreport.php">Physician Report</a></li>
          <li class="active"><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">


   <form action="resetdb.php" method="post">
    <button class="btn btn-large btn-block btn-danger" type="submit">Reset database to default values</button>
    <hr>
    <h2>Default values</h2>
    <pre>
      <br>
        <?php
        $file = $_SERVER['DOCUMENT_ROOT'] . "/comp5120/database.sql"; //Path to your *.txt file 
        $contents = file($file); 
        $string = implode($contents); 
        $string = trim($string);
        echo $string; ?>
      </pre>
    </form>



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
