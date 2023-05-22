<?php
require("../conf/db_config.php");
$stmt = $conn->prepare("DELETE FROM libri WHERE id = ?");
$stmt->bind_param("s",$_GET["id"]);
$stmt->execute();
header("Location: https://bibliotech5a.netsons.org/IndexAdmin.php");
?>