<?php
    include "../dbConfig.php";

    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }


    // Kondisi untuk meng-handle upload document
    if(isset($_FILES['file'])){
        // File Upload Folder
        $uploadDir = $_SERVER['DOCUMENT_ROOT']."/sourcing/assets/uploads/";

        // Periksa folder
        if(!is_dir($uploadDir)){
        // Buat folder jika tidak ada
            mkdir($uploadDir, 0777, true);
        }

        // Allows file types
        $allowTypes = array('pdf');

        // Default reponse
        $response = array(
            'status' => 1,
            'message' => 'Gagal menyimpan file, silahkan coba lagi',
        );

        // Upload File
        $uploadedFile = '';
        if(!empty($_FILES['file']['name'])){
            // File path config
            $tgl = date("Y-m-d H:i:s");
            $fileName = basename($_FILES['file']['name']);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileHash = md5($fileName.$tgl).'.'.$fileType;
            $targetFilePath = $uploadDir . $fileHash;
            //Allow certain file formats to upload 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to the server 
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                    $uploadedFile = $fileName; 
                    $response['message'] = 'Berhasil Mengupload File';
                    $response['status'] = 0;
                    $uploadStatus = 1; 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, there was an error uploading your file.'; 
                } 
            }else{ 
                $uploadStatus = 0; 
                $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
            } 
        }
        
        if($uploadStatus == 1){ 
            // Include the database config file 
            $idSupplier = $_POST['idSupplier'];
            $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

            // Cek Apakah data Supplier tersedia
            if($dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
                // Handle Add Data File Upload To Database Tabel TB_File
                try{
                    $sql = "INSERT INTO TB_File (fileName, fileHash, idSupplier) 
                    VALUES (?,?,?)";
                    $params = array(
                        $fileName,
                        $fileHash,
                        $idSupplier,
                    );
                    $query = $conn->prepare($sql);
                    $insert = $query->execute($params);

                    // Send Notifikasi
                    if($insert == true){
                        sendNotification(NULL, $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "menambahkan document requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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
        }
        else{ 
            $response['message'] = 'Gagal menyimpan file, silahkan coba lagi.'; 
        } 

        //Return response 
        echo json_encode($response);
    }

    if(($_REQUEST['actionType'] == 'delete') && !empty($_GET['idFile'])){
        $idFile = $_GET['idFile'];
        $idSupplier = $_GET['idSupplier'];
        $file = $conn->query("SELECT fileHash FROM TB_File WHERE id='{$idFile}'")->fetchAll();
        $filePath = $_SERVER['DOCUMENT_ROOT']."/sourcing/assets/uploads/".$file[0]['fileHash'];
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();
        //Delete data in folder php
        unlink($filePath);

        // Cek Apakah data Supplier tersedia
        if($dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){

            // Handle Delete Data File Upload To Database Tabel TB_File
            try{
                $sql = "DELETE FROM TB_File WHERE id = ?"; 
                $query = $conn->prepare($sql); 
                $delete = $query->execute(array($idFile));
            }catch(Exception $e){
                $response = array(
                    "status" => 1,
                    "message" => "Data tidak dapat disimpan!",
                );
            }

            // Send Notifikasi
            if($delete == true){
                $response = sendNotification("Berhasil menghapus File!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "menghapus document requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
            }
        
        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
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