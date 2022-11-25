<?php
     if(!session_id()){ 
        session_start(); 
    } 

    include "../../dbConfig.php";

    if(isset($_POST['setProject'])){
        $_SESSION['project'] = $_POST['project'];
        header('Location: ../index.php');
    };

    $materials = $_SESSION['materials'];
    if(isset($_POST['tambahDataMaterial'])){
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialDeskripsi = trim(strip_tags($_POST['materialDeskripsi']));
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));
        $setProject = trim(strip_tags($_POST['setProject']));

        if(empty($materialCategory)) {
            $materialCategory = "-"; 
        }
        if(empty($materialDeskripsi)) {
            $materialDeskripsi = "-"; 
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

        $newData = ["materialCategory" => $materialCategory, 
                    "materialDeskripsi" => $materialDeskripsi, 
                    "materialSpesification" => $materialSpesification,
                    "catalogOrCasNumber" => $catalogOrCasNumber,
                    "company" => $company,
                    "website" => $website,
                    "finishDossageForm" => $finishDossageForm,
                    "keterangan" => $keterangan,
                    "projectCode" => $setProject,
                ];
        $materials[] = $newData;

        $_SESSION['project'] = $setProject;
        $_SESSION['materials'] = $materials;

        header('Location: ../index.php');
    }

    if(isset($_POST['tambahPengajuan'])){
        $materials = $_SESSION['materials'];

        foreach($materials as $material){
            $sql = "INSERT INTO TB_PengajuanSourcing (materialCategory, materialDeskripsi,  materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, projectCode, created, dateSourcing, feedbackTL, feedbackRPIC, status) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?, 0, 0, 'ON PROSES')";
            $params = array(
                $material['materialCategory'],
                $material['materialDeskripsi'],
                $material['materialSpesification'],
                $material['catalogOrCasNumber'],
                $material['company'],
                $material['website'],
                $material['finishDossageForm'],
                $material['keterangan'],
                $material['projectCode'],
                date("Y-m-d H:i:s"),
                date("Y-m-d"),
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }
        unset($_SESSION['materials']);
        unset($_SESSION['project']);
        header('Location:../../riwayat/index.php');
    }
?>
