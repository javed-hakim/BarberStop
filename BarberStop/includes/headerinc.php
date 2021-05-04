<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
    session_start(); //Keep user logged in on every page
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>BarberStop</title>
  
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat+Subrayada&family=Montserrat:wght@600&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel ="stylesheet">

  



  
</head>

<body>
  <section id="title">
    <div class="container-fluid" id="mainb">
      <div>
        <nav class="navbar bg-dark navbar-expand-lg navbar-dark">
          <a class="navbar-brand" id="maint" href="index.php">BarberStop</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <hr>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION["userid"]) && $_SESSION["type"] == "Barber"){
                    
                    echo "<li class='nav-item'>
                    <a class='nav-link'href='dashboard.php'>Dashboard</a>
                  </li>";
                  echo "<li class='nav-item'>
                    <a class='nav-link'href='includes/logout.inc.php'>Logout</a>
                  </li>";

                }
                elseif (isset($_SESSION["userid"])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link'href='profile.php'>Profile</a>
                  </li>";
                  echo "<li class='nav-item'>
                    <a class='nav-link'href='includes/logout.inc.php'>Logout</a>
                  </li>";
                  echo "<li class='nav-item'>
                  <a class='nav-link' href='book1.php'>Book A Cut</a>
                </li>";

                }
                else {
                    echo "<li class='nav-item'>
                    <a class='nav-link'href='signup.php'>Sign up</a>
                  </li>";
                  echo "<li class='nav-item'>
                    <a class='nav-link'href='login.php'>Login</a>
                  </li>";
                  echo "<li class='nav-item'>
                    <a class='nav-link'href='signupbarber.php'>Barber Signup</a>
                  </li>";
                }
                ?>
                
              
            </ul>


          </div>

        </nav>
    </div>
</section>