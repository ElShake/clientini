<?php
if (!$_SESSION ){
  // session_start();
}
require (SITE_ROOT."/includes/dbh.inc.php");

  // $idnow=$_SESSION['userId'];
  $sql = "SELECT * FROM tClienti ORDER BY RagSoc";
  $result = $PDOconn->query($sql);