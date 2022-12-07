<?php

   // extend the work done in patients.php
   include_once __DIR__ . '/collectionBE.php'; 

class userSearchClass extends collectionClass
{
   public function findOneCollection($cName, $cPub, $cCond, $cCost, $cYear) 
   {
       $results = array();                  
       $binds = array();                    
       $isFirstClause = true;              
       $schoolDB = $this->getDatabaseRef();   


       $sql = "SELECT collectionID, collectionName, collectionPub, collectionCond, collectionCost, collectionDate FROM collectionstable ";

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

        $sql .= " ORDER BY collectionID";
       
        $stmt = $schoolDB->prepare($sql);
      
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        return $results;
   }   
}


