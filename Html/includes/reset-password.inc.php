<?php

if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordr = $_POST["passwordr"];
    if (empty($password) || empty($passwordr)) {
        header("Location: ../create-new-password.php=empty&selector=" . $selector . "&validator=" . $validator);
        exit();
    } elseif ($password !== $passwordr) {
        header("Location: ../create-new-password.php?error=passwordcheck&selector=" . $selector . "&validator=" . $validator);
        exit();
    }

    $currentDate = date("U");
    require 'dbh.inc.php';
    $sqle = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExprires >=$currentDate";
    $stmte = $PDOconn->prepare($sqle);
    $stmte->bindParam(1, $selector, PDO::PARAM_STR);
    $stmte->execute();
    $result = ($stmte->fetch());
    if (!$row = $result) {
        echo "You need to re-submit your request.";
        exit();
    } else {
        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
        if ($tokenCheck === false) {
            echo "You need to re-submit your reset request.";
            exit();
        } elseif ($tokenCheck === true) {
            $tokenEmail = $row['pwdResetEmail'];
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $PDOconn->prepare($sql);
            $stmt->bindParam(1, $tokenEmail, PDO::PARAM_STR);
            $stmt->execute();
            $result = ($stmt->fetch());
            if (!$row = $result) {
                echo "There was an error";
                exit();
            } else {
                $newpwdhash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password=? where email=?";
                $stmt = $PDOconn->prepare($sql);
                $stmt->bindParam(1, $newpwdhash, PDO::PARAM_STR);
                $stmt->bindParam(2, $tokenEmail, PDO::PARAM_STR);
                $stmt->execute();
                $sql="DELETE FROM pwdReset WHERE pwdResetEmail=?";
                $stmt = $PDOconn->prepare($sql);
                $stmt->bindParam(1, $tokenEmail, PDO::PARAM_STR);
                $stmt->execute();
                header("Location: ../signup.php?newpwd=passwordupdated");
            }
        }
    }
} else {
    header("Location ../index.php");
}
