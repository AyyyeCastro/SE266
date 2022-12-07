<?php

    session_start();
    include_once __DIR__ . '/include/functions.php';
    include_once __DIR__ . '/model/userController.php';
    include_once __DIR__ . '/include/header.php';

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
            header ('Location: backend/searchCollections.php');
        } 
        else 
        {
           $message = "Incorrect login credentials. Please try again.";
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
   <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=IBM+Plex+Sans&family=Kanit:ital,wght@1,700&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <style>
      
        body{
            /* fallback for old browsers */
            min-height: 100vh !important;
            color: black;
            font-size: 15px;
            font-family: 'Chakra Petch', sans-serif;

            background: #213461;
            background-image: url('https://static.vecteezy.com/system/resources/previews/002/915/061/original/blue-abstract-background-free-vector.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover; 
            cursor: grab;
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

        table{
            color: black;
            background-color: white;
            opacity: 95%;
            width: 100% !important;
            border-collapse: collapse;
            border: 2px solid black;
        }
        footer{
            color: white;
        }

        th,
        td {
            padding: 5px;
        }
   </style>
</head>
<body>
<div class="se-pre-con"></div>
<div class="container">
    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3 class="custom-h">Login to Access Collection...</h3><hr>
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
        </form>
        
        <?php 
            if ($message)
            {   ?>
                <div class="custom-text" style="padding: 15px; margin-top: 15px; max-width: 20vw; font: 12px; background-color: red;  border: solid 4px black; font-family: 'Roboto Mono', monospace;"> 
            <?php echo $message; ?>
            </div>
            <?php } ?>
    </div>
</body>
</html>

<?php     include_once __DIR__ . '/include/footer.php'; ?>

   