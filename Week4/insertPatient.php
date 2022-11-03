<?php
  //call other files
  include __DIR__ . '/model/patients.php';
  include __DIR__ . '/include/functions.php';

  // if posted, send the values to the database
  if (isPostRequest()) {
    $fName = filter_input(INPUT_POST, 'fName');
    $lName = filter_input(INPUT_POST, 'lName');
    $marStatus = filter_input(INPUT_POST, 'marStatus');
    $BD = filter_input(INPUT_POST, 'BD');
    $result = insertPatient ($fName, $lName, $marStatus, $BD);    

    header('Location: view.php');
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
      <p><a href="./view.php">View Current Patients</a></p>
   </div>
   <br />


  <form class="form-horizontal" action="insertPatient.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="fName">Patient First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="fName" placeholder="Enter first name" name="fName">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="lName">Patient Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="lName" placeholder="Enter Last name" name="lName">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="marStatus">Patient Marriage Status:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="marStatus" placeholder="Enter 0(no) or 1 (yes)" name="marStatus">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="BD">Patient Birthdate:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="BD" placeholder="Enter birthdate" name="BD">
      </div>
    </div> 
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Insert Patient Record</button>
        <?php
            if (isPostRequest()) {
                echo "Patient sucessfully Inserted";
            }
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>