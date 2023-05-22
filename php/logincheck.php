<?php
require("../conf/db_configXAMPP.php");
include("../conf/query.php");
$row = loginCheck($conn,$_POST['psw'],$_POST['email']);
if (($_POST['email']==$row['Email'])&&($_POST['psw']==$row['Psw'])){
    session_start();
    $_SESSION['login']='ok';
    $_SESSION['nome']=$row['Nome'];
    $_SESSION['cognome']=$row['Cognome']; 
    $_SESSION['id']=$row['Id'];
    $_SESSION['type']=$row['Tipo'];
    if ($row['Tipo'] == "1")
    header("Location: ../IndexAdmin.php");
    else
    header("Location: ../index.php");
}else{
    header("location: ../login.php?msg=ERR_ACCESSO");
} 


?>