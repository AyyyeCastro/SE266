<?php 
   // call the other files
   include_once __DIR__ . '/model/patients.php';
   include_once __DIR__ . '/include/functions.php';
   session_start();
  
   if(!isset($_SESSION["isLoggedIn"]))
   { 
   header("location:login.php"); 
   }
   
   // call the function
   $patientData = getPatients();
   
?>

<html lang="en">
<head>
  <title>View Patient Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
     <div class="col-sm-offset-1 col-sm-10">
     
   <h1><b>Castro Patient Database | Admin</b></h1><br>
   <?php
   if (isUserLoggedIn()) 
   { ?>
      <h4>
         <a href="insertPatient.php">Insert Patient  |</a> 
         <a href="searchPatient.php">Find Patient |</a>&nbsp
         <a href="logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> 
      <h4>

      <?php
   }
   ?>
   <br/>
   <table class="table table-striped">
        <thead>
            <tr>
                <th>Patient First Name</th>
                <th>Patient Last Name</th>
                <th>Patient Married?</th>
                <th>Patient Birthdate</th>
            </tr>
        </thead>
        <tbody>
         <?php foreach ($patientData as $row): ?>
            <tr>
               <td><?php echo $row['patientFirstName']; ?></td>
               <td><?php echo $row['patientLastName']; ?></td>     
               <td><?php echo $row['patientMarried']; ?></td>  
               <td><?php echo $row['patientBirthDate']; ?></td>    
               <td><!-- "updatePatient.php?p_id= ..echo $row['id'];?>" -->
               <a href="editPatient.php?action=update&p_id=<?php echo $row['id'];?>">Edit</a>
               </td>
               <td>
                  <form action="view.php" method="post">
                     <input type="hidden" name="p_id" value="<?php echo $row['id'];?>" />
                     <a href="editPatient.php?action=delete&p_id=<?php echo $row['id'];?>">delete</a>
                  </form>
               </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>