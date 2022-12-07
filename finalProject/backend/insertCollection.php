<?php

  //call other files
  include_once "root.php";
  include_once $root."/include/functions.php";
  include_once $root."/include/header.php";
  include_once $root.'/model/collectionBE.php';


  if(!isset($_SESSION["isLoggedIn"]))
  { 
    header("location: login.php"); 
  }


   $configFile = $root.'/model/dbconfig.ini';
   try 
   {
      $newCollectionClass = new collectionClass($configFile);
   } 
   catch ( Exception $error ) 
   {
      echo "<h2>" . $error->getMessage() . "</h2>";
   }   


  $listCollections =[];
  if (isPostRequest()) {
    $cName = filter_input(INPUT_POST, 'inputName');
    $cPub = filter_input(INPUT_POST, 'inputPub');
    $cCond = filter_input(INPUT_POST, 'inputCond');
    $cCost = filter_input(INPUT_POST, 'inputCost');
    $cYear = filter_input(INPUT_POST, 'inputYear');
    $listCollections = $newCollectionClass->insertCollection($cName, $cPub, $cCond, $cCost, $cYear);

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
   <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=IBM+Plex+Sans&display=swap" rel="stylesheet">
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <style>
      
        body{
            /* fallback for old browsers */
            min-height: 100vh !important;
            color: white;
            font-size: 15px;
            font-family: 'Chakra Petch', sans-serif;

            background: #213461;
            background-image: url('https://static.vecteezy.com/system/resources/previews/002/915/061/original/blue-abstract-background-free-vector.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover; 
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
            background-color: white;
            color: gray;
            font-size: 16px;
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
   </style>
</head>
<body>
<div class="container">

   <form class="form-horizontal" action="insertCollection.php" method="post">
      
   <h2>Create a New Collection</h2>
   <br><br><br>

   <div class="form-group">
      <label class="control-label col-sm-2" for="goHome" type="hidden"></label>
      <div class="col-sm-10">
         <button class="btn btn-success" name="goHome"><a href="searchCollections.php">Go Back</a></button>
      </div>
   </div>
   <br>
      
   <div class="form-group">
      <label class="control-label col-sm-2" for="inputName">Description:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName" placeholder="Enter description" name="inputName">
      </div>
   </div>

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputPub">Publisher</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPub" placeholder="Enter Publisher" name="inputPub">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputCond">Condition</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCond" placeholder="Condition bought (used, new, etc)" name="inputCond">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputCost">Cost</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCost" placeholder="Amount Paid $" name="inputCost">
      </div>
   </div> 

   <div class="form-group">
      <label class="control-label col-sm-2" for="inputYear">Date Purchased</label>
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