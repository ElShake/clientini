<!doctype html>
<html lang="en">

<head>
  <title>Society</title>
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
  require "header.php";
  ?>
  <?php
  if (!isset($_SESSION['userId'])) {
    echo '<p class"login-status">Please login!</p>';
  } else {

  ?>
    <?php require 'includes/society.inc.php'; ?>
    <?php

    if (isset($_SESSION['message'])) : ?>
      <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
      </div>
    <?php endif ?>

    <div class="container">

      <div class="row justify-content-center">
        <h1>SOCIETY</h1>
        <table class="table border=1">
          <thead>
            <tr>
              <th>Social Name</th>
              <th>Fiscal Code</th>
              <th>City</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>

          <?php
          while ($row = $result->fetch()) : ?>
            <tr>
              <form action="includes/society.inc.php" method="REQUEST">
                <td>
                  <div class="form-group">
                    <input type="text" name="socialName" class="form-control" value=<?php echo $row['Social_Name']; ?>>
                  </div>
                </td>
                <div class="form-group">
                  <td><input type="text" name="fiscalCode" class="form-control" value=<?php echo $row["Fiscal_Code"]; ?>></td>
                </div>
                <div class="form-group">
                  <td><input type="text" name="city" class="form-control" value=<?php echo $row["City"]; ?>></td>
                </div>
                <td>
                  <div class="form-group">
                    <button class="btn btn-info" name="edit" value="<?php echo $row['idSociety']; ?>" type="submit">Edit</button>
                    <button class="btn btn-danger" name="delete" value="<?php echo $row['idSociety']; ?>" type="submit">Delete</button>
                  </div>
                </td>
            </tr>
            </form>
          <?php endwhile; ?>
          <tr>
            <form action="includes/society.inc.php" method="REQUEST">
              <div class="form-group">
                <td>
                  <input type="text" name="newSocialName" class="form-control" placeholder="New Society">
              </div>
              </td>
              <div class="form-group">
                <td><input type="text" name="newFiscalCode" class="form-control" placeholder="Fiscal Code"></td>
              </div>
              <div class="form-group">
                <td><input type="text" name="newCity" class="form-control" placeholder="City"></td>
              </div>
              <td>
                <div class="form-group">
                  <button class="btn btn-info" name="add" type="submit">Add</button>
                </div>
              </td>
          </tr>
          </form>
        </table>
        <!-- </div>
      </div> -->
      </div>
      <!-- <div id="example-table"></div>
    <script type="text/javascript">
    var tabledata = [
 	{id:1, name:"Oli Bob", age:"12", col:"red", dob:""},
 	{id:2, name:"Mary May", age:"1", col:"blue", dob:"14/05/1982"},
 	{id:3, name:"Christine Lobowski", age:"42", col:"green", dob:"22/05/1982"},
 	{id:4, name:"Brendon Philips", age:"125", col:"orange", dob:"01/08/1980"},
 	{id:5, name:"Margret Marmajuke", age:"16", col:"yellow", dob:"31/01/1999"},
 ];
</script>
<script type="text/javascript">
    var table = new Tabulator("#example-table", {
 	height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
 	data:tabledata, //assign data to table
 	layout:"fitColumns", //fit columns to width of table (optional)
 	columns:[ //Define Table Columns
	 	{title:"Name", field:"name", width:150},
	 	{title:"Age", field:"age", hozAlign:"left", formatter:"progress"},
	 	{title:"Favourite Color", field:"col"},
	 	{title:"Date Of Birth", field:"dob", sorter:"date", hozAlign:"center"},
 	],
 	rowClick:function(e, row){ //trigger an alert message when the row is clicked
 		alert("Row " + row.getData().id + " Clicked!!!!");
 	},
});
</script> -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script>
        var Tabulator = require('tabulator-tables');
      </script>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php } ?>
</body>

</html>