<?php

    if(!session_id()){ 
        session_start(); 
    } 

    include "../dbConfig.php";

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['setProject'])){
        $_SESSION['project'] = $_POST['project'];
        header('Location: ../pengajuan/index.php');   
    };

    $materials = $_SESSION['materials'];
    if(isset($_POST['tambahDataMaterial'])){
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialName = trim(strip_tags($_POST['materialName']));
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));
        $documentReq = trim(strip_tags($_POST['documentReq']));
        $setProject = trim(strip_tags($_POST['setProject']));

        if(empty($materialCategory)) {
            $materialCategory = "-"; 
        }
        if(empty($materialName)) {
            $materialName = "-"; 
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
        if(empty($documentReq)) {
            $documentReq = "-"; 
        }

        $newData = ["materialCategory" => $materialCategory, 
                    "materialName" => $materialName, 
                    "materialSpesification" => $materialSpesification,
                    "catalogOrCasNumber" => $catalogOrCasNumber,
                    "company" => $company,
                    "website" => $website,
                    "finishDossageForm" => $finishDossageForm,
                    "keterangan" => $keterangan,
                    "documentReq" => $documentReq,
                    "projectCode" => $setProject,
                ];
        $materials[] = $newData;
        $_SESSION['project'] = $setProject;
        $_SESSION['materials'] = $materials;

        header('Location: ../pengajuan/index.php');
    }

    if(isset($_POST['tambahPengajuan'])){
        $materials = $_SESSION['materials'];

        $number = $conn->query("SELECT TOP 1 sourcingNumber FROM TB_PengajuanSourcing ORDER BY ID DESC")->fetchAll();

        $sourcingNumber = autoNumber(date("Y"), $_SESSION['user']['teamLeader'], $number[0]['sourcingNumber']);

        foreach($materials as $material){
            $sql = "INSERT INTO TB_PengajuanSourcing (sourcingNumber, materialCategory, materialName,  materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, documentReq, projectCode, created, dateSourcing, feedbackTL, feedbackRPIC) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?, 0, 0)";
            $params = array(
                $sourcingNumber,
                $material['materialCategory'],
                $material['materialName'],
                $material['materialSpesification'],
                $material['catalogOrCasNumber'],
                $material['company'],
                $material['website'],
                $material['finishDossageForm'],
                $material['keterangan'],
                $material['documentReq'],
                $material['projectCode'],
                date("Y-m-d H:i:s"),
                date("Y-m-d"),
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }
        unset($_SESSION['materials']);
        unset($_SESSION['project']);

        //Create Notification
        if($insert == true){
            $message = "menambah material sourcing";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");
            $randomId = md5(DateTime::createFromFormat('U.u', microtime(true))->format("Y-m-d H:i:s.u"));

            $sql = "INSERT INTO TB_Notifications (randomId,message, person, status, sourcingNumber, created) 
            VALUES (?,?,?,?,?,?)";
            $params = array(
                $randomId,
                $message,
                $person,
                0,
                $sourcingNumber,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insertNotif = $query->execute($params);

            //Send Notifications for users
            if($insertNotif == true){
                $totalUser = $conn->query("SELECT count(id) AS total FROM TB_Admin")->fetchAll();
                $user = $conn->query("SELECT id FROM TB_Admin")->fetchAll();
                $idNotification = $conn->query("SELECT id FROM TB_Notifications WHERE randomId='".$randomId."'")->fetchAll();
                for($i = 0; $i < $totalUser[0]['total']; $i++){
                    $sql = "INSERT INTO TB_StatusNotifications (readingStatus, notifStatus, idUser, idNotification, created) 
                    VALUES (?,?,?,?,?)";
                    $params = array(
                        0,
                        0,
                        $user[$i]['id'],
                        $idNotification[0]['id'],
                        $dateNotif,
                    );
                    $query = $conn->prepare($sql)->execute($params);
                }
            }
        }
        header('Location: ../riwayat/index.php');
    }

    function autoNumber($year, $tl, $number) {

        // Checking Order Sourcing
        if(empty($number) || substr($number, -9, 4) < $year){
            $orderSourcing = "000";
        }else{
            $number += 1;
            $sliceOrder = substr($number, 6);
            if($sliceOrder <= 999){
                $orderSourcing = $sliceOrder;
            }else{
                $orderSourcing = "000";
            }
        }

        // Checking Order TeamLeader
        switch($tl) {
            case "TL-F1": 
                $orderTl = "01";
                break; 
            case "TL-F2": 
                $orderTl = "02";
                break; 
            case "TL-F3": 
                $orderTl = "03";
                break; 
            case "TL-F4": 
                $orderTl = "04";
                break; 
            case "TL-TC": 
                $orderTl = "05";
                break; 
            case "TL-KM": 
                $orderTl = "06";
                break; 
            case "TL-F7": 
                $orderTl = "07";
                break; 
            case "TL-F8": 
                $orderTl = "08";
                break; 
            case "TL-9": 
                $orderTl = "09";
                break;
            case "TLRPIC": 
                $orderTl = "10";
                break;  
        }

        // Set Auto Number
        $autoNumber = $year.$orderTl.$orderSourcing;
        return (int)$autoNumber;
    }
?>
