<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Home</title>
</head>

<body>
  <header>
  <?php ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark form-inline my-0 my-lg-0" class="">
      <a class="navbar-brand" href="index.php">HOME</a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="clients.php">CLIENTS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="society.php">SOCIETY</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            INVOICES
          </a>
          <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
            <a class="dropdown-item " href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ">
        <?php
        if (isset($_SESSION['userId'])) {
          echo '<li>
            <form action="includes/logout.inc.php" method="POST">
            <button type="submit" class="nav-link btn-danger">LOGOUT</button>
          </li>';
        } else {
          echo '<form class="form-group" action="includes/login.inc.php" method="POST" >
    
            <li class="nav-item">
                <input type="text" class="form-control" name="email" placeholder="email@holder.ph">
            </li>
            <li><div>"   "</div></li>
            <li class="nav-item">    
                <input type="text" class="form-control" name="password" placeholder="Password">
            </li>  
              <button  type="submit" name="login-submit" class="form-control nav-link btn-dark" >LOGIN</button>
            </li>
            <li class="nav-item btn-outline-success">
              <a class="nav-link" href="signup.php">SIGNUP</a>
            </li>';
        }
        ?>


      </ul>
      </form>
      </div>
    </nav>
    

  </header>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>

</html>