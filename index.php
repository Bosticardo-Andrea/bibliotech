<?php
session_start();
include("./testata.php"); //navbar
if (isset($_SESSION['login'])) echo "<h1 style = color:white>Benvenuto ".$_SESSION["nome"]." ".$_SESSION["cognome"]."</h1>,";
echo "</br>";
include("./griglia.php");
include("./footer.php");
?>