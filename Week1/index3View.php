<!--
    Andrew Castro
    SE266.05
-->

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title>Castro | Booleans & Conditionals </title>
</head>

<body>
   <h1>SE 266 - Booleans and Conditionals</h1>

   <ul>
      <li>
         <b>Task Name:</b>
         <!-- allows individual PHP elements. Don't need to iterate over for loop --> 
         <?= $toDo['title']; ?>
      </li>

      <li>
         <b>Due Date:</b>
         <?=$toDo['due']; ?>
      </li>

      <li>
         <b>Assigned To:</b>
         <?=$toDo['assignedTo']; ?>
      </li>

      <li>
         <b>Complete:</b>

         <?php //if the condition is true, echo the specified value.
         if($toDo['isComplete']=='true'){
            echo "✅";
         }else{
            echo "❌";
         }?>
      </li>

      <li>
         <b>Human or not? :</b>

         <?php //if the condition is true, echo the specified value.
         if($toDo['isHuman']=='true'){
            echo "👨 hi there sir";
         }else{
            echo "👽 PΉP IƧ FЦП";
         }?>
      </li>

      <li>
         <b>Finds PHP fun? :</b>

         <?php //if the condition is true, echo the specified value.
         if($toDo['isPHPfun']=='true'){
            echo "✅";
         }else{
            echo "❌";
         }?>
      </li>

   </ul>
</body>

</html>