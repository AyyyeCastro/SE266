<!-- 
   Andrew Castro, 
   SE266.05 

   Patient intake form. 
-->

<?php include ('./indexVerify.php'); ?>

<!DOCTYPE html>
<html>
   <head>  
      <meta charset="UTF-8">
      <title>Castro | Patient Intake Form </title>
   </head>
   <style> 
         input{
            width: 50%;
            display: inline-block;
            float: left;}

         label{
            padding: 5px}

         #submit{
            background-color: lightgray;}
   </style> 

   <body>
         <h2>Please enter your information</h2><br>

         <?php //if the errorLog has any records ->
            if ($errorLog != ""): 
         ?>
         <!-- display the records in the errorLogs -->
         <div class="errorLogs">
            <?= $errorLog; ?>
         </div>
         <!-- close the if statement from php -->
         <?php 
            endif;
         ?>

         <!-- Patient form -->
        <form name="patient-form" action="indexHTML.php" method="POST">
  
            <label for="askFName">First name</label>
            <input type="text" name="inputFName" id="askFName" value="<?php echo $inputFName; ?>"><br><br>

            <label for="askLName">Last name</label>
            <input type="text" name="inputLName" id="askLName" value="<?php echo $inputLName; ?>"><br><br>

            <label for="askHeight">Height (meters)</label>
            <input type="float" name="inputHeight" id="askHeight" value="<?php echo $inputHeight; ?>"><br><br>

            <label for="askWeight">Weight (kilograms)</label>
            <input type="float" name="inputWeight" id="askWeight" value="<?php echo $inputWeight; ?>"><br><br>

            <label for="askBirth">Birthdate</label>
            <input type="date" name="inputBirth" id="askBirth"  value="1999-04-07"><br><br>

            <label for="askMarriage">Married</label>
            <select name="selectMarStatus" id="askMarriage" value="">
            <option value="yes">Yes</option>
            <option value="no">No</option>
            </select>
            <br><br>
            
            <input type="submit" name="submit" value="Submit" id="submit">
            <?php if ($errorLog == ""): ?>
            <div class="displayPatientInfo">
               <br><br>
               <p><?= displayAge(); ?></p>
               <p><?= displayBMI(); ?></p>
            </div>
            <?php endif; ?>
        </form>
   </body>
</html>