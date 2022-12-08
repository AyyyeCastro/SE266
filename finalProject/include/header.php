<?php
  // This should already be loaded, but just in case
  include_once __DIR__ . '/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Geek Records</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;1,700&family=DotGothic16&family=IBM+Plex+Sans&family=Kanit:ital,wght@1,700&family=Press+Start+2P&family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
      .navbar-custom {
        background-color: #101B33;
      }
      .subtext{
        font-size: 15px !important;
      }
      .navbar-brand
      {
        font-family: 'Press Start 2P', cursive;
        margin-top: -10px !important;
        color: white !important;
        font-size: 25px !important;
        padding: 55px !important;
      }
      a{
        text-decoration: none;
      }
    </style>
</head>
<body>
  <nav class="navbar  navbar-custom">
    <div class="container-fluid">
      <div class="navbar-header">
        <span class="navbar-brand nav-text">Geek Records <p class="subtext" style="padding: 5px";>since 1978</p></span>
      </div>
      <?php
        if (isUserLoggedIn()) 
        { ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./../logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
            <?php
        } 
      // end logout button code   
      ?>
    </div>
  </nav>


  

