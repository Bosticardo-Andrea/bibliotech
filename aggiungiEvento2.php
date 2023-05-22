<?php
include("./testata.php");
?>   
<link rel="stylesheet" type="text/css" href="../style/style.css">
  <body>
    <div class="container">
      <div class="box">
        <h1>Aggiungi un evento</h1>
        <form action="../php/registra_evento2.php" method="post" enctype="multipart/form-data">
          <?php
          if(isset($_GET["err"])){
            if ($_GET['err'])echo "<p style=\"color: red\">".$_GET['err']."</p>";
          }
          ?>
          <label for="NomeEvento">NomeEvento:</label>
          <input type="text" id="NomeEvento" name="NomeEvento"><br><br>

          <label for="Data">Data:</label>
          <input type="date" id="Data" name="Data"><br><br>
          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data_inserita = $_POST['Data'];
            $data_odierna = date('Y-m-d');
            if ($data_inserita > $data_odierna) {
              echo '<p>La data inserita è maggiore della data odierna.</p>';
            } else {
              echo '<p>La data inserita non è maggiore della data odierna.</p>';
            }
          }
          ?>

          <?php
                $stmt = $conn->prepare("SELECT * FROM provincie");
                $stmt->execute();
                $result = $stmt->get_result();
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                echo '<label for="NomeProvincia">Seleziona una città:</label>
                <select id="NomeProvincia" name="NomeProvincia" required>';
                echo "<option value= ' '> </option>";
                foreach($rows as $row){
                    echo "<option value=".$row['IdProvincia'].">".$row['NomeProvincia']."</option>";
                }
                echo "</select></br></br>";
                $stmt = $conn->prepare("SELECT * FROM categorie");
                $stmt->execute();
                $result = $stmt->get_result();
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                echo '<label for="NomeCategoria">Seleziona una categoria:</label>
                <select id="NomeCategoria" name="NomeCategoria" required>';
                echo "<option value= ' '> </option>";
                foreach($rows as $row){
                    echo "<option value=".$row['IdCategoria'].">".$row['NomeCategoria']."</option>";
                }
                echo "</select></br></br>";
                $stmt = $conn->prepare("SELECT * FROM artisti");
                $stmt->execute();
                $result = $stmt->get_result();
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                echo '<label for="NomeArtista">Seleziona un artista:</label>
                <select id="NomeArtista" name="NomeArtista" required>';
                echo "<option value= ' '> </option>";
                foreach($rows as $row){
                    echo "<option value=".$row['IdArtista'].">".$row['Alias']."</option>";
                }
                echo "</select>";
                $conn->close();
            ?>
            <div class="btn">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input class="btn-submit" type="submit" value="AGGIUNGI EVENTO" />
            </div>
        </form>
      </div>
    </div>
