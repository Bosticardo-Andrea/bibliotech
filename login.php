<?php
session_start();//inizializza la sessione
session_unset();//svuota la sessione
session_destroy();
include("./testata.php");
?>

<link rel="stylesheet" type="text/css" href="./style/style.css">
<body>
    <h1 class="Titolo">Inserisci le tue credeziali</h1>
    <form class= "log" action="./php/logincheck.php" method="post">
  

      <div class="user" >
        <label>E-mail</label>
        <input id="Email" type="text" placeholder="E-mail" name="email" />
      </div>
      <br/>

      <div class="password">
        <label>Password</label>
        <input id="Password" type="password" placeholder="Password" name="psw" />
      </div>

      <div class="btn">
        <input class="btn-submit" type="submit" value="LOGIN" />
      </div>
    </br>
      <p align="center">Non sei ancora iscritto? <a class="Link-register"href="register.php"><b>Accedi</b></a>.</p>
      <?php 
      if (isset($_GET['msg'])){
                if ($_GET['msg']=='ERR_ACCESSO')echo "<p style=\"color: red\">Dati di accesso errati</p>";
                if ($_GET['msg']== 'ERRORE con la registrazione') echo "<p style=\"color: red\">".$_GET['msg']."</p>";
                else echo "<p style=\"color: green\">".$_GET['msg']."</p>";
      }   
      ?>
    </form>
  </body>
