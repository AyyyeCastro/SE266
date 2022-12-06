<?php

  //call other files
  include_once "root.php";
  include_once $root."/include/functions.php";
  include_once $root."/include/header.php";
  include_once $root.'/model/collectionBE.php';


  if(!isset($_SESSION["isLoggedIn"]))
  { 
    header("location:login.php"); 
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
    
<html lang="en">
<head>
  <title>Insert Collection</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

   <h1>Insert Collection</h1>

   <br />
   <div class="col-sm-offset-1 col-sm-10">
      <p><a href="./searchCollections.php">View Current Collections</a></p>
   </div>
   <br />


  <form class="form-horizontal" action="insertCollection.php" method="post">
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
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Insert The Collection</button>
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