<?php
    include "../../dbConfig.php";

    if(isset($_POST['edit'])){
        $idMaterial = $_POST['id'];
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialDeskripsi = trim(strip_tags($_POST['materialDeskripsi']));
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));

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

        $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialDeskripsi = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($materialCategory, $materialDeskripsi, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $idMaterial));
    
        header("Location: ../index.php");
        exit();
    }
?>