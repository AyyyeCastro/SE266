<?php 
   // reference other files
  include __DIR__ . '/model/patients.php';
  include __DIR__ . '/include/functions.php';


  // if via get method 
   if(isset($_GET['action'])){
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'p_id');
      if($action =="update"){
         $row=getPatientRecord($id);
         $fName=$row['patientFirstName'];
         $lName=$row['patientLastName'];
         $marStatus=$row['patientMarried'];
         $BD = $row['patientBirthDate'];
      }else{
         $fName ="";
         $lName="";
         $marStatus="";
         $BD ="";
      }

  // Post is working fine, the get method is giving me a problem. >:(
   }elseif(isset($_POST['action'])){
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'p_id');
      $fName = filter_input(INPUT_POST, 'fName');
      $lName = filter_input(INPUT_POST, 'lName');
      $marStatus = filter_input(INPUT_POST, 'marStatus');
      $BD = filter_input(INPUT_POST, 'BD');
   }

   // depending on the action, execute a specific function from model/patients.php
  if(isPostRequest() && $action =="update"){
      $result = updatePatient($id, $fName, $lName, $marStatus, $BD);
      header('Location: view.php');
   }elseif (isPostRequest() && $action =="delete"){
     $id = filter_input(INPUT_POST, 'p_id');
     $result = deletePatient($id);
     header('Location: view.php');
   }   
?>

<html lang="en">
<head>
  <title>Patient Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

   <h2><?php echo $action." patient"?></h1><br>
   <br />
   <div class="col-sm-offset-1 col-sm-10">
      <p><a href="./view.php">View Current Patients</a></p>
   </div>
   <br />

   <form class="form-horizontal" action="PatientRecord.php" method="POST">
      <input type="hidden" name="action" value="<?php echo $action; ?>">
      <input type="hidden" name="p_id" value="<?php echo $id; ?>">
   


              
    <div class="form-group">
      <label class="control-label col-sm-2" for="fName">Patient First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="fName" placeholder="Enter first name" name="fName" value="<?php echo $fName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="lName">Patient Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="lName" placeholder="Enter Last name" name="lName" value="<?php echo $lName; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="marStatus">Patient Marriage Status:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="marStatus" placeholder="Enter 0(no) or 1 (yes)" name="marStatus" value="<?php echo $marStatus; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="BD">Patient Birthdate:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="BD" placeholder="Enter birthdate" name="BD" value="<?php echo $BD; ?>">
      </div>
    </div> 
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> Patient Record</button>
        <?php
            if (isPostRequest()) {
                echo $action. " sucessfull";
            }
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>