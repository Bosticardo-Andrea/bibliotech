<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <style>
    .btn {
      /* center all elements */
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }

    .btn-submit1 {
      background-color: rgb(0, 115, 255);
      color: white;
      border-radius: 5px;
      width: 60px;
      height: 30px;
      transition: background-color 0.2s ease-in-out;
      justify-content: center;
      align-items: center;
    }

    .btn-submit1:hover {
      background-color: rgb(0, 90, 200);
    }
    body {
      background-image: linear-gradient(to right, #0010bd, #64d8f9);
      font-family: Arial, sans-serif;
    }
    img {
  display: block;
  width: 100%;
  height: auto;
  object-fit: cover;
  object-position: center;
} -->

  </style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <?php
  require("./conf/query.php");
  require("./conf/db_configXAMPP.php");
  if (isset($_SESSION['login'])){
    if($_SESSION['type'] == "1"){
        echo '<a class="navbar-brand" href="./IndexAdmin.php">libreria</a>';
      }
    }else{
      echo '<a class="navbar-brand" href="./index.php">libreria</a>';
    }
    ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
      if (isset($_SESSION['login'])){
        if ($_SESSION['type'] == "1"){
          echo "<li class='nav-item'> <a class='nav-link' href='./IndexAdmin.php'>HOME</a><span class='sr-only'>(current)</span></a></li>";
          echo "<li class='nav-item'> <a class='nav-link' href='./login.php'>LOGOUT</a></li>";
          echo "<li class='nav-item'> <a class='nav-link' href='./TabellaPrestiti.php'>PRESTITI</a></li>";
        }else{
          echo "<li class='nav-item'> <a class='nav-link' href='./index.php'>HOME</a><span class='sr-only'>(current)</span></a></li>";
          echo "<li class='nav-item'> <a class='nav-link' href='./login.php'>LOGOUT</a></li>";
        }
      }else {
        echo "<li class='nav-item'> <a class='nav-link' href='./index.php'>HOME</a><span class='sr-only'>(current)</span></a></li>";
        echo "<li class='nav-item'> <a class='nav-link' href='./login.php'>LOGIN</a></li>";
        echo "<li class='nav-item'> <a class='nav-link' href='./register.php'>REGISTRATI</a></li>";
      }
      ?>
    </ul> 
    <form class="form-inline my-2 my-lg-0" action="./index.php" method="post">
        <input class="form-control mr-sm-2" type="search" placeholder="book,author " aria-label="Search" id="search" name="search" >
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
