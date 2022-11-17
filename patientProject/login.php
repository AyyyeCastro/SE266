<?php

    // Include helper utility functions
    include_once __DIR__ . '/include/functions.php';

    // Include user database definitions
    include_once __DIR__ . '/model/userController.php';

    // generate session.
    session_start();
    // login as false
    $_SESSION['isLoggedIn'] = false;

    /*******************************/


    $message = "";
    if (isPostRequest()) 
    {

        // get inputted form values from POST
        $userName = filter_input(INPUT_POST, 'userName');
        $PW = filter_input(INPUT_POST, 'userPW');

        // Set up configuration file and create database
        $configFile = __DIR__ . '/model/dbconfig.ini';
        try 
        {
            $userDatabase = new Users($configFile);
        } 
        catch ( Exception $error ) 
        {
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        // Now we can check to see if use credentials are valid.
        if ($userDatabase->isUserTrue($userName, $PW)) 
        {
            // If so, set logged in to TRUE
            $_SESSION['isLoggedIn'] = true;
            // Redirect to team listing page
            header ('Location: viewPatients.php');
        } 
        else 
        {
           // Whoops! Incorrect login. Tell user and stay on this page.
           $message = "You did not enter correct login credentials. 🤨";
        }
    }

?>

<div class="container">
    <h2>NFL Team Management</h2>
    <?php 
        if ($message)
        {   ?>
            <div style="background-color: yellow; padding: 10px; border: solid 1px black;"> 
           <?php echo $message; ?>
           </div>
        <?php } ?>

    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3>Please Login</h3>
            </div>
            <div class="rowContainer">
                <div class="col1">User Name:</div>
                <div class="col2"><input type="text" name="userName" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1">Password:</div>
                <div class="col2"><input type="password" name="userPW" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
            </div>
            
        </form>
        
    </div>

   