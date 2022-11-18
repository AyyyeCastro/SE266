<?php

   // extend the work done in patients.php
   include_once __DIR__ . '/patientsBETA.php'; 

class userSearchClass extends PatientClass
{
      function findPatient ($fName, $lName){
         $results = [];             
         $binds = [];               
         $patientDB = $this->getDatabaseRef(); 

         $sqlStmt =  "SELECT * FROM  patients   ";
         
         $isFNameMatch = true;
         // If team is set, append team query and bind parameter
         if ($fName != ""){
               if ($isFNameMatch){
                  $sqlStmt .=  " WHERE ";
                  $isFNameMatch = false;
               }else{
                  $sqlStmt .= " AND ";
               }
               $sqlStmt .= "  patientFirstName LIKE :FName";
               $binds['fName'] = '%'.$fName.'%';
         }
      
         // If division is set, append team query and bind parameter
         if ($lName != ""){
               if ($isFNameMatch){
                  $sqlStmt .=  " WHERE ";
                  $isFNameMatch = false;
               }else{
                  $sqlStmt .= " AND ";
               }
               $sqlStmt .= "  patientLastName LIKE :LName";
               $binds['lName'] = '%'.$lName.'%';
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