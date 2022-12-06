<?php 
   //call other files
   include_once "root.php";
   include_once $root."/include/functions.php";
   include_once $root."/include/header.php";
   include_once $root.'/model/collectionBE.php';


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

   // if via get method 
   if(isset($_GET['action'])){
      $action = filter_input(INPUT_GET, 'action');
      $id = filter_input(INPUT_GET, 'p_id');
      if($action =="update"){
         $listCollections = $newCollectionClass->getColDetails($id);
         $row= $listCollections;
         $cName=$row['collectionName'];
         $cPub=$row['collectionPub'];
         $cCond=$row['collectionCond'];
         $cCost=$row['collectionCost'];
         $cYear = $row['collectionDate'];
      }else{
         $cName ="";
         $cPub  ="";
         $cCond ="";
         $cCost ="";
         $cYear ="";
      }

   }elseif(isset($_POST['action'])){
      $action = filter_input(INPUT_POST, 'action');
      $id = filter_input(INPUT_POST, 'p_id');
      $cName = filter_input(INPUT_POST, 'inputName');
      $cPub  = filter_input(INPUT_POST, 'inputPub');
      $cCond = filter_input(INPUT_POST, 'inputCond');
      $cCost = filter_input(INPUT_POST, 'inputCost');
      $cYear = filter_input(INPUT_POST, 'inputDate');
   }

   // depending on the action, execute a specific function from model/patients.php
  if(isPostRequest() && $action =="update"){
      $listCollections = $newCollectionClass->updateCollection($cName, $cPub, $cCond, $cCost, $cYear, $id);
      $result = $listCollections;
      header('Location: searchCollections.php');
   }elseif (isPostRequest() && $action =="delete"){
     $id = filter_input(INPUT_POST, 'p_id');
     $listCollections = $newCollectionClass->deleteCollection($id);
     $isDeleted = $listCollections;
     header('Location: searchCollections.php');
   }   
?>

<html lang="en">
<head>
  <title>Patient Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

   <h2><?php echo $action." patient"?></h1><br>
   <br />
   <div class="col-sm-offset-1 col-sm-10">
      <p><a href="./searchCollections.php">View Current Patients</a></p>
   </div>
   <br />

   <form class="form-horizontal" action="updateCollection.php" method="POST">
      <input type="hidden" name="action" value="<?php echo $action; ?>">
      <input type="hidden" name="p_id" value="<?php echo $id; ?>">
   


              
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
      <label class="control-label col-sm-2" for="inputCost">Cost</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputCost" placeholder="Enter price paid $" name="inputCost" value="<?php echo $cCost; ?>">
      </div>
    </div> 

    <div class="form-group">
      <label class="control-label col-sm-2" for="inputDate">Released</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" id="inputDate" placeholder="Enter product release date." name="inputDate" value="<?php echo $cYear; ?>">
      </div>
    </div> 
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?php echo $action; ?> the collection</button>
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