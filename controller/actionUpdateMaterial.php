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
        
             // Send Notifikasi
            if($update == true){
                $response = array(
                    "status" => 0,
                    "message" => "Data material berhasil diperbaharui!!", 
                );
                $subject = trim(strip_tags($_POST['materialName'])); 
                $message = "memperbaharui data material sourcing, Material : ";
                $person = $_SESSION['user']['name'];
                $dateNotif = date("Y-m-d H:i:s");

                $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idMaterial, created) 
                VALUES (?,?,?,?,?,?)";
                $params = array(
                    $subject,
                    $message,
                    $person,
                    0,
                    $idMaterial,
                    $dateNotif,
                );
                $query = $conn->prepare($sql);
                $insert = $query->execute($params);
            }

        }else{
            $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, documentReq = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($materialCategory, $materialName, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $documentReq, $idMaterial));
        
             // Send Notifikasi
            if($update == true){
                $response = array(
                    "status" => 0,
                    "message" => "Data material berhasil diperbaharui!!", 
                );
                $subject = trim(strip_tags($_POST['materialName'])); 
                $message = "memperbaharui data riwayat material sourcing, Material : ";
                $person = $_SESSION['user']['name'];
                $dateNotif = date("Y-m-d H:i:s");

                $sql = "INSERT INTO TB_Notifications (subject,message, person, status, sourcingNumber, idMaterial, created) 
                VALUES (?,?,?,?,?,?,?)";
                $params = array(
                    $subject,
                    $message,
                    $person,
                    0,
                    $sourcingNumber,
                    $idMaterial,
                    $dateNotif,
                );
                $query = $conn->prepare($sql);
                $insert = $query->execute($params);
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
            $response = array(
                "status" => 0,
                "message" => "Status Sourcing berhasil diperbaharui!!", 
            );
            $subject = trim(strip_tags($_POST['materialName'])); 
            $message = "memperbaharui status sourcing, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idMaterial, created) 
            VALUES (?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
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
            $response = array(
                "status" => 0,
                "message" => "Summary Report berhasil diperbaharui!!", 
            );
            $subject = trim(strip_tags($_POST['materialName'])); 
            $message = "memperbaharui sumary repory sourcing, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idMaterial, created) 
            VALUES (?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }
       
        echo json_encode($response);
        exit();
    }

    if(isset($_GET['actionType'])){
        $idMaterial = $_GET['idMaterial'];

        $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?";
        $query = $conn->prepare($sql);
        $delete = $query->execute(array($idMaterial));

         //Send Notification
         if($delete == true){
            $response = array(
                "status" => 0,
                "message" => "Material Berhasil Di Hapus!!", 
            );
            $subject = trim(strip_tags($_GET['materialName']));
            $message = "menghapus riwayat sourcing, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, created) 
            VALUES (?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['feedbackTL'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackTL = trim(strip_tags($_POST['feedbackTL']));
        $dateApprovedTL = date("Y-m-d");

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackTL = ?, dateApprovedTL = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackTL, $dateApprovedTL, $idMaterial));

        //Send Notification
        if($update == true){
            $response = array(
                "status" => 0,
                "message" => "Feedback Team Leader Berhasil diperbaharui!", 
            );
            $subject = trim(strip_tags($_POST['materialName']));
            $sourcingNumber = $_POST['sourcingNumber'];
            $message = "memperbaharui Feedback Team Leader, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, sourcingNumber, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $sourcingNumber,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['feedbackRPIC'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackRPIC = trim(strip_tags($_POST['feedbackRPIC']));
        $dateAcceptedRPIC = date("Y-m-d");

        $sql = "UPDATE TB_PengajuanSourcing SET feedbackRPIC = ?, dateAcceptedRPIC = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($feedbackRPIC, $dateAcceptedRPIC, $idMaterial));

        //Send Notification
        if($update == true){
            $response = array(
                "status" => 0,
                "message" => "Feedback RPIC Berhasil diperbaharui!", 
            );
            $subject = trim(strip_tags($_POST['materialName'])); 
            $sourcingNumber = $_POST['sourcingNumber'];
            $message = "memperbaharui Feedback RPIC, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, sourcingNumber, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $sourcingNumber,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
        exit();
    }

    if(isset($_POST['statusRiwayat'])){
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $statusRiwayat = trim(strip_tags($_POST['statusRiwayat']));

        $sql = "UPDATE TB_PengajuanSourcing SET statusRiwayat = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($statusRiwayat, $idMaterial));

        //Send Notification
        if($update == true){
            $response = array(
                "status" => 0,
                "message" => "Status Riwayat Berhasil diperbaharui!", 
            );
            $subject = trim(strip_tags($_POST['materialName'])); 
            $sourcingNumber = $_POST['sourcingNumber'];
            $message = "memperbaharui status riwayat, Material : ";
            $person = $_SESSION['user']['name'];
            $dateNotif = date("Y-m-d H:i:s");

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, sourcingNumber, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $sourcingNumber,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
        exit();
    }
?>