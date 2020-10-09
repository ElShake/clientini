<html>

<head>

</head>

<body>
  <?php require "header.view.php"; ?>
  <div class="container">
    <div class="row justify-content-center">
      <form action="newinvoice.view.php" method="POST">
        <h1>Nuovo Ordine</h1>
        <div class="form-group">
          <label for="numeroOrdine">Numero Ordine: </label>
          <input name="numeroOrdine" class="form-control">
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
        <div class="form-group">
          <label for="dataRegistrazione">Data Registrazione: </label>
          <input id="dataRegistrazione" width="276" />
          <script>
            $('#dataRegistrazione').datepicker({
              uiLibrary: 'bootstrap4'
            });
          </script>
        </div>
        <div class="form-group">
          <label for="dataEstinzione">Data Estinzione: </label>
          <input id="dataEstinzione" width="276" />
          <script>
            $('#dataEstinzione').datepicker({
              uiLibrary: 'bootstrap4'
            });
          </script>
        </div>
        <div class="form-group">
          <label for="numeroFatture">Numero Fatture: </label>
          <select class="btn" name="anno">
            <?php for ($a = 2; $a <= (30); $a++) { ?>
              <option value="<?php echo ($a) ?>"><?php echo ($a) ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          Ricorsività fissa: <input type="checkbox" id="chericor" onclick="checkricor()">
          <div id="ricor" style="display:none" class="form-group">
            <label for="ricorsivita">Ricorsività: </label>
            <select class="btn" name="anno">
              <?php for ($a = 1; $a<=12; $a++) { ?>
                <option value="<?php echo ($a) ?>"><?php echo ($a) ?></option>
              <?php } ?>
            </select>
            <label> Mesi </label>
          </div>
          Importo fisso: <input type="checkbox" name="importoFisso">
        </div>
        <button class="btn btn-primary" type="submit">Fatture</button>
    </div>
    </form>
</body>

</html>

<script>
  function checkricor() {
    // Get the checkbox
    var checkBox = document.getElementById("chericor");
    // Get the output text
    var text = document.getElementById("ricor");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }
</script>