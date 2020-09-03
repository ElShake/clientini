<?php

if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email) || empty($password)) {
    header("Location: ../index.php?error=empyfields");
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE username=? or email=?;";
    $stmt = $PDOconn->prepare($sql);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    echo ($result['password']);
    if ($result) {
      $pwdcheck = password_verify($password, $result['password']);
      if ($pwdcheck == false) {
        header('Location: ../index.php?error=wrongpassword');
        exit();
      } else if ($pwdcheck == true) {
        session_start();
        $_SESSION['userId'] = $result['idUser'];
        $_SESSION['username'] = $result['username'];
        header('Location: ../index.php?login=success');
        exit();
      } else {
        header('Location: ../index.php?error=wrongpassword');
        exit();
      }
    } else {
      header('Location: ../index.php?error=nouser');
      exit();
    }
  }
} else {
  header("Location: ../index.php");
  exit();
}
