<?php
    include "../../dbConfig.php";

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
        $dateFinalFeedbackRnd = date("Y-m-d");
        $finalFeedbackRnd = trim(strip_tags($_POST['finalFeedbackRnd']));
        $idFinalFeedbackRnd = trim(strip_tags($_POST['idFinalFeedbackRnd']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        if(!empty($idFinalFeedbackRnd)){
            $sql = "UPDATE TB_FinalFeedbackRnd SET dateFinalFeedbackRnd = ?, finalFeedbackRnd = ? WHERE id = ?";
            $query = $conn->prepare($sql);
            $update = $query->execute(array($dateFinalFeedbackRnd, $finalFeedbackRnd, $idFinalFeedbackRnd));
        }else{
            $sql = "INSERT INTO TB_FinalFeedbackRnd (dateFinalFeedbackRnd, finalFeedbackRnd, idSupplier) 
            VALUES (?,?,?)";
            $params = array(
                $dateFinalFeedbackRnd,
                $finalFeedbackRnd,
                $idSupplier,
            );
            $query = $conn->prepare($sql);
            $insert = $query->execute($params);
        }
    }
?>