<?php

   // extend the work done in patients.php
   include_once __DIR__ . '/schoolController.php'; 

class userSearchClass extends schoolClass
{
   public function getSelectedSchools($sName, $sCity, $sState) 
   {
       $results = array();                  // Empty results table 
       $binds = array();                    // Empty bind array
       $isFirstClause = true;               // Next WHERE clause is first
       $schoolDB = $this->getDatabaseRef();   // Alias for database PDO

       // Here is the base SQL sStatement to select all schools
       $sql = "SELECT id, schoolName, schoolCity, schoolState FROM schools ";

        // Now we check for any parameters and build the WHERE clause filters
        // First, school sName:
        if (isset($sName)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
            $sql .= " schoolName LIKE :sName";
            $binds['sName'] = '%'.$sName.'%';
        }
      
        // Next, sCity sName:
        if (isset($sCity)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
            $sql .= "  schoolCity LIKE :sCity";
           $binds['sCity'] = '%'.$sCity.'%';
       }

        // Finally, sState:
        if (isset($sState)) 
        {
            if ($isFirstClause)
            {
                $sql .= " WHERE ";
                $isFirstClause = false;
            }
            else
            {
                $sql .= " AND ";
            }
           $sql .= "  schoolState LIKE :sState";
           $binds['sState'] = '%'.$sState.'%';
       }

       // Let's sort whatever records come back
       $sql .= " ORDER BY schoolState, schoolName";
       
       // Prepare the SQL sStatement object
       $stmt = $schoolDB->prepare($sql);
      
       // Execute the query and fetch the results into a 
       // table of associative arrays
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Return the results
        return $results;
   }    // end getSelected Schools
}

?>