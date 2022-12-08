<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //reference the files
    include_once "../include/functions.php";
    include_once "../include/header.php";
    include_once "../model/userSearch.php";

    //if not logged in, kick them
    if (!isUserLoggedIn())
    {
        header("location: ../login.php"); 
    }

    // call the class & db connection
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

    //Arrays to store info 
    $listCollection =[];
    $deleteList=[];
    if (isPostRequest()) 
    {
        // if they clicked the search button ->
        if (isset($_POST["search"]))
        {
            // declare the variables to nothing first...
            $cName="";
            $cPub="";
            $cCond="";
            $cCost="";
            $cYear="";
            $cCount="";


            //... have the user's input (from form below) allign with the declared variables. 
            $cName = $_POST['inputName'];
            $cPub = $_POST['inputPub'];
            $cCond = $_POST['inputCond'];
            $cCost = $_POST['inputCost'];
            $cYear = $_POST['inputYear'];

            // have the array (declared above) store the info, and send it to the findOneCollection function.
            $listCollection = $newUserSearchClass->findOneCollection($cName, $cPub, $cCond, $cCost, $cYear);
        }
        else
        {
            //Otherwise gather all records.
            $listCollection = $newUserSearchClass->getAllCollections();
        }
    }
    else
    {
        //Otherwise gather all records.
        $listCollection = $newUserSearchClass->getAllCollections();
    }

    // if they clicked the delete button, delete the record w/ delete function.
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
   <title>Search Collection</title>
   <meta charset="utf-8">
   <meta name="viewport" content="min-width=device-min-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <!-- import Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=DotGothic16&family=IBM+Plex+Sans&family=Kanit:ital,wght@1,700&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
   <!-- import Font Awesome Icons -->
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <!-- Start css -->
   <style>
        body
        {
            /* fallback for old browsers */
            min-height: 100vh !important;
            color: Green;
            font-size: 20px;
            font-family: 'DotGothic16', sans-serif !important;
            background: black !important;
        }
        /* changes the input text/form styling */
        input[type="text"],textarea 
        {
            background-color : white; 
            color: black;
        }
        h1
        {
            font-size: 35px;
        }
        a
        {
            text-decoration: none;
            color: Green;
        }
        /* a class for some of the button */
        .insert
        {
            background-color: white;
            color: white;
            font-size: 16px;
        }
        table
        {
            color: black;
            background-color: white;
            opacity: 85%;
            width: 100% !important;
            border-collapse: collapse;
            border: 5px dotted green;
        }
        footer
        {
            color: white;
        }
        table
        {
            color: black;
            background-color: white;
            opacity: 95%;
            m-width: 100vw;
            border-collapse: collapse;
            border: 2px solid black;
        }
        footer
        {
            color: white;
        }
        th,td 
        {
            padding: 5px;
        }
   </style>
    <!-- END css -->
</head>
<!-- begin body -->
<body>
    <form method="post" action="searchCollections.php">
    <div class="container">
        <!-- title -->
        <h1>Search Your Collections...</h1><br><hr>

        <!-- Php with HTML in it. This will gather the users input, and then relay their search valus back to them -->
            <?php 
                if (isPostRequest()){
                    if (isset($_POST["search"])){
                    echo "<h3>Filters applied:</h3>". "Name: <div style='background-color: gray; color: white;'> ". $cName ."</div> Publisher:<div style='background-color: gray; color: white;'>". $cPub ."</div>  Condition:  <div style='background-color: gray; color: white;'>". $cCond ."</div>  Cost:  <div style='background-color: gray; color: white;'>". $cCost ."</div>  Year:  <div style='background-color: gray; color: white;'>". $cYear ."</div><hr><br/>"; 
                    }
                }
            ?>

        <!-- Input values & labels, which get sent to the variables we declared in PHP -->
        <div class="row">
            <div class="col-xs-4">
                <div class="col1">Name:</div>
                <!-- For every user/search input, there is an if statement tied to the value. If the user input something for it's criteria, 
                it will HOLD the value into the input box,  until the user chooses to reset the filter. This is ANOTHER way of displaying 
                to the user what they're filtering. --> 
                <div class="col2"><input type="text" name="inputName" value=<?php if (isPostRequest()){if (isset($_POST["search"])){echo $cName;}} ?>></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Publisher:</div>
                <div class="col2"><input type="text" name="inputPub" value=<?php if (isPostRequest()){if (isset($_POST["search"])){echo $cPub;}} ?>></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Condition:</div>
                <div class="col2"><input type="text" name="inputCond" value=<?php if (isPostRequest()){if (isset($_POST["search"])){echo $cCond;}} ?>></div><br>
            </div>

            <div class="col-xs-4">
                <div class="col1">Paid:</div>
                <div class="col2"><input type="text" name="inputCost" value=<?php if (isPostRequest()){if (isset($_POST["search"])){echo $cCost;}} ?>></div> 
            </div>

            <div class="col-xs-4">
                <div class="col1">Bought On:</div>
                <div class="col2"><input type="text" name="inputYear" value=<?php if (isPostRequest()){if (isset($_POST["search"])){echo $cYear;}} ?>></div> 
            </div>
        </div>
        <!-- Buttons -->
        <div class="rowContainer"><br>
            <div class="col1"></div>
            <div class="col2">
                <!-- Search with criteria entered -->
                <input type="submit" name="search" value="Search" class="btn btn-primary"> 
                <!-- Reset the search filter -->
                <a href="./searchCollections.php"><input type="button" name="refresh" value="Reset Filter" class="btn btn-success"></a>
                <!-- Insert a new collection -->
                <a href="./insertCollection.php"><input type="button" name="refresh" value="Insert New Collection" class="btn btn-primary"></a>
                <!-- Go back to the simple viewing page -->
                <a href="./viewCollections.php"><input type="button" name="refresh" value="Back to View" class="btn btn-success"></a>
            </div> 
        </div>
    </form>
    <br>
    <!-- BEGIN TABLE -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Description</th>
                <th>Publisher</th>
                <th>Condition</th>
                <th>Paid</th>
                <th>Bought On</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- For every value stored in the array we declared in the PHP section -->
        <?php foreach ($listCollection as $row): ?>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="p_id" value="<?= $row['collectionID']; ?>" />
                        <input type="submit" class="btn btn-warning" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this collection?')"> 
                    </form>   
                </td>
                <!-- Display it's value -->
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
        <!-- END for-loop -->
        </tbody>
    </table>
    <!-- END TABLE -->
</body>
 <!-- END BODY -->
</html>

<!-- CALL THE FOOTER -->
<?php
    include_once "../include/footer.php";
?>

