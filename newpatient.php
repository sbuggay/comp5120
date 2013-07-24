<!DOCTYPE html>   
<html lang="en">   

<head>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
</head>

  <body>

    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <a class="brand" href="index.php">Bay View Community Hospital</a>
        <ul class="nav">
          <li><a href="index.php">Home</a></li>
          <li class="active"><a href="newpatient.php">New Patient</a></li>
          <li><a href="patientbill.php">Patient Bill</a></li>
          <li><a href="#">Room Utilization Report</a></li>
          <li><a href="#">Patient Report</a></li>
          <li><a href="#">Physician Report</a></li>
        </ul>
      </div>
    </div>

    <div class="container">

    <form action="insertPatient.php" class="well" method="post">
      <fieldset>
        <legend>New Patient</legend>
        <label>Patient ID:</label> <input type="number" name="cid"> 
        <label>name:</label> <input type="text" name="cname"> 
        <label>Street:</label> <input type="text" name="cstreet"> 
        <label>City:</label> <input type="text" name="ccity"> 
        <label>State:</label> <input type="text" name="cstate"> 
        <label>ZIP:</label> <input type="text" name="czip"> 
        <label>Admitted Date:</label> <input type="date" name="cadate"> 
        <label>Discharged Date:</label> <input type="date" name="cddate"> 
        <label>DoctorID:</label> <input type="number" name="cdid"> 
        <label>Insurance Name:</label> <input type="text" name="cinsurancename"> 
        <label>Policy Number:</label> <input type="text" name="cpolicy"> 
        <label>Room ID:</label> <input type="number" name="croomid"> 
        <label>Bed Label:</label> <input type="text" name="cbedlabel"> 
        <br>
        <input class="btn btn-primary" type="submit" name="submit">
      </fieldset>
    </form>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
  </body>
  </html>
