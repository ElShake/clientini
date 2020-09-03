<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="dist/css/tabulator.min.css" rel="stylesheet">
</head>

<body>



  <div class="container">
    <?php
    try {
      $dsn = "mysql:host=localhost;dbname=invodb;charset=utf8";
      $PDOconn = new PDO($dsn, "sam", "Pollastri666");
      $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    $sql = "SELECT * FROM users";
    $result = $PDOconn->query($sql);
    ?>


    <div class="row justify-content-center">
      <form action="index.php" method="POST">
        <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" value="2" class="form-control" placeholder="place@holder.here">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" placeholder="not your birthday">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        </div>
      </form>
    </div>
  </div>
  <?php echo $email ?>
  <?php while ($row = $result->fetch()) :
    if ($email == $row["email"]) {
    } ?>


  <?php endwhile ?>

</body>

</html>