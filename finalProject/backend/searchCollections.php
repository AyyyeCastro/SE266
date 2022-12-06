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
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    $listCollection =[];
    if (isPostRequest()) 
    {
        if (isset($_POST["search"]))
        {
            $cName="";
            $cPub="";
            $cCond="";
            $cCost="";
            $cYear="";

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
        }
    }
    else
    {
        $listCollection = $newUserSearchClass->getAllCollections();
    }
?>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <form method="post" action="searchCollections.php">
    <div class="container">
        <!-- title -->
        <h1>Your Collections</h1><br>

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
        <div class="rowContainer">
            <div class="col1"><br></div>
            <div class="col2">
                <input type="submit" name="search" value="Search" class="btn btn-warning"> 
                <a href="./searchCollections.php"><input type="button" name="refresh" value="View All" class="btn btn-info"></a>
                <a href="./insertCollection.php"><input type="button" name="refresh" value="New Collection" class="btn btn-danger"></a>
            </div> 
        </div>

    </form>
    <br>



    <table class="table table-striped">
        <thead>
            <tr>
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
                        <a href="updateCollection.php?action=delete&p_id=<?php echo $row['collectionID'];?>" onclick="return confirm('Are you sure you want to delete this collection?')" style="text-decoration:none;")><button class="far fa-trash-alt" type="submit"></button></a>
                        <?php echo $row['collectionName']; ?>
                    </form>   
                </td>
                <td><?php echo $row['collectionPub']; ?></td> 
                <td><?php echo $row['collectionCond']; ?></td>
                <td><?php echo $row['collectionCost']; ?></td> 
                <td><?php echo $row['collectionDate']; ?></td> 
                <td><a href="updateCollection.php?action=update&p_id=<?php echo $row['collectionID'];?>"><i class='fas fa-edit' style='font-size:18px'></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
            
    <?php
        include_once $root."/include/footer.php";
    ?>

