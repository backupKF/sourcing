<?php
    include "../dbConfig.php";

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['idMaterial'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = date('Y-m-d', strtotime($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        $sql = "INSERT INTO TB_Supplier (supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, idMaterial) 
        VALUES (?,?,?,?,?,?,?,?)";
        $params = array(
            $supplier,
            $manufacture,
            $originCountry,
            $leadTime,
            $catalogOrCasNumber,
            $gradeOrReference,
            $documentInfo,
            $idMaterial,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);

        //Send Notification
        if($insert == true){
            $response = array(
                "status" => 0,
                "message" => "Supplier behasil ditambahkan!!", 
            );
            $materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll();
            $subject = $materialName[0]['materialName']; 
            $message = "menambahkan supplier material sourcing : ";
            $person = "Anonymous";
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
    }
?>