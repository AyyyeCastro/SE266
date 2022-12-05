<?php
$vote = $_REQUEST['vote'];

//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$don = $array[0];
$goof = $array[1];
$mick = $array[2];

if ($vote == 0) {
  $don = $don + 1;
}
if ($vote == 1) {
  $goof = $goof + 1;
}
if ($vote == 2) {
  $mick = $mick + 1;
}

//insert votes to txt file
$insertvote = $don."||".$goof."||".$mick;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>

<h2>Result:</h2>
<table>
<tr>
  <td>DONALD: </td>
  <td><?php echo(" ".$don);?>
  </td>
</tr>

<tr>
  <td>MICKY: </td>
  <td>
    <?php echo(" ".$mick);?>
  </td>
</tr>

<tr>
  <td>GOOFY: </td>
  <td><?php echo(" ".$goof);?>
  </td>
</tr>
</table>