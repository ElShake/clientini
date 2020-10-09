<?php
try {
  $dsn = "mysql:host=localhost;dbname=clienti;charset=utf8";
  $PDOconn = new PDO($dsn, "sam", "Pollastri666");
  $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
};


?>

