<?php
session_start();
define("SITE_ROOT", "C:/xampp/htdocs/msds/fattureric/Html");
 
require (SITE_ROOT."/includes/dbh.inc.php");
$anno=$_GET["anno"];
$mese=$_GET["mese"];
// $cliente=$_GET["cliente"];
  $sql = "SELECT * FROM fatture";
  $result = $PDOconn->query($sql);
  ?>

  <table>
    <tr>
      <td>
      <lable>Diocane</lable>
      </td>
    </tr>
  </table>