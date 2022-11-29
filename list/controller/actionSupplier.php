<?php
    include "../../dbConfig.php";

    if(isset($_POST['tambahSupplier'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = trim(strip_tags($_POST['leadTime']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReferenceStandard = trim(strip_tags($_POST['gradeOrReferenceStandard']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idMaterial = trim(strip_tags($_POST['id']));

        $sql = "INSERT INTO TB_Supplier (supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gladeOrReferenceStandard, documentInfo, idMaterial) 
        VALUES (?,?,?,?,?,?,?,?)";
        $params = array(
            $supplier,
            $manufacture,
            $originCountry,
            $leadTime,
            $catalogOrCasNumber,
            $gradeOrReferenceStandard,
            $documentInfo,
            $idMaterial,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);

        // $idSupplier = 

        // $count = count($MoQ);
        // for($i=0;$i<$count;$i++){
        //     $sql = "INSERT INTO TB_DetailSupplier (supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gladeOrReferenceStandard, documentInfo) 
        //     VALUES (?,?,?,?,?,?,?)";
        // }

        header("Location: ../index.php");
        exit();
    }

    if(isset($_POST['tambahDetailSupplier'])){
        $MoQ = trim(strip_tags($_POST['MoQ']));
        $UoM = trim(strip_tags($_POST['UoM']));
        $price = trim(strip_tags($_POST['price']));
        $idSupplier = trim(strip_tags($_POST['id']));

        $sql = "INSERT INTO TB_DetailSupplier (MoQ, UoM, price, idSupplier) 
        VALUES (?,?,?,?)";
        $params = array(
            $MoQ,
            $UoM,
            $price,
            $idSupplier,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);
        header("Location: ../index.php");
        exit();
    }

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