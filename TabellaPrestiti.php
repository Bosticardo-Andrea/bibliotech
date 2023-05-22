<?php
session_start();
include("./testata.php"); //navbar
?>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
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
        window.location.href = "../../../libreria/API/eliminaLibro.php?id=" + libro;
    }
}
</script>
<?php
$arr = stampaStorico($conn);
$rows = $arr[0];
$result = $arr[1];
echo '<div class="container">';
echo "<table>
  <tr>
    <th>id libro</th>
    <th>ISBN</th>
    <th>Titolo</th>
    <th>nome</th>
    <th>cognome</th>
    <th>data di prestito</th>
    <th>data di Restituzione</th>
  </tr>
";
if ($result->num_rows > 0) {
  foreach($rows as $row){
    echo " <tr>
    <td>".$row["Id"]."</td>
    <td>".$row["ISBN"]."</td>
    <td>".$row["Titolo"]."</td>
    <td>".$row["Nome"]."</td>
    <td>".$row["Cognome"]."</td>
    <td>".$row["DataPreso"]."</td>";
    if ($row["DataRestituzione"] == "0000-00-00") {
        echo "<td> In attesa di restituzione</td>";
      } else {
        echo "<td>" . $row["DataRestituzione"] . "</td>";
      }
    echo "</td>
    </tr>";
  }
} else {
  echo "<p>Nessuna prenotazione trovata</p>";
}
echo "</table>";
echo "</div>";
?>