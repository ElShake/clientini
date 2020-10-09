<!doctype html>
<html lang="en">

<head>
  <title>Home</title>

</head>

<body>
  <?php
  require "header.view.php";
  require "../tabs/clients.tab.php";
  $clients = $_POST["clienti"]
  ?>
  <div class="container">
    <div class="row justify-content-center">
      <form>
        <h1>Fatture Ricorrenti</h1>
        <div class="form-group">
          <label for="anno">Anno: </label>
          <select class="btn" name="anno">
            <?php for ($a = 2016; $a <= (date("Y") + 2); $a++) { ?>
              <option value="<?php echo ($a) ?>"><?php echo ($a) ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Mese: </label>
          <select class="btn" name="mese">
            <option></option>
            <?php for ($i = 1; $i <= (12); $i++) { ?>
              <option value="<?php echo ($i) ?>"><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Cliente: </label>
          <select class="btn" name="cliente">
            <option></option>
            <?php foreach ($clients as $cliente) { ?>
              <option value="<?php echo ($cliente["ragSoc"]) ?>"><?php echo ($cliente["ragSoc"]); ?></option>
            <?php } ?>
          </select>
        </div>
        <button type="button" class="btn btn-primary" onclick="cerca(anno.value,mese.value,cliente.value)">Cerca</button>
    </div>
    </form><br>
    <div id="ricerca"></div>
    <br>
    <a href="neworder.view.php" class="btn btn-primary">Nuovo ordine</a>
  </div>

  </div>



</body>
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

  function cerca(anno, mese, cliente) {
    var strURL = "../tabs/fattu.tab.php?anno=" + anno + "&mese=" + mese + "&cliente=" + cliente;
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

  function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("fatture");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>