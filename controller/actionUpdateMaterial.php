<?php
    include "../dbConfig.php";

    session_start();

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
        
        if(isset($priority) && isset($vendor)){
            if(empty($priority)) {
                $priority = "-"; 
            }
            if(empty($vendor)) {
                $vendor = "-"; 
            }

            $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, priority = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, vendor = ?, documentReq = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($materialCategory, $materialName, $priority, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $vendor, $documentReq, $idMaterial));
    
            //Create Notification
            if($update == true){
                $response = sendNotification("Data material berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui data material sourcing, Material : ", NULL, $idMaterial, NULL);
            }

        }else{
            $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, documentReq = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($materialCategory, $materialName, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $documentReq, $idMaterial));
        
            //Create Notification
            if($update == true){
                $response = sendNotification("Data material berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui data riwayat material sourcing, Material : ", $sourcingNumber, $idMaterial, NULL);
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
            $response = sendNotification("Status Sourcing berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui status sourcing, Material : ", NULL, $idMaterial, NULL);
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
            $response = sendNotification("Summary Report berhasil diperbaharui!!", trim(strip_tags($_POST['materialName'])), "memperbaharui sumary repory sourcing, Material : ", NULL, $idMaterial, NULL);
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
            $response = sendNotification("Material Berhasil Di Hapus!!", $materialName, "menghapus riwayat sourcing, Material : ", NULL, NULL, NULL);
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
            $response = sendNotification("Feedback Team Leader Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui Feedback Team Leader, Material : ", $sourcingNumber, $idMaterial, NULL);
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
            $response = sendNotification("Feedback RPIC Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui Feedback RPIC, Material : ", $sourcingNumber, $idMaterial, NULL);
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
            $response = sendNotification("Status Riwayat Berhasil diperbaharui!", trim(strip_tags($_POST['materialName'])), "memperbaharui status riwayat, Material : ", $sourcingNumber, $idMaterial, NULL);
        }

        echo json_encode($response);
        exit();
    }


    // Function For Send Nofitication
    function sendNotification($responseInfo, $subject, $message, $sourcingNumber, $idMaterial, $idSupplier){
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
            $user = $conn->query("SELECT id FROM TB_Admin")->fetchAll();
            $idNotification = $conn->query("SELECT id FROM TB_Notifications WHERE randomId='".$randomId."'")->fetchAll();
            for($i = 0; $i < $totalUser[0]['total']; $i++){
                $sql = "INSERT INTO TB_StatusNotifications (readingStatus, notifStatus, idUser, idNotification, randomIdNotification, created) 
                VALUES (?,?,?,?,?,?)";
                $params = array(
                    0,
                    0,
                    $user[$i]['id'],
                    $idNotification[0]['id'],
                    $randomId,
                    $dateNotif,
                );
                $query = $conn->prepare($sql)->execute($params);
            }
        }

        return $response;
    }
?>