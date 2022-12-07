<?php

    session_start();
    include_once __DIR__ . '/include/functions.php';
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
            header ('Location: backend/viewCollections.php');
        } 
        else 
        {
           $message = "Incorrect login credentials. Please try again. Hint: Quack quack";
        }
    }
    
?>

<!-- BEGIN HTML -->
<html lang="en">
<head>
   <title>Insert Collection</title>
   <meta charset="utf-8">
   <meta name="viewport" content="min-width=device-min-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=DotGothic16&family=IBM+Plex+Sans&family=Kanit:ital,wght@1,700&family=Press+Start+2P&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <style>
      
        body{
            /* fallback for old browsers */
            min-height: 100vh !important;
            color: black;
            font-size: 15px;
            font-family: 'DotGothic16', sans-serif;
        }
        input[type="text"], textarea {
            background-color : white; 
            color: black;
        }
        .custom-h{
            color: white;
            font-size: 35px;
        }
        .custom-text{
            font-size: 20px !important;
            color: white !important;
            
        }
        a{
            text-decoration: none;
            color: gray;
        }
        .insert{
            background-color: white;
            color: gray;
            font-size: 16px;
        }

        #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        }

        /* Add some content at the bottom of the video/page */
        .content {
        position: fixed;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        color: #f1f1f1;
        max-width: 50%;
        padding: 20px;
        }

   </style>
</head>
<body>
<div class="se-pre-con"></div>
<div class="container">
    <div id="mainDiv">

        <video autoplay muted loop id="myVideo">
            <source src="./style/vintage.mp4" type="video/mp4">
        </video>

        <form method="post" action="login.php">
        <div class="content">
            <div class="rowContainer">
                <h3 class="custom-h">Login to Access Collection...</h3>
            </div>
            <div class="rowContainer">
                <div class="col1"><p class="custom-text">User Name:</p></div>
                <div class="col2" class="custom-text"><input type="text" name="userName" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1"><p class="custom-text">Password:</p></div>
                <div class="col2"><input type="password" name="userPW" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
            </div>
        </form><br>
        
        <?php 
            if ($message)
            {   ?>
                <div class="custom-text" style="padding: 15px; margin-top: 15px; max-width: 50vw; background-color: red; border: dotted 4px darkred; font-family: 'Roboto Mono', monospace;"> 
            <?php echo $message; ?>
            </div>
            <?php } ?>
            <br>
        </div>
    </div>
</body>
</html>


    