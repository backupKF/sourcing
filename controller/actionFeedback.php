<?php
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
    }

    if(isset($_POST['finalFeedbackRnd'])){
        // Check Input Final Feedback Rnd
        $finalFeedbackRnd = trim(strip_tags($_POST['finalFeedbackRnd']));
        if(empty($finalFeedbackRnd)){
            $response = array(
                "status" => 1,
                "message" => "Feedback Tidak Di Isi!",
            );
            echo json_encode($response);
            exit();
        }
        
        $dateFinalFeedbackRnd = date("Y-m-d");
        $idMaterial = trim(strip_tags($_POST['idMaterial']));
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
            $subject = trim(strip_tags($_POST['supplier'])); 
            $person = "Anonymous";
            $message = "memperbaharui Final Feedback R&D, Supplier : ";
            $dateNotif = date("Y-m-d H:i:s");

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