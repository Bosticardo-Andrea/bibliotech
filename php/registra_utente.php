<?php
//con il require riporto il codice di connessione ad DB
require("../conf/db_configXAMPP.php");

//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su clasroom)
$stmt = $conn->prepare("INSERT INTO utenti VALUES (NULL,?,?,?,?,'0')");
$stmt->bind_param("ssss", $_POST['Nome'], $_POST['Cognome'],$_POST['Email'],$_POST['Password']);

if ($stmt->execute()){
    header("location: ../templates/login.php?msg=Ti sei registrato, ora puoi accededere");
}else{
    header("location: ../templates/login.php?msg=ERRORE con la registrazione");
}

$conn->close();
?>