<?php
session_start();
define("SITE_ROOT", "C:/xampp/htdocs/clientini/Html");
require(SITE_ROOT . "/includes/dbhlink.inc.php");
if (isset($_POST["FilePath"])) {
    var_dump($_POST);
    $sql = "INSERT INTO Link(FileName,FilePath,IdCliente,RagSoc,Anno) VALUES (?,?,?,?,?)";
    $stmt = $PDOconn->prepare($sql);
    $stmt->bindParam(1, $_POST['FileName'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['FilePath'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['IdCliente'], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST['RagSoc'], PDO::PARAM_STR);
    $stmt->bindParam(5, $_POST['Anno'], PDO::PARAM_INT);
    $stmt->execute();
   $_SESSION["link"]=$_POST["link"]; 
   header ("Location: ../view/fileselect.view.php");
   exit();
}

if (isset($_POST["delete-link"])) {
    $delete=$_POST["delete-link"];
    $sql = "DELETE FROM Link WHERE IdLink=?";
    $stmt = $PDOconn->prepare($sql);
    $stmt->bindParam(1, $_POST["delete-link"], PDO::PARAM_INT);
    $stmt->execute();
   $_SESSION["link"]=$_POST["link"]; 
   header ("Location: ../view/fileselect.view.php");
   exit();
}
?>