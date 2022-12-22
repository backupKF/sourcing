<?php
    include "../dbConfig.php";
    if(isset($_POST['editMaterial'])){
        $idMaterial = $_POST['id'];
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialName = trim(strip_tags($_POST['materialName']));
        $priority = $_POST['priority'];
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));
        // $vendor = trim(strip_tags($_POST['vendor']));
        $documentReq = trim(strip_tags($_POST['documentReq']));

        if(empty($materialCategory)) {
            $materialCategory = "-"; 
        }
        if(empty($materialName)) {
            $materialName = "-"; 
        }
        // if(empty($priority)) {
        //     $priority = "-"; 
        // }
        if(empty($materialSpesification)) {
            $materialSpesification = "-"; 
        }
        if(empty($catalogOrCasNumber)){
            $catalogOrCasNumber = "-";
        }
        if(empty($company)){
            $company = "-";
        }
        if(empty($website)){
            $website = "-";
        }
        if(empty($finishDossageForm)) {
            $finishDossageForm = "-"; 
        }
        if(empty($keterangan)) {
            $keterangan = "-"; 
        }
        // if(empty($vendor)) {
        //     $vendor = "-"; 
        // }
        if(empty($documentReq)) {
            $documentReq = "-"; 
        }

        // $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, priority = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, vendor = ?, documentReq = ? WHERE id = ?";
        // $query = $conn->prepare($sql);
        // $update = $query->execute(array($materialCategory, $materialName, $priority, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $vendor, $documentReq, $idMaterial));

        $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, documentReq = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($materialCategory, $materialName, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $documentReq, $idMaterial));
    
        $response = empty($priority);
        echo json_encode($response);
    }

    if(isset($_POST['statusPengajuan'])){
        $idMaterial = $_POST['idMaterial'];
        $statusPengajuan = $_POST['statusPengajuan'];

        $sql = "UPDATE TB_PengajuanSourcing SET statusPengajuan = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($statusPengajuan, $idMaterial));

        header("Location: ../list/index.php");
        exit();
    }

    if(isset($_POST['sumaryReport'])){
        $dateSumaryReport = date("Y-m-d");
        $sumaryReport = trim(strip_tags($_POST['sumaryReport']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        $sql = "UPDATE TB_PengajuanSourcing SET dateSumaryReport = ?, sumaryReport = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($dateSumaryReport, $sumaryReport, $idMaterial));
    }

    // Sistem Hapus Material
    if(($_REQUEST['actionType'] == 'delete') && !empty($_GET['idMaterial'])){
        $idMaterial = $_GET['idMaterial'];

        //Delete data from SQL server 
        $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?"; 
        $query = $conn->prepare($sql); 
        $delete = $query->execute(array($idMaterial));
        
        $response = "hai";

        echo json_encode($response);
    }

    if(isset($_POST['feedbackTL'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackTL = trim(strip_tags($_POST['feedbackTL']));
        $dateApprovedTL = date("Y-m-d");

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackTL = ?, dateApprovedTL = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackTL, $dateApprovedTL, $idMaterial));

        $response = "Data berhasil diperbaharui";
        echo json_encode($response);
    }

    if(isset($_POST['feedbackRPIC'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackRPIC = trim(strip_tags($_POST['feedbackRPIC']));
        $dateAcceptedRPIC = date("Y-m-d");

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackRPIC = ?, dateAcceptedRPIC = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackRPIC, $dateAcceptedRPIC, $idMaterial));

        $response = "Data berhasil diperbaharui";
        echo json_encode($response);
    }
?>