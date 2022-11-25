<?php
    include "../../dbConfig.php";

    if(isset($_POST['feedbackRPIC'])){
        $dateAcceptedRPIC = date("Y-m-d");
        $setID = $_POST['setID'];
        $setFeedback = $_POST['feedbackRPIC'];
        
        $data = [
            'dateAcceptedRPIC' => $dateAcceptedRPIC, 
            'feedbackRPIC' => $setFeedback,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackRPIC=:feedbackRPIC, dateAcceptedRPIC=:dateAcceptedRPIC WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: ../index.php");
    };

    if(isset($_POST['feedbackTL'])){
        $dateApprovedTL = date("Y-m-d");
        $setID = $_POST['setID'];
        $setFeedback = $_POST['feedbackTL'];
        
        $data = [
            'dateApprovedTL' => $dateApprovedTL, 
            'feedbackTL' => $setFeedback,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackTL=:feedbackTL, dateApprovedTL=:dateApprovedTL WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: ../index.php");
    };

    if(isset($_POST['status'])){
        $setID = $_POST['setID'];
        $status = $_POST['status'];
        
        $data = [
            'status' => $status,
            'id' => $setID,
        ];

        $sql = "UPDATE TB_PengajuanSourcing SET status=:status WHERE id=:id";
        $conn->prepare($sql)->execute($data);

        header("Location: ../index.php");
    };

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

    if(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
        $idMaterial = $_GET['id']; 

        // Delete data from SQL server 
        $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?"; 
        $query = $conn->prepare($sql); 
        $delete = $query->execute(array($idMaterial));
        
        header("Location: ../index.php");
        exit();
    }
?>