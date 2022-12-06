<?php

class Users
{
    private $userData;

    // Used to salt user password
    const saltPW = "saltedPW";


    public function __construct($configFile) 
    {
        // Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configFile))
        {
            // Create PHP Database Object
            $userDB = new PDO( "mysql:host=" . $ini['servername'] . 
                                ";port=" . $ini['port'] . 
                                ";dbname=" . $ini['dbname'], 
                                $ini['username'], 
                                $ini['password']);

            $userDB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $userDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->userData = $userDB;
        }
        else
        {
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }
    } 

    // Pull ALL user data.
    public function getUsers() 
    {
        $userTable = $this->userData;
        $results = [];                  // Array to hold results

    //  $stmt = $db->prepare("SELECT id, userName, userPW, userSalt FROM userTable ORDER BY id"); 
        
    //  if ($stmt->execute() && $stmt->rowCount() >0){
    //      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //  }       
    
       return ($results);
    }
    
    // SIGN UP the user, and insert info into DB with hashed Password.
    public function userSignup($user, $PW) 
    {
        // user not yet added, so is false. 
        $isUserAdded = false;    
        // set variable userDB to for the DB PDO.      
        $userTable = $this->userData; 
        //set the amnt of salt 
        $salt = random_bytes(32); 

        $stmt = $userTable->prepare("INSERT INTO userTable SET userName = :uName, userPW = :uPW, userSalt = :uSalt");

        $bindParameters = array(
            ":uName" => $user,
            ":uPW" => sha1($salt . $PW),
            ":uSalt" => $salt
        );       
        
        $isUserAdded = ($stmt->execute($bindParameters) && $stmt->rowCount() > 0);

         return ($isUserAdded);
    }
   

    // DELETE user record.
    public function userDelete ($id) 
    {
        $isUserDeleted = false;     
        $userTable = $this->userData; 

        return ($isUserDeleted);
    }
    public function getDatabaseRef()
    {
        return $this->userData;
    }
 
   // pull ONE user record.
    public function getUserRecord($id) 
    {
        $results = [];                  
        $userTable = $this->userData;
    
        // Preparing SQL query 
        //    id is used to ensure we delete correct record
    //    $stmt = $db->prepare("SELECT id, userName, userPW, userSalt FROM userTable WHERE id=:id");
    
         // Bind query parameter to method parameter value
    //     $stmt->bindValue(':id', $id);
       
         // Execute query and check to see if rows were returned 
    //     if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
    //     {
            // if successful, grab the first row returned
    //        $results = $stmt->fetch(PDO::FETCH_ASSOC);                       
    //    }
    
        return ($results);
    }


    // Ensure user entered correct login details.
    public function isUserTrue($userName, $PW)
    {
        $isUserTrue = false;
        $userTable = $this->userData;

        $stmt = $userTable->prepare("SELECT userPW, userSalt FROM userTable WHERE userName =:userName");
 
        $stmt->bindValue(':userName', $userName);

        $ifUserFound = ($stmt->execute() && $stmt->rowCount() > 0);

        if ($ifUserFound)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC); 
            $hashPW = sha1( $results['userSalt'] . $PW);
            $isUserTrue = ($hashPW == $results['userPW']);
        }
        return $isUserTrue;
    }

}
?>