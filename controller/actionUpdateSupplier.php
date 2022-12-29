<?php
    header("HTTP/1.1 403 Forbidden" );

    include "../dbConfig.php";

    if(isset($_POST['idSupplier'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = date('Y-m-d', strtotime($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
    
        // Send Notifikasi
        if($update == true){
            $response = array(
                "status" => 0,
                "message" => "Supplier berhasil diedit!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $supplier; 
            $message = "mengedit supplier :  ";
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

    if(isset($_POST['addDetail'])){
        $MoQ = trim(strip_tags($_POST['MoQ']));
        $UoM = trim(strip_tags($_POST['UoM']));
        $price = trim(strip_tags($_POST['price']));
        $idSupplier = trim(strip_tags($_POST['id']));

        $sql = "INSERT INTO TB_DetailSupplier (MoQ, UoM, price, idSupplier) 
        VALUES (?,?,?,?)";
        $params = array(
            $MoQ,
            $UoM,
            $price,
            $idSupplier,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);

        // Send Notifikasi
        if($insert == true){
            $response = array(
                "status" => 0,
                "message" => "Berhasil memasukan detail supplier!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "menambahkan detail supplier : ";
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

    // Sistem Hapus Detail Supplier
    if(($_REQUEST['actionType'] == 'delete') && !empty($_GET['id'])){
        $idDetailMaterial = $_GET['id'];
        $idSupplier = $_GET['idSupplier'];

        //Delete data from SQL server 
        $sql = "DELETE FROM TB_DetailSupplier WHERE idDetailSupplier = ?"; 
        $query = $conn->prepare($sql); 
        $delete = $query->execute(array($idDetailMaterial));
        
        // Send Notifikasi
        if($delete == true){
            $response = array(
                "status" => 0,
                "message" => "Berhasil menghapus detail supplier!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "menghapus detail supplier : ";
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
?>