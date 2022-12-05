<?php
   class schoolClass
   {
      //represents the DB
      private $schoolData;
      
      // set DB insert limit. 
      const MAX_INSERT_ROWS = 1000;
 
      // set the connectiontion 
      public function __construct($configFile)
      {
          if ($ini = parse_ini_file($configFile))
          {
              $schoolPDO = new PDO( "mysql:host=" . $ini['servername'] . 
                                  ";port=" . $ini['port'] . 
                                  ";dbname=" . $ini['dbname'], 
                                  $ini['username'], 
                                  $ini['password']);
              $schoolPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
              $schoolPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
              $this->schoolData = $schoolPDO;
          }
          else
          {
              throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
          }
  
      }

      public function insertSchoolsFromFile($fileName) 
      {
          $insertSucessful = false;           // file records are not added at this point
          $schoolTable = $this->schoolData;   // Alias for database PDO
          $schoolCounter = 0;                 // Counter for rows read from file
         
          // We only proceed if the file exists
          if (file_exists($fileName))
          {
              // Clear current records in table so there are no duplicates
              $this->deleteAllSchools();
  
              // Open file 
              $schoolFileRef = fopen($fileName, 'rb');
  

              // ignore first line (CSV header row) by loading and not using it
              $row = fgetcsv($schoolFileRef);
  
              $schoolCounter = 0;
              // Loop through entire file
              while (!feof($schoolFileRef)) 
              {
                  // Get a row from the CSV file
                  $row = fgetcsv($schoolFileRef);
  
                  // Convert any special character in the fields into HTML characters
                  $school = str_replace("'", "''", htmlspecialchars($row[0]));
                  $city = str_replace("'", "''", htmlspecialchars($row[1]));
                  $state = str_replace("'", "''", htmlspecialchars($row[2]));
  
                  // Create the string of values for the INSERT
                  $schoolToInsert = "('" . $school . "' , '" . $city . "' , '" . $state. "')";
  
                  // This if-statement is here to filter the number of records added to the database
                  // When testing, you may not want to add *all* records for time's sake
                  if ($schoolCounter++ % self::MAX_INSERT_ROWS == 0) 
                  {
                      // Add the school to the database
                     $schoolTable->query("INSERT INTO schools (schoolName, schoolCity, schoolState) VALUES ". $schoolToInsert);
                  }
              }
   
              // All done, for security reasons, close and delete the CSV file
             fclose($schoolFileRef);
             unlink($fileName);
          }
          return $insertSucessful;
      } // end insertSchools from File


      public function deleteAllSchools() 
      {
              $deleteSucessful = false;           // Team not updated at this point
              $schoolTable = $this->schoolData;   // Alias for database PDO
  
              // Preparing SQL query    
              $deleteSucessful = $schoolTable->query("DELETE FROM schools;");
  
              // Execute query and check to see if rows were returned 
              // If so, the schools were successfully deleted      
             // $deleteSucessful = ($stmt->execute() && $stmt->rowCount() > 0);
  
              // Return status to client           
              return $deleteSucessful;
      }

      public function getSchoolCount() 
      {
           $schoolTable = $this->schoolData;   // Alias for database PDO
   
           // Build SQL query, notice we alias the count result so we can access it
           $stmt = $schoolTable->query("SELECT COUNT(*) AS schoolCount FROM schools");
   
           // Grab the results into an associative array
           $results = $stmt->fetch(PDO::FETCH_ASSOC);   
           
           // return the count of schools in DB
           return $results['schoolCount'];
      } // end getSchoolCount

      public function getAllSchools() 
      {
         $results = [];                  
         $schoolTable = $this->schoolData;

         $stmt = $schoolTable->prepare("SELECT id, schoolName, schoolCity, schoolState FROM schools ORDER BY id"); 
         
         if ($stmt->execute() && $stmt->rowCount() >0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }       

         return ($results);
      }
     

      // ref the db
      protected function getDatabaseRef()
      {
         return $this->schoolData;
      }

      // clear memory
      public function __destruct() 
      {
         $this->schoolData = null;
      }
   }

?>