<?php

    include_once __DIR__ . "/model/schoolController.php";
    include_once __DIR__ . "/include/functions.php";
    include_once __DIR__ . "/include/header.php";
    include_once __DIR__ . '/model/userSearch.php';

    if (!isUserLoggedIn())
    {
        header ('Location: login.php');
    }
    

    $configFile = __DIR__ . '/model/dbconfig.ini';
    try 
    {
        $schoolDatabase = new userSearchClass($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    
    $listSchools =[];
    if (isPostRequest()) 
    {
        if (isset($_POST["search"]))
        {
            $sName="";
            $sCity="";
            $sState="";

            $sName = $_POST['schoolName'];
            $sCity = $_POST['city'];
            $sState = $_POST['state'];

            $listSchools = $schoolDatabase->getSelectedSchools($sName, $sCity, $sState);
        }
        else
        {
            $listSchools = $schoolDatabase->getAllSchools();
        }
    }
    else
    {
        $listSchools = $schoolDatabase->getAllSchools();
    }
?>

    <h2>Search Institutions</h2>
    <form method="post" action="schoolSearch.php">
        <div class="rowContainer">
            <div class="col1">Name:</div>
            <div class="col2"><input type="text" name="schoolName"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="city"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="state"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2">
                <input type="submit" name="search" value="Search" class="btn btn-warning"> 
                <a href="./schoolSearch.php"><input type="button" name="refresh" value="View All" class="btn btn-info"></a>
                <a href="./upload.php"><input type="button" name="refresh" value="Insert .CSV" class="btn btn-danger"></a>
            </div> 
        </div>
    </form>
    <br><br>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>School Name</th>
                <th>School City</th>
                <th>School State</th>
            </tr>
        </thead>
        <tbody>
      
        <?php foreach ($listSchools as $row): ?>
            <tr>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="p_id" value="<?= $row['id']; ?>" />
                        <?php echo $row['schoolName']; ?>
                    </form>   
                </td>
                <td><?php echo $row['schoolCity']; ?></td> 
                <td><?php echo $row['schoolState']; ?></td> 
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
            
    <?php
        include_once __DIR__ . "/include/footer.php";
    ?>

