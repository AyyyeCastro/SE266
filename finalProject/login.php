<?php
    session_start();
    // Include helper utility functions
    include_once __DIR__ . '/include/functions.php';

    // Include user database definitions
    include_once __DIR__ . '/model/userController.php';

    // login as false
    $_SESSION['isLoggedIn'] = false;

    /*******************************/


    $message = "";
    if (isPostRequest()) 
    {
        $userName = filter_input(INPUT_POST, 'userName');
        $PW = filter_input(INPUT_POST, 'userPW');

        $configFile = __DIR__ . '/model/dbconfig.ini';
        try 
        {
            $userDatabase = new Users($configFile);
        } 
        catch ( Exception $error ) 
        {
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        if ($userDatabase->isUserTrue($userName, $PW)) 
        {
            $_SESSION['isLoggedIn'] = true;
            header ('Location: searchCollections.php');
        } 
        else 
        {
           $message = "Incorrect login credentials. Please try again.";
        }
    }

?>

<div class="container">
    <h1>Castro School Lookup</h1>
    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3>Instructor Login</h3>
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
        
        <?php 
            if ($message)
            {   ?>
                <div style="padding: 15px; max-width: 20vw; font: 15px; background-color: orange;  border: solid 2px black;"> 
            <?php echo $message; ?>
            </div>
            <?php } ?>
    </div>

   