<?php
   class PatientClass
   {
      //represents the DB
      private $patientData;
 
      // set the connectiontion 
      public function __construct($configFile)
      {
          if ($ini = parse_ini_file($configFile))
          {
              $patientDB = new PDO( "mysql:host=" . $ini['servername'] . 
                                  ";port=" . $ini['port'] . 
                                  ";dbname=" . $ini['dbname'], 
                                  $ini['username'], 
                                  $ini['password']);
              $patientDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
              $patientDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
              $this->patientData = $patientDB;
          }
          else
          {
              throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
          }
  
      }
      
      // get all of the all of the patient records
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


      // allow employee to insert a patient record.
      public function insertPatient($fName, $lName, $marStatus, $BD)
      {
         $isPatientAdded = false;
         $patientTable = $this->patientData;

         $stmt = $patientTable->prepare("INSERT INTO patients SET patientFirstName = :FName, patientLastName = :LName, patientMarried = :MarStatus, patientBirthDate = :bd");

         $bindParameters = array(
            ":FName" => $fName,
            ":LName" => $lName,
            ":MarStatus"=> $marStatus,
            ":bd"=> $BD
         );

         $isPatientAdded = ($stmt->execute($bindParameters) && $stmt->rowCount() > 0);

         return ($risPatientAddedesults);
      }

      // gather one patient record, where the ID is matched.
      public function getPatientRecord ($id) 
      {
         $results = [];                
         $patientTable = $this->patientData;

         $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id=:id");

         $stmt->bindValue(':id', $id);
         
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
         {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);                       
         }

         return ($results);
      }


      // update a patient's records, where the ID is a match.
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


      // delete a patient's record, where the ID is a match.
      public function deletePatient ($id) {
         $patientTable = $this->patientData;
         
         $isDeleted = false;
         $stmt = $patientTable->prepare("DELETE FROM patients WHERE id=:id");
         
         $stmt->bindValue(':id', $id);
            
         $isUpdated = ($stmt->execute() && $stmt->rowCount() > 0);
         
         return ($isDeleted);
      }

      // ref the db
      protected function getDatabaseRef()
      {
         return $this->patientData;
      }

      // clear memory
      public function __destruct() 
      {
         $this->patientData = null;
      }
   }

?>