<html lang="en">
<head>
  <title>View Patient Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
      body{
         font-size: 15px;
      }
   </style>
</head>
<body>
   <div class="rowContainer">
      <div class="col1">
         <br>
         &nbsp; <a href="./upload.php"><input type="button" name="refresh" value="Back to Upload" class="btn btn-info"></a>
         <br><br>
      </div>
   </div>
</body>
</html>   

<?php
   include_once __DIR__ . "/include/functions.php";
   
   if (!isUserLoggedIn())
   {
      header ('Location: login.php');
   }
   // Define max number of lines to read in for testing
   define ("MAX_SCHOOLS", 10);
   echo "<p> </p>";

   // First check if file exists (always do this!)
   if (!file_exists("upload/schools.csv")) 
   {
      echo "<p>File does not exist</p>";
      exit;
   }

   // display user uploaded CSV from the uploads folder.
   echo "<html><body><table>\n\n";
   $schoolFileRef = fopen("upload/schools.csv", "rb");
   while (($line = fgetcsv($schoolFileRef)) !== false) {
         echo "<tr>";
         foreach ($line as $cell) {
                  echo "<td>" . htmlspecialchars($cell) . "</td>";
         }
         echo "</tr>\n";
   }
   fclose($schoolFileRef);
   echo "\n</table></body></html>";
?>

