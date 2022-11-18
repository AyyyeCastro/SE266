<?php

   // extend the work done in patients.php
   include_once __DIR__ . '/patientsBETA.php'; 

class userSearchClass extends PatientClass
{
      function findPatient ($fName, $lName, $marStatus, $bYear){
         $results = [];             
         $binds = [];               
         $patientDB = $this->getDatabaseRef(); 

         // start of the sql statement
         $sqlStmt =  "SELECT * FROM  patients   ";
         
         // set default value as true
         $firstInputMatch = true;

         //if the first name is not null (a value was input) ->
         if ($fName != ""){
            //if the value was a match
            if ($firstInputMatch){
               // continue sql statement.. "SELECT * FROM patients WHERE ...."
               $sqlStmt .=  " WHERE ";
               $firstInputMatch = false;
            }else{
               $sqlStmt .= " AND ";
            }
            $sqlStmt .= "  patientFirstName LIKE :fName";
            $binds['fName'] = '%'.$fName.'%';
         }
      
         //if Last name is not null ->
         if ($lName != ""){
               if ($firstInputMatch){
                  // continue sql statement.. "SELECT * FROM patients WHERE ...."
                  $sqlStmt .=  " WHERE ";
                  $firstInputMatch = false;
               }else{
                  $sqlStmt .= " AND ";
               }
               $sqlStmt .= "  patientLastName LIKE :lName";
               $binds['lName'] = '%'.$lName.'%';
         }

         if ($marStatus != ""){
            if ($firstInputMatch){
               // continue sql statement.. "SELECT * FROM patients WHERE ...."
               $sqlStmt .=  " WHERE ";
               $firstInputMatch = false;
            }else{
               $sqlStmt .= " AND ";
            }
            $sqlStmt .= "  patientMarried = :marStatus";
            $binds['marStatus'] = '%'.$marStatus.'%';
         }

         if ($bYear != ""){
            if ($firstInputMatch){
               // continue sql statement.. "SELECT * FROM patients WHERE ...."
               $sqlStmt .=  " WHERE ";
               $firstInputMatch = false;
            }else{
               $sqlStmt .= " AND ";
            }
            $sqlStmt .= "  patientBirthDate LIKE :bYear";
            $binds['bYear'] = '%'. $bYear .'%';
         }
      
         // Create query object
         $stmt = $patientDB->prepare($sqlStmt);

         // Perform query
         if ($stmt->execute($binds) && $stmt->rowCount() > 0){
               $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         
         // Return query rows (if any)
         return $results;
      } // end search teams
}

?>