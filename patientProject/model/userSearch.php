<?php

include_once __DIR__ . '/patients.php'; 


    function findPatient ($fName, $lName){
        $results = [];             
        $binds = [];               
        global $db; 

        $sqlQuery =  "SELECT * FROM  patients   ";
        
        $isFNameMatch = true;
        // If team is set, append team query and bind parameter
        if ($fName != ""){
            if ($isFNameMatch){
                $sqlQuery .=  " WHERE ";
                $isFNameMatch = false;
            }else{
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientFirstName LIKE :fName";
            $binds['fName'] = '%'.$fName.'%';
        }
    
        // If division is set, append team query and bind parameter
        if ($lName != ""){
            if ($isFNameMatch){
                $sqlQuery .=  " WHERE ";
                $isFNameMatch = false;
            }else{
                $sqlQuery .= " AND ";
            }
            $sqlQuery .= "  patientLastName LIKE :lName";
            $binds['division'] = '%'.$lName.'%';
        }
    
        // Create query object
        $stmt = $db->prepare($sqlQuery);

        // Perform query
        if ($stmt->execute($binds) && $stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return query rows (if any)
        return $results;
    } // end search teams
}

?>