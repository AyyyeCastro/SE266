<?php
  //call other files
  include_once __DIR__ . '/model/patients.php';
  include_once __DIR__ . '/include/functions.php';

  // if posted, send the values to the database
  if (isPostRequest()) {
    $fName = filter_input(INPUT_POST, 'F_Name');
    $lName = filter_input(INPUT_POST, 'L_Name');
    $marStatus = filter_input(INPUT_POST, 'Mar_Status');
    $BD = filter_input(INPUT_POST, 'B_D');
    $result = insertPatient ($fName, $lName, $marStatus, $BD);    

    header('Location: viewPatients.php');
  }
?>
    
<html lang="en">
<head>
  <title>Insert Patient Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

   <h1>Insert Patient</h1>

   <br />
   <div class="col-sm-offset-1 col-sm-10">
      <p><a href="./viewPatients.php">View Current Patients</a></p>
   </div>
   <br />


  <form class="form-horizontal" action="insertPatient.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="F_Name">Patient First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="F_Name" placeholder="Enter first name" name="F_Name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="L_Name">Patient Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="L_Name" placeholder="Enter Last name" name="L_Name">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="Mar_Status">Patient Marriage Status:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="Mar_Status" placeholder="Enter 0(no) or 1 (yes)" name="Mar_Status">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="B_D">Patient Birthdate:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="B_D" placeholder="Enter birthdate" name="B_D">
      </div>
    </div> 
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Insert Patient Record</button>
        <?php
            if (isPostRequest()) {
                echo "Patient sucessfully Updated";
            }
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>