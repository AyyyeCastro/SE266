<?php
   include_once __DIR__ . "/model/schoolController.php";
   include_once __DIR__ . "/include/functions.php";
   if (!isUserLoggedIn())
   {
       header ('Location: login.php');
   }

   define ("UPLOAD_DIRECTORY", "upload");


   if (isset ($_FILES['fileToUpload'])) 
   {   
      $path = getcwd() . DIRECTORY_SEPARATOR . UPLOAD_DIRECTORY;
      $targetFilename = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];
      $tmpName = $_FILES['fileToUpload']['tmp_name'];
      move_uploaded_file($tmpName, $targetFilename);
   }


   include_once __DIR__ . "/include/header.php";
?>

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
   <div class="container">

      </div>
         <div class="rowContainer">
            <h2>Upload File</h2>
            <p>
               Please specify a file to upload and then be patient as the upload may take a while to process.
            </p>

            <form action="upload.php" method="post" enctype="multipart/form-data">
               <input type="file" name="fileToUpload" accept=".csv" required>
               <input type="submit" value="Upload">
            </form> 

            <br><br>
            <div class="col1">
               <a href="./schoolSearch.php"><input type="button" name="refresh" value="View Current Records" class="btn btn-info"></a>
               <a href="./fileController.php"><input type="button" name="refresh" value="Verify .CSV Contents" class="btn btn-info"></a>
            </div> 
         </div> 
      </div> 
   </div>
</body>
</html>

<?php 
   if (isset ($_FILES['fileToUpload'])) {
      echo "<br><h2>File Submitted!</h2><br><br/>";
      
     // echo "<b>for dev testing</b><br/>";
     // echo "<b>temp name:</b> ".$tmpName ."<br/>";
     // echo "<b>target file name:</b> ".$targetFilename."<br/>";
     // echo "<b>file path:</b> ".$path."<br/>";s
   }

   include_once __DIR__ . "/include/footer.php";
?>


