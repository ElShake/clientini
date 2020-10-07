<!doctype html>
<html lang="en">

<head>
  <title>Home</title>

</head>

<body>
  <?php
  require "header.view.php";
  ?>
  <div class="container">
  <div class="row justify-content-center">
    <form method="GET">
      <h1>Fatture Ricorrenti</h1>
        <div class="form-group">
        <label for="anno">Anno: </label>
        <select class="btn"  name="anno">
          <?php for ($a = 2016; $a <= (date("Y") + 2); $a++) { ?>
            <option value="<?php echo ($a) ?>"><?php echo ($a) ?></option>
          <?php } ?>
        </select>
        </div>
        <div class="form-group">
        <label>Mese: </label>
        <select class="btn" name="mese">
          <?php for ($i = 1; $i <= (12); $i++) { ?>
            <option value="<?php echo ($i) ?>"><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
          <?php } ?>
        </select>
        </div>
        <div class="form-group">
     <button class="btn btn-primary"  onclick="cerca(value.anno,value.mese)">Cerca</button>
     </div>
     <div id="ricerca">A</div>
    </form>
    
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
 