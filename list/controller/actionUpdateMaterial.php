<?php
    include "../../dbConfig.php";
    if(isset($_POST['edit'])){
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
        $vendor = trim(strip_tags($_POST['vendor']));
        $documentReq = trim(strip_tags($_POST['documentReq']));
        // $statusPengajuan = $_POST['statusPengajuan'];

        if(empty($materialCategory)) {
            $materialCategory = "-"; 
        }
        if(empty($materialName)) {
            $materialName = "-"; 
        }
        if(empty($priority)) {
            $priority = "-"; 
        }
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
        if(empty($vendor)) {
            $vendor = "-"; 
        }
        if(empty($documentReq)) {
            $documentReq = "-"; 
        }
        

        $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, priority = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, vendor = ?, documentReq = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($materialCategory, $materialName, $priority, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $vendor, $documentReq, $idMaterial));
    
        header("Location: ../index.php");
        exit();
    }

    if(isset($_POST['statusPengajuan'])){
        $idMaterial = $_POST['idMaterial'];
        $statusPengajuan = $_POST['statusPengajuan'];

        $sql = "UPDATE TB_PengajuanSourcing SET statusPengajuan = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($statusPengajuan, $idMaterial));

        header("Location: ../index.php");
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
?>