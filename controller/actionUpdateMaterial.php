<?php
    include "../dbConfig.php";

    session_start();
    
    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    // Kondisi untuk meng-handle mengedit material
    if(isset($_POST['editMaterial'])){
        //Mengambil data dan memformat data
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialName = trim(strip_tags($_POST['materialName']));
        $priority = trim(strip_tags($_POST['priority']));
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));
        $vendorAERO = trim(strip_tags($_POST['vendorAERO']));
        $documentReq = trim(strip_tags($_POST['documentReq']));

        // Variabel untuk pengecekan data material
        $checkValue = $conn->query("SELECT materialCategory, materialName, materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, priority, vendorAERO, documentReq FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll();

        $getMaterialName = $checkValue[0]['materialName'];

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

        // Check apakah data material tersedia
        if($conn->query("SELECT * FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){
            // Check and Validation Material Category
            if(!empty($materialCategory)){
                if($materialCategory != $checkValue[0]['materialCategory']){
                    $changeMaterialCategory = " Material Category,";
                }else{
                    $changeMaterialCategory = "";
                }
            }else{
                $materialCategory = "-";
            }
    
            // Check and Validation Material Name
            if(!empty($materialName)){
                if($materialName != $checkValue[0]['materialName']){
                    $changeMaterialName = " Material Name,";
                }else{
                    $changeMaterialName = "";
                }
            }else{
                $materialName = "-";
            }
    
            // Check and Validation Spesification
            if(!empty($materialSpesification)){
                if($materialSpesification != $checkValue[0]['materialSpesification']){
                    $changeMaterialSpesification = " Spesification,";
                }else{
                    $changeMaterialSpesification = "";
                }
            }else{
                $materialSpesification = "-";
            }
    
            // Check and Validation Catalog Or Cas Number
            if(!empty($catalogOrCasNumber)){
                if($catalogOrCasNumber != $checkValue[0]['catalogOrCasNumber']){
                    $changeCatalogOrCasNumber = " Catalog Or Cas Number,";
                }else{
                    $changeCatalogOrCasNumber = "";
                }
            }else{
                $catalogOrCasNumber = "-";
            }
    
            // Check and Validation Company
            if(!empty($company)){
                if($company != $checkValue[0]['company']){
                    $changeCompany = " Company,";
                }else{
                    $changeCompany = "";
                }
            }else{
                $company = "-";
            }
    
            // Check and Validation Website
            if(!empty($website)){
                if($website != $checkValue[0]['website']){
                    $changeWebsite = " Website,";
                }else{
                    $changeWebsite = "";
                }
            }else{
                $website = "-";
            }
    
            // Check and Validation Finish Dossage Form
            if(!empty($finishDossageForm)){
                if($finishDossageForm != $checkValue[0]['finishDossageForm']){
                    $changeFinishDossageForm = " Finish Dossage Form,";
                }else{
                    $changeFinishDossageForm = "";
                }
            }else{
                $finishDossageForm = "-";
            }
    
            // Check and Validation Keterangan
            if(!empty($keterangan)){
                if($keterangan != $checkValue[0]['keterangan']){
                    $changeKeterangan = " Keterangan,";
                }else{
                    $changeKeterangan = "";
                }
            }else{
                $keterangan = "-";
            }
    
            // Check and Validation Document Req
            if(!empty($documentReq)){
                if($documentReq != $checkValue[0]['documentReq']){
                    $changeDocumentReq = " Document Requirement,";
                }else{
                    $changeDocumentReq = "";
                }
            }else{
                $documentReq = "-";
            }
    
           
            // Kondisi dimana ada data priority dan vendorAERO
            if(!empty($priority) || !empty($vendorAERO)){
                // Check and Validation Priority
                if(!empty($priority)){
                    if($priority != $checkValue[0]['priority']){
                        $changePriority = " Priority,";
                    }else{
                        $changePriority = "";
                    }
                }else{
                    $priority = "-";
                }
    
                // Check and Validation Vendor
                if(!empty($vendorAERO)){
                    if($vendorAERO != $checkValue[0]['vendorAERO']){
                        $changeVendor = " Vendor AERO,";
                    }else{
                        $changeVendor = "";
                    }
                }else{
                    $vendorAERO = "-";
                }
                
                // Handle Update Data Material Sourcing To Database Tabel TB_PengajuanSourcing
                try{
                    $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, priority = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, vendorAERO = ?, documentReq = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($materialCategory, $materialName, $priority, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $vendorAERO, $documentReq, $idMaterial));
        
                    $message = "memperbaharui data material : ".$changeMaterialCategory.$changeMaterialName.$changePriority.$changeMaterialSpesification.$changeCatalogOrCasNumber.$changeCompany.$changeWebsite.$changeFinishDossageForm.$changeKeterangan.$changeVendor.$changeDocumentReq." pada material sourcing : ";
        
                    //Create Notification
                    if($update == true){
                        $response = sendNotification("Data material berhasil diperbaharui!!", $getMaterialName, $message, NULL, $idMaterial, NULL, NULL);
                    }
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }
                
    
            }else{

                // Handle Update Data Material Riwayat To Database Tabel TB_PengajuanSourcing
                try{
                    $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialName = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ?, documentReq = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($materialCategory, $materialName, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $documentReq, $idMaterial));
                
                    $message = "memperbaharui data riwayat : ".$changeMaterialCategory.$changeMaterialName.$changeMaterialSpesification.$changeCatalogOrCasNumber.$changeCompany.$changeWebsite.$changeFinishDossageForm.$changeKeterangan.$changeDocumentReq." pada material sourcing : ";
        
                    //Create Notification
                    if($update == true){
                        $response = sendNotification("Data material berhasil diperbaharui!!", $getMaterialName, $message, $sourcingNumber, $idMaterial, NULL, true);
                    }
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }

            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }
       
        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle mengedit status sourcing
    if(isset($_POST['statusSourcing'])){
        // Mengambil dan memformat data
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $statusSourcing = trim(strip_tags($_POST['statusSourcing']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Update Data Status Sourcing To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "UPDATE TB_PengajuanSourcing SET statusSourcing = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($statusSourcing, $idMaterial));

                //Send Notification
                if($update == true){
                    $response = sendNotification("Status Sourcing berhasil diperbaharui!!", $materialName[0]['materialName'], "memperbaharui status sourcing, Material : ", NULL, $idMaterial, NULL, NULL);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }
        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle mengedit sumary report
    if(isset($_POST['sumaryReport'])){
        // Mengambil data dan memformat data
        $dateSumaryReport = date("d M Y");
        $sumaryReport = trim(strip_tags($_POST['sumaryReport']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Update Data Sumary Report To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "UPDATE TB_PengajuanSourcing SET dateSumaryReport = ?, sumaryReport = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($dateSumaryReport, $sumaryReport, $idMaterial));

                //Send Notification
                if($update == true){
                    $response = sendNotification("Summary Report berhasil diperbaharui!!", $materialName[0]['materialName'], "memperbaharui sumary repory sourcing, Material : ", NULL, $idMaterial, NULL, NULL);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }
        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle menghapus material riwayat
    if(isset($_GET['actionType'])){
        // Mengambil data dan memformat data
        $idMaterial = trim(strip_tags($_GET['idMaterial']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Delete Data Naterial Riwayat To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?";
                $query = $conn->prepare($sql);
                $delete = $query->execute(array($idMaterial));

                //Send Notification
                if($delete == true){
                    $response = sendNotification("Material Berhasil Di Hapus!!", $materialName[0]['materialName'], "menghapus riwayat sourcing, Material : ", NULL, NULL, NULL, true);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }

        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle mengedit feedback team leader
    if(isset($_POST['feedbackTL'])){
        // Mengambil data dan memformat data
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackTL = trim(strip_tags($_POST['feedbackTL']));
        $dateApprovedTL = date("d F Y");
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Update Data Feedback Team Leader To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "UPDATE TB_PengajuanSourcing SET feedbackTL = ?, dateApprovedTL = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array("$feedbackTL", $dateApprovedTL, $idMaterial));

                //Send Notification
                if($update == true){
                    $response = sendNotification("Feedback Team Leader Berhasil diperbaharui!", $materialName[0]['materialName'], "memperbaharui Feedback Team Leader, Material : ", $sourcingNumber, $idMaterial, NULL, true);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }

        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle mengedit feedback RPIC
    if(isset($_POST['feedbackRPIC'])){
        // Mengambil data dan memformat data
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $feedbackRPIC = trim(strip_tags($_POST['feedbackRPIC']));
        $dateAcceptedRPIC = date("d F Y");
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Update Data Feedback RPIC To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "UPDATE TB_PengajuanSourcing SET feedbackRPIC = ?, dateAcceptedRPIC = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($feedbackRPIC, $dateAcceptedRPIC, $idMaterial));

                //Send Notification
                if($update == true){
                    $response = sendNotification("Feedback RPIC Berhasil diperbaharui!", $materialName[0]['materialName'], "memperbaharui Feedback RPIC, Material : ", $sourcingNumber, $idMaterial, NULL, true);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
        }

        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle mengedit status riwayat
    if(isset($_POST['statusRiwayat'])){
        // Mengambil data dan memformat data
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
        $statusRiwayat = trim(strip_tags($_POST['statusRiwayat']));
        $sourcingNumber = trim(strip_tags($_POST['sourcingNumber']));

        // Check apakah data material tersedia atau tidak
        if($materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll()){

            // Handle Update Data Status Riwayat To Database Tabel TB_PengajuanSourcing
            try{
                $sql = "UPDATE TB_PengajuanSourcing SET statusRiwayat = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($statusRiwayat, $idMaterial));

                //Send Notification
                if($update == true){
                    $response = sendNotification("Status Riwayat Berhasil diperbaharui!", $materialName[0]['materialName'], "memperbaharui status riwayat, Material : ", $sourcingNumber, $idMaterial, NULL, true);
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            // Response Error
            $response = array (
                "status" => 1,
                "message" => "Data material tidak ditemukan!",
            );
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
            // Jika user level sama dengan 4, maka tidak akan dikirimkan status
            if($dontSendLevel4 == true){
                $sql = "UPDATE TB_StatusNotifications SET notifStatus = 1, readingStatus = 1 WHERE levelUser = 4 AND randomIdNotification = '".$randomId."'";
                $query = $conn->prepare($sql)->execute();
            }
            // Untuk user yang melakukan aksi tidak dikirimkan notifikasi
            $sql = "UPDATE TB_StatusNotifications SET notifStatus = 1, readingStatus = 1 WHERE idUser = ".$_SESSION['user']['id']." AND randomIdNotification = '".$randomId."'"; 
            $query = $conn->prepare($sql)->execute();
        }

        return $response;
    }
?>