<!--
    Andrew Castro
    SE266.05
-->

<?php

   // create an associative array. Key => value;
   $toDo =[
      "Title:" => " Week 1.2 Assignment",
      "Due:" => " Before next class",
      "Assigned to:" => " Andrew Castro",
      "Complete:" => " True",
   ];

   //insert another pair into the associative array.
   $toDo +=["BonusTask" => "yes"];

   // reference HTML
   require('index2View.php');
?>