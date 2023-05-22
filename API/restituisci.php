<?php
//con il require riporto il codice di connessione ad DB
require("../conf/db_configXAMPP.php");
session_start();
$stmt = $conn->prepare("UPDATE Storico SET DataRestituzione = NOW() WHERE Storico.IdL = ? AND Storico.IdU = ?");
$stmt->bind_param("ss", $_GET["id"], $_SESSION["id"]);
$stmt->execute();
echo "<h1>GRAZIE PER LA RESTITUZIONE DEL LIBRO: ".$_SESSION["nome"]."  ".$_SESSION["cognome"]."</h1>";
$stmt = $conn->prepare("UPDATE Libri SET Libri.Stato = 0 WHERE Libri.Id = ?");
$stmt->bind_param("s", $_GET["id"]);
$stmt->execute();
?>
