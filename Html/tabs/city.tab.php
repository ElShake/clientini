<?php
$Sigla =($_GET['Sigla']);
try {
  $dsn = "mysql:host=localhost;dbname=invodb;charset=utf8";
  $PDOconn = new PDO($dsn, "sam", "Pollastri666");
  $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
$sql = "SELECT * FROM city WHERE Sigla = '$Sigla' ORDER BY Comune";
$cityr = $PDOconn->query($sql);

?>

<select name="newCity"class="form-control">
  <option>Select city</option>
  <?php while ($city = $cityr->fetch()) : ?>
    <option value="<?php echo $city['Comune']?>"><?php echo $city['Comune'] ?></option>
  <?php endwhile; ?>
</select>