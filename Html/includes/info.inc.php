<?php
if(isset ($_GET['RagSoc'])){
$RagSoc = ($_GET['RagSoc']);}
else{
    $RagSoc = ($_SESSION['RagSoc']);}

require(SITE_ROOT . "/includes/dbh.inc.php");

// $idnow=$_SESSION['userId'];
$sql = "SELECT * FROM tClienti WHERE RagSoc=?";
$stmt = $PDOconn->prepare($sql);
$stmt->bindParam(1, $RagSoc, PDO::PARAM_STR);
$stmt->execute();

$info = $stmt->fetch();
?>