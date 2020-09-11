<?php
try {
  $dsn = "sqlsrv:Server=DESKTOP-3URTHKV\SQLEXPRESS;Database=Clienti-Files";
  $PDOconn = new PDO($dsn, "samuele", "Msds.2021");
  $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
};


?>

