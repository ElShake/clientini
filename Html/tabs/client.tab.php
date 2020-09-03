<?php
if (!$_SESSION){
  session_start();}
require (SITE_ROOT."/includes/dbh.inc.php");

try {
    $dsn = "mysql:host=localhost;dbname=invodb;charset=utf8";
    $PDOconn = new PDO($dsn, "sam", "Pollastri666");
    $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  $idnow=$_SESSION['userId'];
  $sql = "SELECT * FROM clientstab WHERE idUser= $idnow";
  $result = $PDOconn->query($sql);