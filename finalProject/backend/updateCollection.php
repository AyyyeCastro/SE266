<?php 

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  //call other files
  include_once "../include/functions.php";
  include_once "../include/header.php";
  include_once '../model/collectionBE.php';

  //if not logged in, kick them
  if (!isUserLoggedIn())
  {
    header("location: ../login.php"); 
  }



  //set new class & config
  $configFile = '../model/dbconfig.ini';
  try 
  {
    $newCollectionClass = new collectionClass($configFile);
  } 
  catch ( Exception $error ) 
  {
    echo "<h2>" . $error->getMessage() . "</h2>";
  }   


  $listCollections =[];
  $joinTables=[];

  //IF VIA $_GET
  if(isset($_GET['action']))
  {
    // declare the action variable, and store it with the action value.
    $action = filter_input(INPUT_GET, 'action');
    // Declare the $id variable and it's value. p_id is related to it's value stored in the HTML below.
    $id = filter_input(INPUT_GET, 'p_id');

    // If the user wants to update a record (the action was stored with an update, in searchCollections.php)
    if($action =="update")
    {
      // get the values, according to it's unique ID, and display it's conent into the form.
        $listCollections = $newCollectionClass->getColDetails($id);
        $row= $listCollections;
        $cName=$row['collectionName'];
        $cPub=$row['collectionPub'];
        $cCond=$row['collectionCond'];
        $cCost=$row['collectionCost'];
        $cYear = $row['collectionDate'];

        /* from collectionCount table */
        $joinTables = $newCollectionClass->getCountDetails($id);
        $joinRow = $joinTables;
        $cCount = $joinRow['countOwned'];
    }
    else
    {
        $cName ="";
        $cPub  ="";
        $cCond ="";
        $cCost ="";
        $cYear ="";
        /* from collectionCount table */
        $cCount ="";
    }
  }
  elseif(isset($_POST['action']))
  {
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'p_id');
      $cName = filter_input(INPUT_POST, 'inputName');
      $cPub  = filter_input(INPUT_POST, 'inputPub');
      $cCond = filter_input(INPUT_POST, 'inputCond');
      $cCost = filter_input(INPUT_POST, 'inputCost');
      $cYear = filter_input(INPUT_POST, 'inputDate');

      /* from collectionCount table */
      $cCount = filter_input(INPUT_POST, 'inputCount');
   }
  
   // If they click the "update" button to confirm the new changes...
  if(isPostRequest() && $action =="update")
  {
    // send the new values to the updateCollection function.
    $listCollections = $newCollectionClass->updateCollection($cName, $cPub, $cCond, $cCost, $cYear, $id);
    $result = $listCollections;


     /* from collectionCount table */
     $joinTables== $newCollectionClass->updateACount ($cCount, $id);
     $isUpdated = $joinTables;

    header('Location: searchCollections.php');
  }
?>

<!-- BEGIN HTML -->
<html lang="en">
<head>
   <title>Update Collection.</title>
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
            color: Green;
        }
        .insert{
            background-color: white;
            color: white;
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
   </style>
</head>
<body>
<div class="container">

   <h1>Updating a Collection...</h1><br>


   <form class="form-horizontal" action="updateCollection.php" method="POST">
      <input type="hidden" name="action" value="<?php echo $action; ?>">
      <input type="hidden" name="p_id" value="<?php echo $id; ?>">
   

      <div class="form-group">
      <label class="control-label col-sm-2" for="goHome" type="hidden"></label>
      <div class="col-sm-10">
         <button class="btn btn-success" name="goHome"><a href="searchCollections.php">Go Back</a></button>
      </div>
      </div>
      <br>
              
    <div class="form-group">
      <label class="control-label col-sm-2" for="inputName">Description</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName" placeholder="Enter name or description" name="inputName" value="<?php echo $cName; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputPub">Publisher</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputPub" placeholder="Enter publisher" name="inputPub" value="<?php echo $cPub; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputCond">Condition</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCond" placeholder="Enter description at time of purchase." name="inputCond" value="<?php echo $cCond; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputCost">Paid</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCost" placeholder="Enter price paid $" name="inputCost" value="<?php echo $cCost; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputDate">Bought On</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="inputDate" placeholder="Enter product release date." name="inputDate" value="<?php echo $cYear; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputCount">Amount Owned</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCount" placeholder="Enter the amount you own" name="inputCount" value="<?php echo $cCount; ?>">
      </div>
    </div> 
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"><?php echo $action; ?> the collection</button>
        <?php
            if (isPostRequest()) {
                echo $action. " sucessfull";
            }
        ?>
      </div>
    </div>
  </form>
</div>

</body>
</html>