<?php
    include "../dbConfig.php";
    
    // // Sistem Hapus Supplier
    // if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['idSupplier'])){
    //     $idSupplier = $_GET['idSupplier']; 

    //     // Delete data from SQL server 
    //     $sql = "DELETE FROM TB_Supplier WHERE id = ?"; 
    //     $query = $conn->prepare($sql); 
    //     $delete = $query->execute(array($idSupplier));
        
    //     header("Location: ../index.php");
    //     exit();
    // }

    // // Sistem Tambah Detail Supplier
    // if(isset($_POST['tambahDetailSupplier'])){
    //     $MoQ = trim(strip_tags($_POST['MoQ']));
    //     $UoM = trim(strip_tags($_POST['UoM']));
    //     $price = trim(strip_tags($_POST['price']));
    //     $idSupplier = trim(strip_tags($_POST['id']));

    //     $sql = "INSERT INTO TB_DetailSupplier (MoQ, UoM, price, idSupplier) 
    //     VALUES (?,?,?,?)";
    //     $params = array(
    //         $MoQ,
    //         $UoM,
    //         $price,
    //         $idSupplier,
    //     );
    //     $query = $conn->prepare($sql);
    //     $insert = $query->execute($params);
    //     header("Location: ../index.php");
    //     exit();
    // }

    // // Sistem Hapus Detail Supplier
    // if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    //     $idDetailSupplier = $_GET['id']; 

    //     // Delete data from SQL server 
    //     $sql = "DELETE FROM TB_DetailSupplier WHERE idDetailSupplier = ?"; 
    //     $query = $conn->prepare($sql); 
    //     $delete = $query->execute(array($idDetailSupplier));
        
    //     header("Location: ../index.php");
    //     exit();
    // }

    if(isset($_POST['idMaterial'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = date('Y-m-d', strtotime($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        $sql = "INSERT INTO TB_Supplier (supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, idMaterial) 
        VALUES (?,?,?,?,?,?,?,?)";
        $params = array(
            $supplier,
            $manufacture,
            $originCountry,
            $leadTime,
            $catalogOrCasNumber,
            $gradeOrReference,
            $documentInfo,
            $idMaterial,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);
    }
?>