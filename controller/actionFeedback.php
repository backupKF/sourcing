<?php
    include "../dbConfig.php";

    session_start();

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['feedbackDocReq'])){
        $CoA = trim(strip_tags($_POST['CoA']));
        $MSDS = trim(strip_tags($_POST['MSDS']));
        $MoA = trim(strip_tags($_POST['MoA']));
        $Halal = trim(strip_tags($_POST['Halal']));
        $DMF = trim(strip_tags($_POST['DMF']));
        $GMP = trim(strip_tags($_POST['GMP']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $idFeedbackDocReq = trim(strip_tags($_POST['idFeedbackDocReq']));

        if(!empty($idFeedbackDocReq)){
            $sql = "UPDATE TB_FeedbackDocReq SET CoA = ?, MSDS = ?, MoA = ?, Halal = ?, DMF = ?, GMP = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($CoA, $MSDS, $MoA, $Halal, $DMF, $GMP, $idFeedbackDocReq));
        }else{
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
        }

        // Send Notifikasi
        if($update == true || $insert == true){
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Feedback document requirement berhasil diperbaharui!!", $dataSupplier[0]['supplier'], "memperbaharui Feedback Document Requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
        }

        echo json_encode($response);
    }

    if(isset($_POST['feedbackRnd'])){
        $priceReview = trim(strip_tags($_POST['priceReview']));
        $dateFeedback = date("Y-m-d");
        $sampel = trim(strip_tags($_POST['sampel']));
        $writer = $_SESSION['user']['name'];
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        if($priceReview){
            $sql = "UPDATE TB_Supplier SET feedbackRndPriceReview = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($priceReview, $idSupplier));
        }
        
        if($sampel){
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
        }

        // Send Notifikasi
        if($update == true || $insert == true){
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Feedback R&D berhasil diperbaharui!!", $dataSupplier[0]['supplier'], "memperbaharui Feedback R&D, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
        }

        echo json_encode($response);
    }

    if(isset($_POST['feedbackProc'])){
        $dateFeedback = date("Y-m-d");
        $feedback = trim(strip_tags($_POST['feedback']));
        $writer = $_SESSION['user']['name'];
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        
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

        // Send Notifikasi
        if($insert == true){
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Feedback Proc berhasil diperbaharui!!", $dataSupplier[0]['supplier'],  "memperbaharui Feedback Proc, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
        }

        echo json_encode($response);
    }

    if(isset($_POST['formFinalFeedbackRnd'])){
        // Check Input Final Feedback Rnd
        $finalFeedbackRnd = trim(strip_tags($_POST['finalFeedbackRnd']));
        $dateFinalFeedbackRnd = date("Y-m-d");
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        $sql = "UPDATE TB_Supplier SET dateFinalFeedbackRnd = ?, finalFeedbackRnd = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($dateFinalFeedbackRnd, $finalFeedbackRnd, $idSupplier));

        if($update == true){
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Final Feeedback Rnd berhasil diperbaharui!", $dataSupplier[0]['supplier'], "memperbaharui Final Feedback R&D, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
        }else{
            $response = array(
                "status" => 0,
                "message" => "Terjadi kesalahan saat memperbaharui Feedback!",
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