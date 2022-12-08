<?php

    // reference files
    include_once "../include/functions.php";
    include_once "../include/header.php";
    include_once "../model/userSearch.php";

    //if not logged in, kick them
    if (!isUserLoggedIn())
    {
    header("location: ../login.php"); 
    }

    // set new classes to call functions
    $configFile = '../model/dbconfig.ini';
    try 
    {
        $newUserSearchClass = new userSearchClass($configFile);
        $newCollectionClass = new collectionClass($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    // define arrays to hold info
    $listCollection =[];
    $joinTables2=[];
    if (isPostRequest()) 
    {
      $listCollection = $newUserSearchClass->getAllCollections();
      $joinTables2 = $newUserSearchClass->joinTables();
   
    }
    else
    {
        $listCollection = $newUserSearchClass->getAllCollections();
        $joinTables2 = $newUserSearchClass->joinTables();
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
                <a href="./searchCollections.php"><input type="button" name="refresh" value="Edit Collections" class="btn btn-warning"></a>
                <!-- Insert a new collection -->
                <a href="./insertCollection.php"><input type="button" name="refresh" value="Insert New Collection" class="btn btn-primary"></a>
            </div> 
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <th>Amount Owned</th>
            <th>Collection</th>
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
    include_once "../include/footer.php";
?>

