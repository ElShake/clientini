<!doctype html>
<html lang="en">

<head>
  <title>Home</title>
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

  ?>
  <div class="container">
  <div class="row justify-content-center">
    <form>
      <h1>Fatture Ricorrenti</h1>
      <td>
        <label>Anno: </label>
        <select class="btn" name="anno">
          <?php for ($i = 2016; $i <= (date("Y") + 2); $i++) { ?>
            <option value="<?php echo ($i) ?>"><?php echo ($i) ?></option>
          <?php } ?>
        </select>
      </td>
      <td>
        <label>Mese: </label>
        <select class="btn" name="mese">
          <?php for ($i = 1; $i <= (12); $i++) { ?>
            <option value="<?php echo ($i) ?>"><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
          <?php } ?>
        </select>
      </td>
      <td><button class="btn btn-primary" onclick="cerca(anno,mese)">Cerca</button></td>
    </form>
    <div id="ricerca"></div>
  </div>
 
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

    function cerca(anno,mese) {
      var strURL = "../tabs/fattu.tab.php?anno=" + anno +"&mese=" +mese ;
      var req = getXMLHTTP();
      if (req) {
        req.onreadystatechange = function() {
          if (req.readyState == 4) {
            // only if "OK"
            if (req.status == 200) {
              document.getElementById('ricerca').innerHTML = req.responseText;
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
  <?php require "footer.view.php";

  ?>
</body>