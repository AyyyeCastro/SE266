<!--
    Andrew Castro
    SE266.05
-->

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <title>Castro | Animal Array </title>
    </head>
    <body>
		<h1>SE 266 - Animal Array</h1>

      <ul>
         <?php
            foreach ($animals as $animal){
                echo "<li>$animal</li>";
            }
         ?>
      </ul>
       
    </body>
</html>