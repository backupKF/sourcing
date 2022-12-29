<?php
    header("HTTP/1.1 403 Forbidden" );

    include "../dbConfig.php";

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
            $response = array(
                "status" => 0,
                "message" => "Feedback document requirement berhasil diperbaharui!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "memperbaharui Feedback Document Requirement, Supplier : ";
            $person = "Anonymous";
            $dateNotif = date("Y-m-d H:i:s");
            $idMaterial = $dataMaterial[0]['idMaterial'];

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idSupplier, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idSupplier,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
    }

    if(isset($_POST['feedbackRnd'])){
        $priceReview = trim(strip_tags($_POST['priceReview']));
        $dateFeedback = date("Y-m-d");
        $sampel = trim(strip_tags($_POST['sampel']));
        $writer = trim(strip_tags($_POST['writer']));
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
            $response = array(
                "status" => 0,
                "message" => "Feedback R&D berhasil diperbaharui!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "memperbaharui Feedback R&D, Supplier : ";
            $person = "Anonymous";
            $dateNotif = date("Y-m-d H:i:s");
            $idMaterial = $dataMaterial[0]['idMaterial'];

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idSupplier, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idSupplier,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }

        echo json_encode($response);
    }

    if(isset($_POST['feedbackProc'])){
        $dateFeedback = date("Y-m-d");
        $feedback = trim(strip_tags($_POST['feedback']));
        $writer = trim(strip_tags($_POST['writer']));
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
            $response = array(
                "status" => 0,
                "message" => "Feedback Proc berhasil diperbaharui!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "memperbaharui Feedback Proc, Supplier : ";
            $person = "Anonymous";
            $dateNotif = date("Y-m-d H:i:s");
            $idMaterial = $dataMaterial[0]['idMaterial'];

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idSupplier, idMaterial, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idSupplier,
                $idMaterial,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
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
            $response = array(
                "status" => 0,
                "message" => "Final Feeedback Rnd berhasil diperbaharui!",
            );
            // Send Notifikasi
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $person = "Anonymous";
            $message = "memperbaharui Final Feedback R&D, Supplier : ";
            $dateNotif = date("Y-m-d H:i:s");
            $idMaterial = $dataMaterial[0]['idMaterial'];

            $sql = "INSERT INTO TB_Notifications (subject,message, person, status, idMaterial, idSupplier, created) 
            VALUES (?,?,?,?,?,?,?)";
            $params = array(
                $subject,
                $message,
                $person,
                0,
                $idMaterial,
                $idSupplier,
                $dateNotif,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }else{
            $response = array(
                "status" => 0,
                "message" => "Terjadi kesalahan saat memperbaharui Feedback!",
            );
        }
        echo json_encode($response);
        exit();
    }
?>