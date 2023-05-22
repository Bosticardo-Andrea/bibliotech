<form action="./index.php" method="post">
  <div class="wrapper">
    <?php
    echo 'Filtri <label for="Categoria"></label><input type="text" id="Categoria" name="Categoria" list="Categorialist" placeholder="Categoria"><datalist id="Categorialist">';
    $stmt = $conn->prepare("SELECT * FROM categorie");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row){
      echo "<option value=".$row['NomeCategoria'].">";
    }
    
    echo"</datalist>";
    echo '<label for="citta"></label><input type="text" id="citta" name="citta" list="citylist" placeholder="Cittá"><datalist id="citylist">';
    $stmt = $conn->prepare("SELECT * FROM provincie");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row){
      echo "<option value=".$row['NomeProvincia'].">";
    }
    echo"</datalist>";
    ?>
     <input class="btn-submit1" type="submit" value="esegui" />
  </div>
</form>
