<!--
    Andrew Castro
    SE266.05
-->

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <title>Castro | Associative Array </title>
    </head>
    <body>
		<h1>SE 266 - Associative Array</h1>

      <ul>
         <?php
            //for each person within Persons array, display the key and value.
            foreach ($toDo as $taskName => $task)
            {
                echo "<li> 
                        <b>$taskName</b>
                        $task
                     </li>";
            }
         ?>
      </ul>
       
    </body>
</html>