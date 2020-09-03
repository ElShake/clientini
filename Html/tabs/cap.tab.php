<?php
$Comune =($_GET['Comune']);
try {
  $dsn = "mysql:host=localhost;dbname=invodb;charset=utf8";
  $PDOconn = new PDO($dsn, "sam", "Pollastri666");
  $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
$sql = "SELECT * FROM city WHERE Comune = '$Comune'";
$cityr = $PDOconn->query($sql);
$cap=$cityr->fetch();
?>
<div><input type="text" name="newCAP" class="form-control" placeholder=<?php echo $cap['CAP'] ?> value=<?php echo $cap['CAP'] ?>></td>
</div>
