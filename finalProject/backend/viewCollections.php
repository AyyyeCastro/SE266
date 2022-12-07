<?php

    include_once "root.php";
    include_once $root."/include/functions.php";
    include_once $root."/include/header.php";
    include_once $root."/model/userSearch.php";

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }
    
    $configFile = $root.'/model/dbconfig.ini';
    try 
    {
        $newUserSearchClass = new userSearchClass($configFile);
        $newCollectionClass = new collectionClass($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    $listCollection =[];
    $joinTables=[];
    $joinTables2=[];
    $deleteList=[];
    if (isPostRequest()) 
    {
      $listCollection = $newUserSearchClass->getAllCollections();
      $joinTables = $newUserSearchClass->getAllCounts();
      $joinTables2 = $newUserSearchClass->joinTables();
   
    }
    else
    {
        $listCollection = $newUserSearchClass->getAllCollections();
        $joinTables = $newUserSearchClass->getAllCounts();
        $joinTables2 = $newUserSearchClass->joinTables();
    }

    if (isPostRequest()) 
    {
        if (isset($_POST["delete"]))
        {
            $id = filter_input(INPUT_POST, 'p_id');
            $deleteList = $newCollectionClass->deleteCollection($id);
            header('Location: searchCollections.php');
        }  
    }
?>
<!-- END PHP -->



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
    <form method="post" action="searchCollections.php">
    <div class="container">
        <!-- title -->
        <h1>Viewing Your Records...</h1><br>

        <!-- Buttons -->
        <div class="rowContainer">
            <div class="col1"><br></div>
            <div class="col2">
                <a href="./searchCollections.php"><input type="button" name="refresh" value="Manage Inventory" class="btn btn-warning"></a>
            </div> 
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <th>Amount Owned</th>
            <th>Game</th>
        </thead>
        <tbody>
        <?php foreach ($joinTables2 as $row): ?>
            <tr>  
               <td> <?php echo $row['countOwned']; ?> </td>
               <td> <?php echo $row['collectionName']; ?></td>
        </tbody>
        <?php endforeach; ?>
    </table>


    
</body>
</html>

<?php
    include_once $root."/include/footer.php";
?>

