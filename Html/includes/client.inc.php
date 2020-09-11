<?php
require 'dbh.inc.php';

$socialName = '';
$fiscalCode = '';
$city = '';
$idClient = 0;
$update = false;
require(SITE_ROOT . "/tabs/client.tab.php");


// if (isset($_REQUEST['delete'])) {
//     $idClient = $_REQUEST['delete'];
//     try {
//         $PDOconn->query("DELETE FROM clientstab WHERE idClient=$idClient") or
//             die($PDOconn->error);
//         $_SESSION['message'] = "Record has been deleted!";
//         $_SESSION['msg_type'] = "danger";
//         header("location: ../clients.php");
//     } catch (PDOException $e) {
//         echo $e->getMessage()();
//     }
// }


// if (isset($_REQUEST['add'])) {
//     $socialName = $_REQUEST['newSocialName'];
//     $fiscalCode = $_REQUEST['newFiscalCode'];
//     $city = $_REQUEST['newCity'];
//     try {
//         $sql = ("INSERT INTO clientstab (Social_Name, Fiscal_Code, City, idUser) VALUES (?, ?, ?,'$idnow')");
//         $stmt = $PDOconn->prepare($sql);
//         $stmt->bindParam(1, $socialName, PDO::PARAM_STR);
//         $stmt->bindParam(2, $fiscalCode, PDO::PARAM_STR);
//         $stmt->bindParam(3, $city, PDO::PARAM_STR);
//         $stmt->execute();
//         $_SESSION['message'] = "Record has been added!";
//         $_SESSION['msg_type'] = "success";
//         header("location: ../clients.php");
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
// }

// if (isset($_GET['edit'])) {
//     $idClient = $_REQUEST['edit'];
//     $socialName = $_REQUEST['socialName'];
//     $fiscalCode = $_REQUEST['fiscalCode'];
//     $city = $_REQUEST['city'];
//     $sql= (("UPDATE clientstab SET Social_Name=?, Fiscal_Code=?, City=? WHERE idClient=$idClient"));
//     $stmt = $PDOconn->prepare($sql);
//     $stmt->bindParam(1, $socialName, PDO::PARAM_STR);
//     $stmt->bindParam(2, $fiscalCode, PDO::PARAM_STR);
//     $stmt->bindParam(3, $city, PDO::PARAM_STR);
//     $stmt->execute();
//     $_SESSION['message'] = "Record has been updated!";
//     $_SESSION['msg_type'] = "warning";
//     header('location: ../clients.php');
// }