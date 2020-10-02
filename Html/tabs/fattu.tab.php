<?php
session_start();
define("SITE_ROOT", "C:/xampp/htdocs/msds/fattureric/Html");
 
require (SITE_ROOT."/includes/dbh.inc.php");

  // $idnow=$_SESSION['userId'];
  $sql = "SELECT * FROM tClienti ORDER BY RagSoc";
  $result = $PDOconn->query($sql);