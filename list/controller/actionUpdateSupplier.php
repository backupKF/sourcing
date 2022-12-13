<?php
    include "../../dbConfig.php";

    if(isset($_POST['idSupplier'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = date('Y-m-d', strtotime($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
    }

    // Sistem Hapus Detail Supplier
    if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
        $idDetailSupplier = $_GET['id']; 

        // Delete data from SQL server 
        $sql = "DELETE FROM TB_DetailSupplier WHERE idDetailSupplier = ?"; 
        $query = $conn->prepare($sql); 
        $delete = $query->execute(array($idDetailSupplier));
        
        header("Location: ../index.php");
        exit();
    }
?>