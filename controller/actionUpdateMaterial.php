<?php
    include "../dbConfig.php";

    session_start();
    
    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    $response = array (
        "status" => 1,
        "message" => "Gagal menyimpan data!",
    );

    // System Update Material
    if(isset($_POST['editMaterial'])){
        $idMaterial = $_POST['idMaterial'];
        $sourcingNumber = $_POST['sourcingNumber'];
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

        $checkValue = $conn->query("SELECT materialCategory, materialName, materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, priority, vendor, documentReq FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll();
        $changeMaterialCategory = "";
        $changeMaterialName = "";
        $changePriority = "";
        $changeMaterialSpesification = "";
        $changeCatalogOrCasNumber = "";
        $changeCompany = "";
        $changeWebsite = "";
        $changeFinishDossageForm = "";
        $changeKeterangan = "";
        $changeVendor = "";
        $changeDocumentReq = "";

        if(!empty($materialCategory)){
            if($materialCategory != $checkValue[0]['materialCategory']){
                $changeMaterialCategory = ", material category";
            }else{
                $changeMaterialCategory = "";
            }
        }else{
            $materialCategory = "-";
        }

        if(!empty($materialName)){
            if($materialName != $checkValue[0]['materialName']){
                $changeMaterialName = ", material name";
            }else{
                $changeMaterialName = "";
            }
        }else{
            $materialName = "-";
        }

        if(!empty($materialSpesification)){
            if($materialSpesification != $checkValue[0]['materialSpesification']){
                $changeMaterialSpesification = ", spesification";
            }else{
                $changeMaterialSpesification = "";
            }
        }else{
            $materialSpesification = "-";
        }

        if(!empty($catalogOrCasNumber)){
            if($catalogOrCasNumber != $checkValue[0]['catalogOrCasNumber']){
                $changeCatalogOrCasNumber = ", Catalog Or Cas Number";
            }else{
                $changeCatalogOrCasNumber = "";
            }
        }else{
            $catalogOrCasNumber = "-";
        }

        if(!empty($company)){
            if($company != $checkValue[0]['company']){
                $changeCompany = ", company";
            }else{
                $changeCompany = "";
            }
        }else{
            $company = "-";
        }

        if(!empty($website)){
            if($website != $checkValue[0]['website']){
                $changeWebsite = ", website";
            }else{
                $changeWebsite = "";
            }
        }else{
            $website = "-";
        }

        if(!empty($finishDossageForm)){
            if($finishDossageForm != $checkValue[0]['finishDossageForm']){
                $changeFinishDossageForm = ", Finish Dossage Form";
            }else{
                $changeFinishDossageForm = "";
            }
        }else{
            $finishDossageForm = "-";
        }

        if(!empty($keterangan)){
            if($keterangan != $checkValue[0]['keterangan']){
                $changeKeterangan = ", keterangan";
            }else{
                $changeKeterangan = "";
            }
        }else{
            $keterangan = "-";
        }

        if(!empty($documentReq)){
            if($documentReq != $checkValue[0]['documentReq']){
                $changeDocumentReq = ", Document Requirement";
            }else{
                $changeDocumentReq = "";
            }
        }else{
            $documentReq = "-";
        }

       
        
        if(isset($priority) && isset($vendor)){
            if(!empty($priority)){
                if($priority != $checkValue[0]['priority']){
                    $changePriority = ", priority";
                }else{
                    $changePriority = "";
                }
            }else{
                $priority = "-";
            }

            if(!empty($vendor)){
                if($vendor != $checkValue[0]['vendor']){
                    $changeVendor = ", vendor";
                }else{
                    $changeVendor = "";
                }
            }else{
                $vendor = "-";
            }

            $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, priority = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, vendor = ?, documentReq = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($materialCategory, $materialName, $priority, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $vendor, $documentReq, $idMaterial));

            $message = "memperbaharui data".$changeMaterialCategory.$changeMaterialName.$changePriority.$changeMaterialSpesification.$changeCatalogOrCasNumber.$changeCompany.$changeWebsite.$changeFinishDossageForm.$changeKeterangan.$changeVendor.$changeDocumentReq.". Pada material sourcing : ";

            //Create Notification
            if($update == true){
                $response = sendNotification("Data material berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), $message, NULL, $idMaterial, NULL, NULL);
            }

        }else{
            $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, documentReq = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($materialCategory, $materialName, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $documentReq, $idMaterial));
        
            $message = "memperbaharui data riwayat".$changeMaterialCategory.$changeMaterialName.$changeMaterialSpesification.$changeCatalogOrCasNumber.$changeCompany.$changeWebsite.$changeFinishDossageForm.$changeKeterangan.$changeDocumentReq.". Pada material sourcing : ";

            //Create Notification
            if($update == true){
                $response = sendNotification("Data material berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), $message, $sourcingNumber, $idMaterial, NULL, true);
            }
        }
       
        echo json_encode($response);
        exit();
    }

    // Action Update Status Material
    if(isset($_POST['statusSourcing'])){
        $idMaterial = $_POST['idMaterial'];
        $statusSourcing = $_POST['statusSourcing'];

        $sql = "UPDATE TB_PengajuanSourcing SET statusSourcing = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($statusSourcing, $idMaterial));

        //Send Notification
        if($update == true){
            $response = sendNotification("Status Sourcing berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui status sourcing, Material : ", NULL, $idMaterial, NULL, NULL);
        }
       
        echo json_encode($response);
        exit();
    }

    if(isset($_POST['sumaryReport'])){
        $dateSumaryReport = date("Y-m-d");
        $sumaryReport = trim(strip_tags($_POST['sumaryReport']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        $sql = "UPDATE TB_PengajuanSourcing SET dateSumaryReport = ?, sumaryReport = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($dateSumaryReport, $sumaryReport, $idMaterial));

        //Send Notification
        if($update == true){
            $response = sendNotification("Summary Report berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui sumary repory sourcing, Material : ", NULL, $idMaterial, NULL, NULL);
        }
       
        echo json_encode($response);
        exit();
    }

    if(isset($_GET['actionType'])){
        $idMaterial = $_GET['idMaterial'];
        $materialName = $_GET['materialName'];

        $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?";
        $query = $conn->prepare($sql);
        $delete = $query->execute(array($idMaterial));

         //Send Notification
        if($delete == true){
            $response = sendNotification("Material Berhasil Di Hapus!!", $materialName, "menghapus riwayat sourcing, Material : ", NULL, NULL, NULL, true);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['feedbackTL'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackTL = trim(strip_tags($_POST['feedbackTL']));
        $dateApprovedTL = date("Y-m-d");
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackTL = ?, dateApprovedTL = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackTL, $dateApprovedTL, $idMaterial));

        //Send Notification
        if($update == true){
            $response = sendNotification("Feedback Team Leader Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui Feedback Team Leader, Material : ", $sourcingNumber, $idMaterial, NULL, true);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['feedbackRPIC'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackRPIC = trim(strip_tags($_POST['feedbackRPIC']));
        $dateAcceptedRPIC = date("Y-m-d");
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackRPIC = ?, dateAcceptedRPIC = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackRPIC, $dateAcceptedRPIC, $idMaterial));

        //Send Notification
        if($update == true){
            $response = sendNotification("Feedback RPIC Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui Feedback RPIC, Material : ", $sourcingNumber, $idMaterial, NULL, true);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['statusRiwayat'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $statusRiwayat = trim(strip_tags($_POST['statusRiwayat']));
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        $sql = "UPDATE TB_PengajuanSourcing SET statusRiwayat = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($statusRiwayat, $idMaterial));

        //Send Notification
        if($update == true){
            $response = sendNotification("Status Riwayat Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui status riwayat, Material : ", $sourcingNumber, $idMaterial, NULL, true);
        }

        echo json_encode($response);
        exit();
    }


    // Function For Send Nofitication
    function sendNotification($responseInfo, $subject, $message, $sourcingNumber, $idMaterial, $idSupplier, $dontSendLevel4){
        include "../dbConfig.php";
        //Create Notification
        $response = array(
            "status" => 0,
            "message" => $responseInfo, 
        );

        $randomId = md5(DateTime::createFromFormat('U.u', microtime(true))->format("Y-m-d H:i:s.u"));
        $dateNotif = date("Y-m-d H:i:s");

        $sql = "INSERT INTO TB_Notifications (randomId, subject, message, person, sourcingNumber, idMaterial, idSupplier, created) 
        VALUES (?,?,?,?,?,?,?,?)";
        $params = array(
            $randomId,
            $subject,
            $message,
            $_SESSION['user']['name'],
            $sourcingNumber,
            $idMaterial,
            $idSupplier,
            $dateNotif,
        );
        $query = $conn->prepare($sql);
        $insertNotif = $query->execute($params);

        //Send Notifications for users
        if($insertNotif == true){
            $totalUser = $conn->query("SELECT count(id) AS total FROM TB_Admin")->fetchAll();
            $user = $conn->query("SELECT id, level FROM TB_Admin")->fetchAll();
            $idNotification = $conn->query("SELECT id FROM TB_Notifications WHERE randomId='".$randomId."'")->fetchAll();
            for($i = 0; $i < $totalUser[0]['total']; $i++){
                $sql = "INSERT INTO TB_StatusNotifications (readingStatus, notifStatus, levelUser, idUser, idNotification, randomIdNotification, created) 
                VALUES (?,?,?,?,?,?,?)";
                $params = array(
                    0,
                    0,
                    $user[$i]['level'],
                    $user[$i]['id'],
                    $idNotification[0]['id'],
                    $randomId,
                    $dateNotif,
                );
                $query = $conn->prepare($sql)->execute($params);
            }
            if($dontSendLevel4 == true){
                $sql = "UPDATE TB_StatusNotifications SET notifStatus = 1 WHERE levelUser = 4";
                $query = $conn->prepare($sql);
                $update = $query->execute();
            }
        }

        return $response;
    }
?>