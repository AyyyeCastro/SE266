<?php
//reference connection info
$ini = parse_ini_file( __DIR__ . '/dbconfig.ini');
// var_dump($ini);
// exit;

// set PDO
$db = new PDO("mysql:host=" . $ini['servername'] . 
              ";port=" . $ini['port'] . 
              ";dbname=" . $ini['dbname'], 
              $ini['username'], 
              $ini['password']);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//ar_dump($db);
?>