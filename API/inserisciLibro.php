<?php
//con il require riporto il codice di connessione ad DB
require("../conf/db_config.php");
session_start();
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("INSERT INTO Libri VALUES (NULL,?,?,?,?,?,0,?)");
$stmt->bind_param("ssssss", $_POST['ISBN'], $_POST['Titolo'],$_POST['Trama'],$_POST['Condizioni'],$_POST['NPagine'],$_POST['Stato'],$_POST['idPosizione'],);

$stmt->execute();
$conn->close();
header("location: ../templates/home.php");
?>