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
            //if the value was a match
            if ($firstInputMatch){
               // continue sql statement.. "SELECT * FROM patients WHERE ...."
               $sqlStmt .=  " WHERE ";
               $firstInputMatch = false;
            }else{
               $sqlStmt .= " AND ";
            }
            $sqlStmt .= "  patientMarried LIKE :MarStatus";
            $binds['MarStatus'] = '%'.$marStatus.'%';
         }

         if ($bYear != ""){
            //if the value was a match
            if ($firstInputMatch){
               // continue sql statement.. "SELECT * FROM patients WHERE ...."
               $sqlStmt .=  " WHERE ";
               $firstInputMatch = false;
            }else{
               $sqlStmt .= " AND ";
            }
            $sqlStmt .= "  patientBirthDate LIKE :bd";
            $binds['bd'] = '%'.$bYear.'%';
         }

         $stmt = $patientDB->prepare($sqlStmt);

         if ($stmt->execute($binds) && $stmt->rowCount() > 0){
               $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         
         return $results;
      } 
}

?>