<?php
    include "../dbConfig.php";

    session_start();

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

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
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Supplier berhasil diedit!!", $dataSupplier[0]['supplier'], "mengedit supplier :  ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Berhasil memasukan detail supplier!!", $dataSupplier[0]['supplier'] , "menambahkan detail supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Berhasil menghapus detail supplier!!", $dataSupplier[0]['supplier'], "menghapus detail supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
        }

        echo json_encode($response);
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