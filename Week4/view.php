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
     <div class="col-sm-offset-2 col-sm-10">
     
   <h1>Patients</h1>


   <?php 
      // call the other files
      include __DIR__ . '/model/patients.php';
      include __DIR__ . '/include/functions.php';

      // call the function
      $patientData = getPatients();
   ?>

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
               <td>
                  <a href="PatientRecord.php?action=update&p_id=<?php echo $row['id'];?>">Edit</a>
               </td>
               <td>
                  <form action="view.php" method="post">
                     <input type="hidden" name="p_id" value="<?php echo $row['id'];?>" />
                     <a href="PatientRecord.php?action=delete&p_id=<?php echo $row['id'];?>">delete</a>
                  </form>
               </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <a href="insertPatient.php">Insert Patient</a>
    </div>
</div>
</body>
</html>