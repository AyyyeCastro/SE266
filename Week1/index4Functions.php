<!--
    Andrew Castro
    SE266.05
-->

<?php
   // Accepts some paremters (3) & dumps em to page
//    function dd($data){  // you're dumping some 'kind' of data. Call it anything relevant.
//     echo '<pre>';

//     die(var_dump($data));

//     echo '</pre>';
//  };

    // check if age >= 21.
    function isAllowed(){
        // echo $_GET['inputAge'];  checking if input value was gathered.

        // $inputAge (new var) = get (form method) value from input type where name = inputAge
        $inputAge = $_GET['inputAge'];

        // if over 21 one show first echo, if not display else.
        if ($inputAge >= "21"){
        echo "Welcome to the D&D night club.";
        } 
        else{
        echo "You are not 21 or older. Leave or else...";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <title>Castro | D&D Club </title>
    </head>
    <body>
        <!-- create form and ask for age -->
        <form name="form" action="" method="get">
            <label for="askAge">How old are you?</label>
            <input type="number" name="inputAge" id="askAge">
            <input type="submit" name="submit" value="Submit">
        </form>

        <br><br>
        <p>
            <h2> Result: </h2>
            <!-- display function result -->
            <?php isAllowed() ?>
        </p>
    </body>
</html>
