<?php
//con il require riporto il codice di connessione ad DB
require("../conf/db_configXAMPP.php");
session_start();
$stmt = $conn->prepare("INSERT INTO Storico (idL, idU, DataPreso, DataRestituzione) VALUES (?, ?, NOW(), NULL)");
$stmt->bind_param("ss", $_GET["id"], $_SESSION["id"]);
$stmt->execute();
echo "<h1>GRAZIE PER LA TUA PRENOTAZIONE UTENTE: ".$_SESSION["nome"]."  ".$_SESSION["cognome"]."</h1>";
$stmt = $conn->prepare("UPDATE Libri INNER JOIN Storico ON Libri.Id = Storico.idL SET Libri.Stato = 1 WHERE Libri.Id = ?");
$stmt->bind_param("s", $_GET["id"]);
$stmt->execute();
?>
