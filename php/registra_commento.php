<?php
//con il require riporto il codice di connessione ad DB
require("../conf/db_configXAMPP.php");
session_start();
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
$stmt = $conn->prepare("INSERT INTO commento VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $_POST['Commento'], $_POST['Valutazione'],$_POST['id'],$_SESSION["id"]);

if ($stmt->execute()){
    header("location: ../templates/evento.php?id=".$_POST['id']."");
}else{
    header("location: ../templates/login.php?msg=ERRORE con la registrazione");
}

$conn->close();
?>