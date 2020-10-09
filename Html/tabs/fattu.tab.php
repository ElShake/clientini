<?php
session_start();
define("SITE_ROOT", "C:/xampp/htdocs/msds/fattureric/Html");

require(SITE_ROOT . "/includes/dbh.inc.php");
$anno = $_GET["anno"];
$mese = $_GET["mese"];
$cliente = $_GET["cliente"];
if ($mese!="" && $cliente!="") {
  $sql = "SELECT * FROM fatture WHERE YEAR(dataEmissione)=$anno AND MONTH(dataEmissione)=$mese AND cliente='$cliente'";
}elseif ($mese!=""){
  $sql = "SELECT * FROM fatture WHERE YEAR(dataEmissione)=$anno AND MONTH(dataEmissione)=$mese";  
}elseif ($cliente!=""){
  $sql = "SELECT * FROM fatture WHERE YEAR(dataEmissione)=$anno AND cliente='$cliente'";  
}else{
  $sql = "SELECT * FROM fatture WHERE YEAR(dataEmissione)=$anno";  
}
$result = $PDOconn->query($sql);
$risultato=($result->FetchAll());
?>

<table id="fatture">
<tr>
<!--When a header is clicked, run the sortTable function, with a parameter,
0 for sorting by names, 1 for sorting by country: -->
<th onclick="sortTable(0)">Numero Ordine</th>
<th onclick="sortTable(1)">Cliente</th>
<th onclick="sortTable(2)">Numero Fattura</th>
<th onclick="sortTable(3)">Data Emissione</th>
<th onclick="sortTable(4)">Data Pagamento</th>
</tr>
<?php foreach ($risultato as $fatture) {?>
<tr>
  <td><?php echo ($fatture["numeroOrdine"]); ?></td>
  <td><?php echo ($fatture["cliente"]); ?></td>
  <td><?php echo ($fatture["numeroFattura"]); ?></td>
  <td><?php echo ($fatture["dataEmissione"]); ?></td>
  <td><?php echo ($fatture["dataPagamento"]); ?></td>
</tr>
<?php } ?>
</table>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>