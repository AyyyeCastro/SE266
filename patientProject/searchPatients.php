<?php

    // Load helper functions (which also starts the session) then check if user is logged in
    include_once __DIR__ . '/include/functions.php'; 
    session_start();
    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }

   include_once __DIR__ . '/model/userSearch.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try 
    {
        $patientDataBase = new userSearchClass($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    // If POST, delete the requested team before listing all teams
    $listPatients = [];
    if (isPostRequest()) 
    {
        if (isset($_POST["Search"]))
        {
            $fName="";
            $lName="";
            $marStatus="";
            $bYear="";
            // If the user chose (from the drop down list) the option -> firstName (as assigned by it's value)
            if ($_POST["optionChosen"] == "firstName")
            {
               // then $fName variable will be assigned the text the user input.
                $fName = $_POST['userInputValue'];
            }
            if($_POST["optionChosen"] == "lastName") 
            {
               $lName = $_POST['userInputValue'];
            }
            if($_POST["optionChosen"] == "Marriage") 
            {
               $marStatus = $_POST['userInputValue'];
            }
            if($_POST["optionChosen"] == "birthYear") 
            {
               $bYear = $_POST['userInputValue'];
            }
            
            // Display the results of the record found.
            $listPatients = $patientDataBase->findPatient ($fName, $lName, $marStatus, $bYear);
        }
        else
        {
        
            $id = filter_input(INPUT_POST, 'teamId');
            $patientDataBase->userDelete ($id);
            $teamListing = $patientDataBase->getPatients();
        }
    }
    else
    {
        $listPatients = $patientDataBase->getPatients();
    }
?>

<html lang="en">
<head>
  <title>View Patient Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
      body{
         font-size: 15px;
      }
   </style>
</head>
<body>
<div class="container">
      
</div>
    <div class="col-sm-offset-1 col-sm-10">

    <h1><b>Castro Patient Database | Admin</b></h1>
   <?php
   if (isUserLoggedIn()) 
   { ?>
      <h4>
         <a href="insertPatient.php">Insert Patient |</a> &nbsp
         <a href="./searchPatients.php">View All Patients  |</a> &nbsp
         <a href="logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> 
      <h4>

      <?php
   }
   ?>
   <hr/>


   <form action="#" method="post">
      <input type="hidden" name="action" value="search" />
      <label>Find Patient</label>
       <select name="optionChosen">
              <option value="">Choose Criteria</option>
              <option value="firstName">First Name</option>
              <option value="lastName">Last Name</option>     
              <option value="Marriage">Marriage (1 or 0)</option>       
              <option value="Birthyear">Birthyear</option>  
          </select>
       <input type="text" name="userInputValue" />
      <button type="submit" name="Search">Search</button>     
  </form>   
 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Married</th>
                <th>Birthdate</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($listPatients as $row): ?>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="p_id" value="<?= $row['id']; ?>" />
                        <a href="editPatient.php?action=delete&p_id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this patient?')" style="text-decoration:none; color: #8B0000;")><button class="btn glyphicon glyphicon-trash" type="submit"></button></a>
                        <?php echo $row['patientFirstName']; ?>
                    </form>   
                </td>
                <td><?php echo $row['patientLastName']; ?></td> 
                <td><?php echo $row['patientMarried']; ?></td> 
                <td><?php echo $row['patientBirthDate']; ?></td> 
                <td><a href="editPatient.php?action=update&p_id=<?php echo $row['id'];?>">Update</a></td> 
                
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
       
    </div>
    </div>
</body>
</html>