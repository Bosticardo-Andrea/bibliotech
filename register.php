<?php
require("./testata.php");
?>   
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <title>Registrazione</title>
    <script>
        function validateForm() {
          var email = document.getElementById("email").value;
          var password = document.getElementById("password").value;
  
          if (!email.includes("@")) {
            alert("L'indirizzo email deve contenere la @");
            return false;
          }
  
          if (password.length < 8 || !/[A-Z]/.test(password) || !/[@#$%^&+=]/.test(password)) {
            alert("La password deve essere piu' lunga di 8 caratteri e contenere almeno una maiuscola e un carattere speciale (@#$%^&+=)");
            return false;
          }
  
          return true;
        }
      </script>
  <body>
    <h1 class='Titolo'>Registrazione Utente</h1>
    <form class='log' action="../php/registra_utente.php" method="post" onsubmit="return validateForm();">

      <label for="nome">Nome:</label>
      <input type="text" id="Nome" name="Nome" required placeholder="Nome"><br><br>

      <label for="cognome">Cognome:</label>
      <input type="text" id="Cognome" name="Cognome" required placeholder="Cognome"><br><br>

      <label for="email">Email:</label>
      <input type="text" id="Email" name="Email" required placeholder="Email"><br><br>

      <label for="password">Password:</label>
      <input type="password" id="Password" name="Password" required placeholder="Password"><br><br>

      <label for="natoil">Data di nascita:</label>  
      <br>
      <input type="date" id="NatoIl" name="NatoIl" required><br><br>

      <div class="btn">
        <input class="btn-submit" type="submit" value="REGISTRATI" />
      </div>

    </form>
  </body>
<?php
require("./footer.php");
?>