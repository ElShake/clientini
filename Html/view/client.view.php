<!doctype html>
<html lang="en">

<head>
  <title>Clients</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="dist/css/tabulator.min.css" rel="stylesheet">
  <script type="text/javascript" src="dist/js/tabulator.min.js"></script>

</head>

<body>

  <?php
  require "header.view.php";
  session_unset();
  ?>
  <!-- mostra tutti i clienti -->
  <?php require(SITE_ROOT . '/includes/client.inc.php'); ?>
  <div class="split left">
    <div class="centered">
      <?php
      while ($row = $result->fetch()) : ?>
        <button class="btn btn-primary" value="<?php echo $row["RagSoc"]; ?>" onClick="inform(this.value)"><?php echo $row["RagSoc"]; ?> </button>

      <?php endwhile; ?>

    </div>
  </div>
  <!-- mostra la pergamena del cliente -->
  <div class="split right">
    <div id="infodiv">
      
    </div>
  </div>






  </div>
  <!-- <?php
        if (!isset($_SESSION['userId'])) {
          echo '<p class"login-status">Please login!</p>';
        } else {

        ?> -->
<?php } ?>
</div>

<!-- funzione per passare il cliente cliccato alla pergamena  -->
<script type="text/javascript">
  function getXMLHTTP() {
    var x = false;
    try {
      x = new XMLHttpRequest();
    } catch (e) {
      try {
        x = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (ex) {
        try {
          req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e1) {
          x = false;
        }
      }
    }
    return x;
  }

  function inform(RagSoc) {
    var strURL = "../tabs/info.tab.php?RagSoc=" + RagSoc;
    var req = getXMLHTTP();
    if (req) {
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {
            document.getElementById('infodiv').innerHTML = req.responseText;
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }
      }
      req.open("GET", strURL, true);
      req.send(null);
    }
  }
</script>
</body>