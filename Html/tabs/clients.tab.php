<?php

require (SITE_ROOT."/includes/dbhClienti.inc.php");
  $sql = "SELECT * FROM clients";
  $result = $PDOconn->query($sql);
  $clients = ($result->FetchAll());
  $_POST["clienti"]=$clients;
  ?>
