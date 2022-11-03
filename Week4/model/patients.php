<?php

// model for PATIENTS

//call db.php file
include(__DIR__ .'/db.php');

function getPatients() 
{
    $results = [];                  
    global $db;  

    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY patientLastName"); 
    
    if ($stmt->execute() && $stmt->rowCount() >0){
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   }       

   return ($results);
}


/// INSERT ///
function insertPatient($fName, $lName, $marStatus, $BD)
{
   global $db;

   $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :FName, patientLastName = :LName, patientMarried = :MarStatus, patientBirthDate = :bd");

   // set the sql statements to what is passed into the variables
   $bindParameters = array(
      ":FName" => $fName,
      ":LName" => $lName,
      ":MarStatus"=> $marStatus,
      ":bd"=> $BD
   );

   //var_dump($bindParameters);

   if($stmt->execute($bindParameters) && $stmt->rowCount() >0){
      $results = 'Patient Record Added';
   }

   return ($results);
}


/// UPDATE ///
function updatePatient ($id, $fName, $lName, $marStatus, $BD) {
   global $db;

   $results = [];

   $stmt = $db->prepare("UPDATE patients SET patientFirstName = :FName, patientLastName = :LName, patientMarried = :MarStatus, patientBirthDate = :bd WHERE id=:id");
   
   $bindParameters = array(
      ":id" => $id,
      ":FName" => $fName,
      ":LName" => $lName,
      ":MarStatus"=> $marStatus,
      ":bd"=> $BD
   );


   if($stmt->execute($bindParameters) && $stmt->rowCount() >0){
      $results = 'Patient Record Updated';
   }
   
   return ($results);
}


/// DELETE ///
function deletePatient ($id) {
   global $db;
   
   $results = "Patient Records NOT deleted";
   $stmt = $db->prepare("DELETE FROM patients WHERE id=:id");
   
   $stmt->bindValue(':id', $id);
       
   if ($stmt->execute() && $stmt->rowCount() > 0) {
      $results = 'Data Deleted';
  }
   
   return ($results);
}

//$result = insertPatient('Andrew', 'Castro', 0,'04-07-1999');
$patientData = getPatients();


?>