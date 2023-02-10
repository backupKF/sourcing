<?php
    include "../dbConfig.php";

    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    // Kondisi untuk meng-handle feedback document requirement
    if(isset($_POST['feedbackDocReq'])){
        //Mengambil data dan memformat data
        $CoA = trim(strip_tags($_POST['CoA']));
        $MSDS = trim(strip_tags($_POST['MSDS']));
        $MoA = trim(strip_tags($_POST['MoA']));
        $Halal = trim(strip_tags($_POST['Halal']));
        $DMF = trim(strip_tags($_POST['DMF']));
        $GMP = trim(strip_tags($_POST['GMP']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $idFeedbackDocReq = trim(strip_tags($_POST['idFeedbackDocReq']));
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Cek Apakah data Supplier tersedia
        if($conn->query("SELECT * FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Jika id feedback doc req ditemukan
            if(!empty($idFeedbackDocReq)){
                // Handle Update Data Feedback Doc Req To Database Tabel TB_FeedbackDocReq
                try{
                    $sql = "UPDATE TB_FeedbackDocReq SET CoA = ?, MSDS = ?, MoA = ?, Halal = ?, DMF = ?, GMP = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($CoA, $MSDS, $MoA, $Halal, $DMF, $GMP, $idFeedbackDocReq));
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }
            }else{
                // Jika id feedback doc req tidak ditemukan
                // Handle Add Data Feedback Doc Req To Database Tabel TB_FeedbackDocReq
                try{
                     $sql = "INSERT INTO TB_FeedbackDocReq (CoA, MSDS, MoA, Halal, DMF, GMP, idSupplier) 
                    VALUES (?,?,?,?,?,?,?)";
                    $params = array(
                        $CoA,
                        $MSDS,
                        $MoA,
                        $Halal,
                        $DMF,
                        $GMP,
                        $idSupplier,
                    );
                    $query = $conn->prepare($sql);
                    $insert = $query->execute($params);
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }
            }
    
            // Send Notifikasi
            if($update == true || $insert == true){
                $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                $response = sendNotification("Feedback document requirement berhasil diperbaharui!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "memperbaharui Feedback Document Requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
            }

        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
        }

        echo json_encode($response);
    }

    // Kondisi untuk meng-handle feedback rnd
    if(isset($_POST['feedbackRnd'])){
        //Mengambil data dan memformat data
        $priceReview = trim(strip_tags($_POST['priceReview']));
        $dateFeedback = date("Y-m-d");
        $sampel = trim(strip_tags($_POST['sampel']));
        $writer = $_SESSION['user']['name'];
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Cek Apakah data Supplier tersedia
        if($conn->query("SELECT * FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Kondisi untuk meng-handle price review
            if($priceReview){
                // Handle Update Data Feedback Rnd Price Review To Database Tabel TB_Supplier
                try{
                    $sql = "UPDATE TB_Supplier SET feedbackRndPriceReview = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($priceReview, $idSupplier));
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }
            }
            
            // Kondisi untuk menghandle sampel
            if($sampel){
                // Handle Update Data Detail Feedback Rnd To Database Tabel TB_DetailFeedbackRnd
                try{
                    $sql = "INSERT INTO TB_DetailFeedbackRnd (dateFeedback, sampel, writer, idSupplier) 
                    VALUES (?,?,?,?)";
                    $params = array(
                        $dateFeedback,
                        $sampel,
                        $writer,
                        $idSupplier,
                    );
                    $query = $conn->prepare($sql);
                    $insert = $query->execute($params);
                }catch(Exception $e){
                    $response = array(
                        "status" => 1,
                        "message" => "Data tidak dapat disimpan!",
                    );
                }
            }

            // Send Notifikasi
            if($update == true || $insert == true){
                $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                $response = sendNotification("Feedback R&D berhasil diperbaharui!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "memperbaharui Feedback R&D, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
            }

        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
        }

        echo json_encode($response);
    }

    // Kondisi untuk meng-handle feedback proc
    if(isset($_POST['feedbackProc'])){
        //Mengambil data dan memformat data
        $dateFeedback = date("Y-m-d");
        $feedback = trim(strip_tags($_POST['feedback']));
        $writer = $_SESSION['user']['name'];
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();
        
        // Cek Apakah data Supplier tersedia
        if($conn->query("SELECT * FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Handle Update Data Feedback Proc To Database Tabel TB_FeedbackProc
            try{
                $sql = "INSERT INTO TB_FeedbackProc (dateFeedbackProc, feedback, writer, idSupplier) 
                VALUES (?,?,?,?)";
                $params = array(
                    $dateFeedback,
                    $feedback,
                    $writer,
                    $idSupplier,
                );
                $query = $conn->prepare($sql);
                $insert = $query->execute($params);
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

            // Send Notifikasi
            if($insert == true){
                $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                $response = sendNotification("Feedback Proc berhasil diperbaharui!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")",  "memperbaharui Feedback Proc, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
            }

        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
        }

        echo json_encode($response);
    }

    // Kondisi untuk meng-handle final feedback rnd
    if(isset($_POST['formFinalFeedbackRnd'])){
        //Mengambil data dan memformat data
        $finalFeedbackRnd = trim(strip_tags($_POST['finalFeedbackRnd']));
        $dateFinalFeedbackRnd = date("Y-m-d");
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $writerFinalFeedbackRnd = $_SESSION['user']['name'];
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Cek Apakah data Supplier tersedia
        if($conn->query("SELECT * FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Handle Update Data Final Feedback Rnd To Database Tabel TB_Supplier
            try{
                $sql = "UPDATE TB_Supplier SET dateFinalFeedbackRnd = ?, finalFeedbackRnd = ?, writerFinalFeedbackRnd = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($dateFinalFeedbackRnd, $finalFeedbackRnd, $writerFinalFeedbackRnd, $idSupplier));

                if($update == true){
                    $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                    $response = sendNotification("Final Feeedback Rnd berhasil diperbaharui!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "memperbaharui Final Feedback R&D, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
                }else{
                    $response = array(
                        "status" => 0,
                        "message" => "Terjadi kesalahan saat memperbaharui Feedback!",
                    );
                }
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
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
            // Untuk user yang melakukan aksi tidak dikirimkan notifikasi
            $sql = "UPDATE TB_StatusNotifications SET notifStatus = 1, readingStatus = 1 WHERE idUser = ".$_SESSION['user']['id']." AND randomIdNotification = '".$randomId."'"; 
            $query = $conn->prepare($sql)->execute();
        }

        return $response;
    }
?>