<?php
   class PatientClass
   {
      private $patientData;
 
      public function __construct($configFile)
      {
          // Parse config file, throw exception if it fails
          if ($ini = parse_ini_file($configFile))
          {
              // Create PHP Database Object
              $patientDB = new PDO( "mysql:host=" . $ini['servername'] . 
                                  ";port=" . $ini['port'] . 
                                  ";dbname=" . $ini['dbname'], 
                                  $ini['username'], 
                                  $ini['password']);
  
              // Don't emulate (pre-compile) prepare statements
              $patientDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
              // Throw exceptions if there is a database error
              $patientDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
              //Set our database to be the newly created PDO
              $this->patientData = $patientDB;
          }
          else
          {
              // Things didn't go well, throw exception!
              throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
          }
  
      } // end constructor
      
      
      //call db.php file
      //include(__DIR__ .'/db.php');

      public function getPatients() 
      {
         $results = [];                  
         $patientTable = $this->patientData;

         $stmt = $patientTable->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY id"); 
         
         if ($stmt->execute() && $stmt->rowCount() >0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }       

         return ($results);
      }


      /// INSERT ///
      public function insertPatient($fName, $lName, $marStatus, $BD)
      {
         $isPatientAdded = false;
         $patientTable = $this->patientData;

         $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :FName, patientLastName = :LName, patientMarried = :MarStatus, patientBirthDate = :bd");

         // set the sql statements to what is passed into the variables
         $bindParameters = array(
            ":FName" => $fName,
            ":LName" => $lName,
            ":MarStatus"=> $marStatus,
            ":bd"=> $BD
         );

         //var_dump($bindParameters);

         $isPatientAdded = ($stmt->execute($bindParameters) && $stmt->rowCount() > 0);

         return ($risPatientAddedesults);
      }

      public function getPatientRecord ($id) 
      {
         $results = [];                  // Array to hold results
         $patientTable = $this->patientData;

         // Preparing SQL query 
         //    id is used to ensure we delete correct record
         $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:id");

         // Bind query parameter to method parameter value
         $stmt->bindValue(':id', $id);
         
         // Execute query and check to see if rows were returned 
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
         {
            // if successful, grab the first row returned
            $results = $stmt->fetch(PDO::FETCH_ASSOC);                       
         }

         // Return results to client
         return ($results);
      }


      /// UPDATE ///
      public function updatePatient ($id, $fName, $lName, $marStatus, $BD){

         $isUpdated = false;
         $patientTable = $this->patientData;

         $stmt = $patientTable->prepare("UPDATE patients SET patientFirstName = :FName, patientLastName = :LName, patientMarried = :MarStatus, patientBirthDate = :bd WHERE id=:id");
         
         $stmt->bindValue(":id", $id);
         $stmt->bindValue(":FName", $fName);
         $stmt->bindValue(":LName", $lName);
         $stmt->bindValue(":MarStatus", $marStatus);
         $stmt->bindValue(":bd", $BD);

         $isUpdated = ($stmt->execute() && $stmt->rowCount() > 0);

         
         return ($isUpdated);
      }


      /// DELETE ///
      public function deletePatient ($id) {
         $patientTable = $this->patientData;
         
         $isDeleted = false;
         $stmt = $patientTable->prepare("DELETE FROM patients WHERE id=:id");
         
         $stmt->bindValue(':id', $id);
            
         $isUpdated = ($stmt->execute() && $stmt->rowCount() > 0);
         
         return ($isDeleted);
      }

      protected function getDatabaseRef()
      {
         return $this->patientData;
      }

      // Destructor to clean up any memory allocation
      public function __destruct() 
      {
         // Mark the PDO for deletion
         $this->patientData = null;
      }

      //$result = insertPatient('Andrew', 'Castro', 0,'04-07-1999');
     // $patientData = getPatients();
   }

?>