<?php
//con il require riporto il codice di connessione ad DB
session_start();
require("../conf/db_configXAMPP.php");
//PROCEDURA ESEGUIRE QUERY (rimando al materiale presente su classroom)
function salvaFile($id){
    $err = "";
    $target_dir = "C:/xampp/htdocs/matura/img/"; // cartella di destinazione per il file caricato
    $extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); // estensione del file
    $target_file = $target_dir . $id . "." . $extension; // nome del file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Il file " . $id . "." . $extension . " è stato caricato con successo.";
    } else {
        $err= "Spiacente, c'è stato un errore durante il caricamento del tuo file.";
    }
    return $err;
}
//controllo che il file inserito rispetti i parametri 
function controlloFile(){
    $err = "";
    $extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); // estensione del file
    $allowed_extensions = array("jpg"); // estensioni consentite
    if (!in_array($extension, $allowed_extensions)) { // controlla se l'estensione è consentita
        $err= "Spiacente, solo le immagini JPG sono consentite.";
    }
    return $err;
}
$err = "ERRORE con la registrazione, campo vuoto";
if (empty($_POST['NomeEvento'])){
    header("location: ../templates/aggiungiEvento2.php?err=".$err."");
}else{
    $nome = $_POST['NomeEvento'];
    $stmt = $conn->prepare("INSERT INTO libro VALUES (NULL,?,?,?,?,?)");
    $stmt->bind_param("sssss", $nome , $_POST['Data'],$_POST['NomeProvincia'],$_POST['NomeCategoria'],$_SESSION["id"]);
    if(isset($_FILES["fileToUpload"]["name"])) {
        $ris = controlloFile();
        if(!empty($ris)){
            header("location: ../templates/aggiungiEvento2.php?err=".$ris."");
        }
    }
    if ($stmt->execute()){
        $nome = $_POST['NomeEvento'];

        $stmt = $conn->prepare("SELECT libro.idLibro FROM libro WHERE libro.NomeEvento = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id = $row['idLibro'];
        $stmt = $conn->prepare("INSERT INTO artisti_partecipanti VALUES (?,?)");
        $stmt->bind_param("ss",$_POST['NomeArtista'],$id);
        $stmt->execute();
        $conn->close();
        if(isset($_FILES["fileToUpload"]["name"])) {
            $ris = salvaFile($id);
            if(empty($ris)){
            header("location: ../templates/evento.php?id=".$id."");
            }
        }
    }else{
        $conn->close();
        header("location: ../templates/aggiungiEvento2.php?err=".$err."");
    }
}
