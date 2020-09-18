<?php

if (isset($_POST['login-submit'])) {
  require 'dbhlink.inc.php';
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email) || empty($password)) {
    header("Location: ../view/index.view.php?error=empyfields");
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE username=? or email=?;";
    $stmt = $PDOconn->prepare($sql);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch();
    echo ($result['password']);
    // if ($result) {
    //    $pwdcheck = password_verify($password, $result['password']);
    //    if ($pwdcheck == false) {
    //     header('Location: ../view/index.view.php?error=wrongpassword');
    //     exit();
    //   } else if ($pwdcheck == true) {
        session_start();
        $_SESSION['UserId'] = $result['UserId'];
        $_SESSION['username'] = $result['username'];
        header('Location: ../view/client.view.php?login=success');
        exit();
    //   } else {
    //     header('Location: ../view/index.view.php?error=wrongpassword');
    //     exit();
    //   }
    // } else {
    //   header('Location: ../view/index.view.php?error=nouser');
    //   exit();
    // }
   }
} else {
  header("Location: ../view/index.view.php");
  exit();
}
