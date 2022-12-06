<?php

   // extend the work done in patients.php
   include_once __DIR__ . '/collectionBE.php'; 

class userSearchClass extends collectionClass
{
   public function findOneCollection($cName, $cPub, $cCond, $cCost, $cYear) 
   {
       $results = array();                  // Empty results table 
       $binds = array();                    // Empty bind array
       $isFirstClause = true;               // Next WHERE clause is first
       $schoolDB = $this->getDatabaseRef();   // Alias for database PDO

       // Here is the base SQL cCondment to select all schools
       $sql = "SELECT collectionID, collectionName, collectionPub, collectionCond, collectionCost, collectionDate FROM collectionstable ";

        // Now we check for any parameters and build the WHERE clause filters
        // First, school cName:
        if (isset($cName)) 
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
            $sql .= " collectionName LIKE :cName";
            $binds['cName'] = '%'.$cName.'%';
        }
      
        // Next, cPub cName:
        if (isset($cPub)) 
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
            $sql .= "  collectionPub LIKE :cPub";
           $binds['cPub'] = '%'.$cPub.'%';
       }

        // Finally, cCond:
        if (isset($cCond)) 
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
           $sql .= "  collectionCond LIKE :cCond";
           $binds['cCond'] = '%'.$cCond.'%';
       }

       if (isset($cCost)) 
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
          $sql .= "  collectionCost LIKE :cCost";
          $binds['cCost'] = '%'.$cCost.'%';
      }

      if (isset($cYear)) 
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
         $sql .= "  collectionDate LIKE :cYear";
         $binds['cYear'] = '%'.$cYear.'%';
     }

       // Let's sort whatever records come back
       $sql .= " ORDER BY collectionDate";
       
       // Prepare the SQL cCondment object
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