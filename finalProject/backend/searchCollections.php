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
    $deleteList=[];
    if (isPostRequest()) 
    {
        if (isset($_POST["search"]))
        {
            $cName="";
            $cPub="";
            $cCond="";
            $cCost="";
            $cYear="";
            $cCount="";

            $cName = $_POST['inputName'];
            $cPub = $_POST['inputPub'];
            $cCond = $_POST['inputCond'];
            $cCost = $_POST['inputCost'];
            $cYear = $_POST['inputYear'];

            $listCollection = $newUserSearchClass->findOneCollection($cName, $cPub, $cCond, $cCost, $cYear);
        }
        else
        {
            $listCollection = $newUserSearchClass->getAllCollections();
            $joinTables = $newUserSearchClass->getAllCounts();
        }
    }
    else
    {
        $listCollection = $newUserSearchClass->getAllCollections();
        $joinTables = $newUserSearchClass->getAllCounts();
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
    <form method="post" action="searchCollections.php">
    <div class="container">
        <!-- title -->
        <h1>Search Your Collections...</h1><br><hr>
        <!-- Input values & labels -->
        <div class="row">
            <div class="col-xs-4">
                <div class="col1">Name:</div>
                <div class="col2"><input type="text" name="inputName"></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Publisher:</div>
                <div class="col2"><input type="text" name="inputPub"></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Condition:</div>
                <div class="col2"><input type="text" name="inputCond"></div><br>
            </div>

            <div class="col-xs-4">
                <div class="col1">Cost:</div>
                <div class="col2"><input type="text" name="inputCost"></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Year:</div>
                <div class="col2"><input type="text" name="inputYear"></div> 
            </div>
        </div>
        <!-- Buttons -->
        <div class="rowContainer"><br>
            <div class="col1"></div>
            <div class="col2">
                <input type="submit" name="search" value="Search" class="btn btn-primary"> 
                <a href="./searchCollections.php"><input type="button" name="refresh" value="Reset Filter" class="btn btn-success"></a>
                <a href="./insertCollection.php"><input type="button" name="refresh" value="Insert New Collection" class="btn btn-primary"></a>
                <a href="./viewCollections.php"><input type="button" name="refresh" value="Back to View" class="btn btn-success"></a>
            </div> 
            <hr>
            <?php 
                if (isPostRequest()) 
                {
                    if (isset($_POST["search"]))
                    {
                    echo "<h4>Filters applied:</h4>". "<b>Name:</b>&nbsp&nbsp&nbsp". $cName ."&nbsp&nbsp&nbsp <b>Publisher:</b>&nbsp&nbsp&nbsp". $cPub ."<b>&nbsp&nbsp&nbsp Condition:<b> &nbsp&nbsp&nbsp". $cCond ."&nbsp&nbsp&nbsp <b>Cost:</b> &nbsp&nbsp&nbsp". $cCost ."&nbsp&nbsp&nbsp <b>Year:</b> &nbsp&nbsp&nbsp". $cYear; 
                    }
                }?>
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Description</th>
                <th>Publisher</th>
                <th>Purchase Condition</th>
                <th>Cost</th>
                <th>Released</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($listCollection as $row): ?>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="p_id" value="<?= $row['collectionID']; ?>" />
                        <input type="submit" class="btn btn-warning" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this collection?')"> 
                    </form>   
                </td>
                <td><?php echo $row['collectionName']; ?></td>
                <td><?php echo $row['collectionPub']; ?></td> 
                <td><?php echo $row['collectionCond']; ?></td>
                <td><?php echo $row['collectionCost']; ?></td> 
                <td><?php echo $row['collectionDate']; ?></td> 
                <td>
                    <a href="updateCollection.php?action=update&p_id=<?php echo $row['collectionID'];?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
    include_once $root."/include/footer.php";
?>

