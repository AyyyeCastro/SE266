<!-- 
   Andrew Castro, 
   SE266.05 

   Patient intake form. 
-->

<?php 

   //////////////////////////////////////////////////////
   /////////// FORM VERIFICATION(S) //////////////////

   // if the submit button was clicked
   if (isset($_POST['submit'])){
      $inputFName = $_POST['inputFName']; 
      $inputLName = $_POST['inputLName']; 
      $inputHeight = $_POST['inputHeight']; 
      $inputWeight = $_POST['inputWeight']; 
      $inputBirth = $_POST['inputBirth']; 
      $inputMarriage = $_POST['selectMarStatus'];
   }else{
      // otherwise use default numbers
      $inputFName = "andrew" ;
      $inputLName = "Castro";
      $inputHeight = 1.63;
      $inputWeight = 53.5;  
      // $inputBirth = "1999-04-07"; // -- value woun't set via php echo in HTML...  I had to Set value via manual HTML.
      // $inputMarriage -- Marriage can't be left empty. I made it so the HTML forces a value of yes or no, via drop-down. Yes as default.
   }

   //Create an error log variable.
   $errorLog = "";

   // if (it's not a float(variable name)) -> send message to error log.
   if (!is_numeric($inputHeight)){
      $errorLog .= "<li>Height must be filled in.</li>";}
   if (!is_numeric($inputWeight)){
      $errorLog .= "<li>Weight must be filled in.</li>";}
   
   if(empty($inputFName)){  
      $errorLog .= "<li>First Name must be filled in.</li>";}
   if(empty($inputLName)){
      $errorLog .= "<li>Last Name must be filled in.</li>";}

   // if errorLog contains any errors, display it as a list ->
   if ($errorLog != ""){
      $errorLog = "<ul>$errorLog</ul>";}


   //////////////////////////////////////////////////////
   /////////// CALCULATIVE PROCESSES //////////////////

   function displayAge()
   {
      $inputFName = $_POST['inputFName']; 
      $inputLName = $_POST['inputLName']; 
      $inputHeight = $_POST['inputHeight']; 
      $inputWeight = $_POST['inputWeight']; 
      $inputBirth = $_POST['inputBirth']; 
      $inputMarriage = $_POST['selectMarStatus'];

      $tDate = date("Y-m-d");
      $diff = date_diff(date_create($inputBirth), date_create($tDate));
      echo $inputLName ."'s age is ".$diff->format('%y');
   }

   function displayBMI()
   {
      $inputFName = $_POST['inputFName']; 
      $inputLName = $_POST['inputLName']; 
      $inputHeight = $_POST['inputHeight']; 
      $inputWeight = $_POST['inputWeight']; 
      $inputBirth = $_POST['inputBirth']; 
      $inputMarriage = $_POST['selectMarStatus'];

      //BMI = Weight in kg / (Height in meters)squared
      $patientBMI = $inputWeight / pow($inputHeight, 2);
      // output -> patient's BMI is the calculation rounded to 1 decimal place.
      echo $inputLName ."'s BMI is ". round($patientBMI, 1);

      // BMI classification, according to scale.
      if ($patientBMI < 18.5){
         echo " -- Underweight";}
      if($patientBMI > 18.5 && $patientBMI < 24.9){
         echo " -- Normal weight";
      }
      if($patientBMI > 25.0 && $patientBMI < 29.9){
         echo " -- Over weight";
      }
      if($patientBMI >= 30){
         echo " -- Obese";
      }
   }
?>


<!-- The code below is what I did in Javascript, for a very similar assignment. 
      I attempted to alter it for PHP, but then I found out about the "empty" "is_numeric", etc... built in commands, and they are so much better. 
   
    In javascript I created an error logging array, and sent errors to it, when found. if it wasn't empty, the errors were displayed upon clicking submit.-->

<!-- // Get values from patient HTML form.
   $inputFName = $_POST['inputFName']; 
   $inputLName = $_POST['inputLName']; 
   $inputHeight = $_POST['inputHeight']; 
   $inputWeight = $_POST['inputWeight']; 
   $inputBirth = $_POST['inputBirth']; 
   $askMarriage = $_POST['askMarriage']; 


   //confirm if patient filled all inputs.
   function isInputFilled(){

      // create an array to store error values.
      $errorLog = [];
      // create an array to store all the input values.
      $inputLog =[];

      // verify if empty or not.
      if ($inputFName ===''){
         //log error into errorLog
         array_push($errorLog, 'First name cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputFName);
      }

      if ($inputLName ===''){
         //log error into errorLog
         array_push($errorLog, 'Last name cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputLName);
      }

      if ($inputHeight ===''){
         //log error into errorLog
         array_push($errorLog, 'Height cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputHeight);
      }


      if ($inputWeight ===''){
         //log error into errorLog
         array_push($errorLog, 'Weight cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputWeight);
      }

      if ($inputBirth ===''){
         //log error into errorLog
         array_push($errorLog, 'Birthdate cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputBirth);
      }

      if ($askMarriage ===''){
         //log error into errorLog
         array_push($errorLog, 'Maritial Status cannot be left empty');
      }else{ 
         // if not left empty, send value to the inputLog array.
         array_push($inputLog, $inputBirth);
      }

      $errorLogAmnt = count($errorLog);
      echo $errorLogAmnt;



      if($errorLogAmnt > 0)  
      {
         echo "A field(s) was left empty";
      }
   } // end function isInputFilled


   isInputFilled();

   // Call the patient HTML form.
   require('indexHTML.php'); -->