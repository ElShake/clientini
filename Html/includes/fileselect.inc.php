<?php
require(SITE_ROOT . "/includes/dbh.inc.php");
require(SITE_ROOT . "/includes/dbhlink.inc.php");
$sql = "SELECT * FROM Link WHERE RagSoc=?";
$stmt = $PDOconn->prepare($sql);
$stmt->bindParam(1, $info["RagSoc"], PDO::PARAM_STR);
$stmt->execute();

$sql = "SELECT * FROM Link";
$stmtpres = $PDOconn->prepare($sql);
$stmtpres->execute();
$pres= $stmtpres->fetchAll();
$links = $stmt->fetchAll();


