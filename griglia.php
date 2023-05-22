<link rel="stylesheet" type="text/css" href="./style/styleGriglia.css">
<?php
if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
  if (strpos($_POST['search'], ",") !== false){
    $separata = explode(",",$_POST['search']);
    $bookN = $separata[0];
    $author = $separata[1];
    $arr = CreaGrigliaIndex($conn,$bookN,$author);
  }else{
    $arr = CreaGrigliaIndex($conn,$_POST['search'],null);
  }
}else{
  $arr = CreaGrigliaIndex($conn,null,null);
}
  $rows = $arr[0];
  $result = $arr[1];
  echo '<div class="container">';
  if ($result->num_rows > 0) {
    foreach ($rows as $row) {
      echo "<div class='col-md-4'>
            <b><a href = ./libro.php?id=" . urldecode($row['Id']) . ">" . $row['Titolo'] . "</a></b>";       
      echo '<img src="./img/' . $row['Id'] . '.jpg" alt="Foto Mancante" style="width: 200px; height: 200px;"></br>';
      echo "<p>Numero di Pagine:" . $row['NPagine'] . "</p>
            <p>Tipologia:" . $row['categorie'] . "</p>";
            echo "<p>Autore:" . $row['Autore'] . "</p>";
            if($row['Stato'] == "1"){
              echo("<p>Stato: Libero </p>");
            }else{
              echo("<p>Stato: Preso</p>");
            }
            echo "</div>";
    }
  } else {
    echo "<p>Nessun libro trovato</p>";
  }
echo "</div>\n";
?>