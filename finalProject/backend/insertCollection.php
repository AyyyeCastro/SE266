<?php
  //call other files
  include_once "../include/functions.php";
  include_once "../include/header.php";
  include_once '../model/collectionBE.php';

  //if not logged in, send the to login.
  if(!isset($_SESSION["isLoggedIn"]))
  { 
    header("location: C:/xampp/htdocs/SE266/REPO-Folder/SE266/finalProject/login.php"); 
  }

  //if not logged in, kick them
  if (!isUserLoggedIn())
  {
    header("location: ../login.php"); 
  }

  // declare new class & config.
   $configFile = '../model/dbconfig.ini';
   try 
   {
      $newCollectionClass = new collectionClass($configFile);
   } 
   catch ( Exception $error ) 
   {
      echo "<h2>" . $error->getMessage() . "</h2>";
   }   

   // array to store values, and variables that are getting sent their inputed values. 
  $listCollections =[];
  if (isPostRequest()) {
    $cName = filter_input(INPUT_POST, 'inputName');
    $cPub = filter_input(INPUT_POST, 'inputPub');
    $cCond = filter_input(INPUT_POST, 'inputCond');
    $cCost = filter_input(INPUT_POST, 'inputCost');
    $cYear = filter_input(INPUT_POST, 'inputYear');
    //send it to the insertCollection function.
    $listCollections = $newCollectionClass->insertCollection($cName, $cPub, $cCond, $cCost, $cYear);
    

    //once done, redicrect back there.
    header('Location: searchCollections.php');
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
   <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=DotGothic16&family=IBM+Plex+Sans&family=Kanit:ital,wght@1,700&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <style>
      
        body{
            /* fallback for old browsers */
            min-height: 100vh !important;
            color: Green;
            font-size: 20px;
            font-family: 'DotGothic16', sans-serif !important;

            background: black !important;
        }
        input[type="text"], textarea {
            background-color : white; 
            color: black;
        }
        h1{
            font-size: 35px;
        }
        a{
            text-decoration: none;
            color: white;
        }
        .insert{
            background-color: darkblue;
            color: black;
            font-size: 16px;
        }

        table{
            color: black;
            background-color: white;
            opacity: 88%;
            width: 100% !important;
            border-collapse: collapse;
            border: 5px dotted green;
        }
        footer{
            color: white;
        }
        table{
            color: black;
            background-color: white;
            opacity: 95%;
            table-layout: fixed;
            m-width: 100vw;
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

        .custom-fText{
         background-color: gray;
         color: white;
         padding: 5px;
         border: 4px dotted green;
        }
   </style>
</head>
<body>
<div class="container">

   <form class="form-horizontal" action="insertCollection.php" method="post">
      
   <h2>Creating a Collection...</h2>
   <br><br><br>

   <div class="form-group">
      <label class="control-label col-sm-2" for="goHome" type="hidden"></label>
      <div class="col-sm-10">
         <button class="btn btn-success" name="goHome"><a href="searchCollections.php">Go Back</a></button>
      </div>
   </div>
   <br>
      
   <div class="form-group">
      <label class="control-label col-sm-2" for="inputName"><p class="custom-fText">Description:</p></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName" placeholder="Enter description" name="inputName">
      </div>
   </div>

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputPub"><p class="custom-fText">Publisher</p></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPub" placeholder="Enter Publisher" name="inputPub">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputCond"><p class="custom-fText">Condition</p></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCond" placeholder="Condition bought (used, new, etc)" name="inputCond">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputCost"><p class="custom-fText">Cost</p></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCost" placeholder="Amount Paid $" name="inputCost">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputYear"><p class="custom-fText">Date Purchased</p></label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="inputYear" placeholder="" name="inputYear">
      </div>
   </div> 
   <br>
       
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary insert">Submit</button>
        <?php
            if (isPostRequest()) {
                echo "Patient sucessfully Updated";
            }
        ?>
      </div>
    </div>
  </form>
  
</div>

</body>
</html>