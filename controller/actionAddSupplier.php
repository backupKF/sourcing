<?php
    include "../dbConfig.php";

    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
        exit();
    }

    // Kondisi untuk meng-handle data POST Set New Vendor
    if(isset($_POST['setNewVendor'])){
        echo json_encode($_POST['setNewVendor']);
        exit();
    }

    // Kondisi untuk meng-handle data POST Set Vendor
    if(isset($_POST['setVendor'])){
        echo json_encode($_POST['setVendor']);
        exit();
    }

    // Kondisi untuk meng-handle tambah supplier
    if(isset($_POST['addSupplier'])){
        // mengisi variabel dengan data POST
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = trim(strip_tags($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idMaterial = trim(strip_tags($_POST['idMaterial']));

        // Melakukan pengecekan data
        if(empty($manufacture)){
            $manufacture = '-';
        }
        if(empty($originCountry)){
            $originCountry = '-';
        }
        if(empty($leadTime)){
            $leadTime = '-';
        }
        if(empty($catalogOrCasNumber)){
            $catalogOrCasNumber = '-';
        }
        if(empty($gradeOrReference)){
            $gradeOrReference = '-';
        }
        if(empty($documentInfo)){
            $documentInfo = '-';
        }
        
        if(!empty($supplier)){
            // Handle Add Data Supplier To Database Tabel TB_Supplier
            try{
                $sql = "INSERT INTO TB_Supplier (supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, idMaterial, created) 
                VALUES (?,?,?,?,?,?,?,?,?)";
                    $params = array(
                    $supplier,
                    $manufacture,
                    $originCountry,
                    $leadTime,
                    $catalogOrCasNumber,
                    $gradeOrReference,
                    $documentInfo,
                    $idMaterial,
                    date("Y-m-d H:i:s")
                );
                $query = $conn->prepare($sql);
                $insert = $query->execute($params);
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

            //Send Notification
            if($insert == true){
                $materialName = $conn->query("SELECT materialName FROM TB_PengajuanSourcing WHERE id = ".$idMaterial)->fetchAll();
                // Mengirim Notifikasi
                $response = sendNotification("Supplier behasil ditambahkan!!", $materialName[0]['materialName'], "menambahkan supplier material sourcing : ", NULL, $idMaterial, NULL);
            }
        }else{
            $response = array(
                "status" => 2,
                "message" => "Data supplier wajib di isi!!"
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