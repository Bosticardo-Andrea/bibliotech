<?php
session_start();
if (!isset($_SESSION['login'])){
  header("Location: https://bibliotech5a.netsons.org/templates/login.php");
  exit();
}
header('Content-Type: text/html; charset=utf-8');
include("./testata.php");
?>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    text-align: left;
    padding: 8px;
  }

  th {
    background-color: #007bff;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  a {
    color: red;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }
</style>
<script>
  function confermaEliminazione(libro) {
    if (confirm("Sei sicuro di voler eliminare il libro " + libro + "?")) {
      window.location.href = "./API/eliminaLibro.php?id=" + libro;
    }
  }
</script>
<?php
echo "<h1 style = color:white>Benvenuto: " . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "</h1>";
echo "<h1 style = color:white>Libri: </h1>";
$arr = libri($conn);
$rows = $arr[0];
$result = $arr[1];
echo '<div class="container">';
echo "<table>
  <tr>
    <th>id libro</th>
    <th>ISBN</th>
    <th>Titolo</th>
    <th>Trama</th>
    <th>Condizioni</th>
    <th>Stato</th>
    <th>Autore</th>
    <th>Categorie</th>
    <th>Numero di commenti</th>
    <th>Media commenti</th>
    <th>Posizione libro</th>
    <th>Eliminazione Libro</th>
  </tr>
";
if ($result->num_rows > 0) {
  foreach ($rows as $row) {
    echo "  <tr>
    <td>" . $row["Id"] . "</td>
    <td>" . $row["ISBN"] . "</td>
    <td>" . $row["Titolo"] . "</td>
    <td>" . $row["Trama"] . "</td>
    <td>" . $row["Condizioni"] . "</td>";
    if( $row["Stato"] == "0"){
      echo"<td>Libro libero</td>";
    }else{
      echo"<td>Libro occupato</td>";
    }
    echo"<td>" . $row["Autore"] . "</td>
    <td>" . $row["categorie"] . "</td>
    <td>" . $row["num_commenti"] . "</td>";
    $condizioni = intval($row["media_comm"]);
    echo "<td>" . round($condizioni,1) . "</td>
    <td>".$row["nome_pos"]."</td>
    <td><a href='javascript:confermaEliminazione(\"" . $row["Id"] . "\")'>Elimina</a>
    </td>
    </tr>";
  }
} else {
  echo "<p>Nessuna prenotazione trovata</p>";
}
echo "</table>";
echo "</div>";

if (isset($_POST['mostraForm'])) {
  echo "<html><form method='post' action='../../../libreria/API/inserisciLibro.php'>
    <input type='text' name='titolo' placeholder='Titolo' required><br>
    <input type='text' name='autore' placeholder='Autore' required><br>
    <input type='text' name='isbn' placeholder='ISBN' required><br>
    <button type='submit'>Inserisci libro</button>
    </form></html>";
} else {
  echo "<html><form method='post'>
    <input type='hidden' name='mostraForm' value='true'>
    <button type='submit'>inserisci libro</button>
    </form></html>";
}
?>