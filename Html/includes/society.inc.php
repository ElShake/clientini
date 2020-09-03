<?php
define("SITE_ROOT", "C:/xampp/htdocs/WEBTEST/Html");
require 'dbh.inc.php';

$socialName = '';
$fiscalCode = '';
$city = '';
$idsociety = 0;
$update = false;
require(SITE_ROOT . "/tabs/society.tab.php");


if (isset($_REQUEST['delete'])) {
    $idsociety = $_REQUEST['delete'];
    try {
        $PDOconn->query("DELETE FROM societytab WHERE idSociety=$idsociety") or
            die($PDOconn->error);
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header("location: ../society.php");
    } catch (PDOException $e) {
        echo $e->getMessage()();
    }
}


if (isset($_REQUEST['add'])) {
    $socialName = $_REQUEST['newSocialName'];
    $fiscalCode = $_REQUEST['newFiscalCode'];
    $city = $_REQUEST['newCity'];
    try {
        $sql = ("INSERT INTO societytab (Social_Name, Fiscal_Code, City, idUser) VALUES (?, ?, ?,'$idnow')");
        $stmt = $PDOconn->prepare($sql);
        $stmt->bindParam(1, $socialName, PDO::PARAM_STR);
        $stmt->bindParam(2, $fiscalCode, PDO::PARAM_STR);
        $stmt->bindParam(3, $city, PDO::PARAM_STR);
        $stmt->execute();
        $_SESSION['message'] = "Record has been added!";
        $_SESSION['msg_type'] = "success";
        header("location: ../society.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET['edit'])) {
    $idsociety = $_REQUEST['edit'];
    $socialName = $_REQUEST['socialName'];
    $fiscalCode = $_REQUEST['fiscalCode'];
    $city = $_REQUEST['city'];
    $sql= (("UPDATE societytab SET Social_Name=?, Fiscal_Code=?, City=? WHERE idSociety=$idsociety"));
    $stmt = $PDOconn->prepare($sql);
    $stmt->bindParam(1, $socialName, PDO::PARAM_STR);
    $stmt->bindParam(2, $fiscalCode, PDO::PARAM_STR);
    $stmt->bindParam(3, $city, PDO::PARAM_STR);
    $stmt->execute();
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: ../society.php');
}
