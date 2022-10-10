<?php
   function fizzBuzz($num) 
   {
      define("max", 100);

      for ($index = 1; $index <= 100; $index++){
         if($index / 2 == round($index / 2) && $index / 3 == round($index / 3)){
            echo "Fizz Buzz<br />";
         }
         else if($index / 2 == round($index / 2)){
            echo "Fizz<br />";
         }
         else if($index / 3 == round($index / 3)){
            echo "Buzz<br />";
         }
         else {
            echo $index."<br />";
         }
      }

   }

   // What is causing this error?
   // "Warning: Undefined variable $num in C:\xampp\htdocs\SE266\REPO-Folder\SE266\Week1\index5.php on line 24"
   // I read online that I can "ignore" this error, as it's just a setting I have enabled to view it?
   fizzBuzz($num)

?>