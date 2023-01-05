<?php
    include "../dbConfig.php";

    session_start();

    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

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
            'status' => 0,
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
            // Insert form data in the database 
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
                $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                sendNotification(NULL, $dataSupplier[0]['supplier'], "menambahkan document requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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
        //Delete data in folder php
        unlink($filePath);

        //Delete data from SQL server 
        $sql = "DELETE FROM TB_File WHERE id = ?"; 
        $query = $conn->prepare($sql); 
        $delete = $query->execute(array($idFile));

        // Send Notifikasi
        if($delete == true){
            $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $response = sendNotification("Berhasil menghapus File!!", $dataSupplier[0]['supplier'], "menghapus document requirement, Supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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
                $sql = "INSERT INTO TB_StatusNotifications (readingStatus, notifStatus, idUser, idNotification, created) 
                VALUES (?,?,?,?,?)";
                $params = array(
                    0,
                    0,
                    $user[$i]['id'],
                    $idNotification[0]['id'],
                    $dateNotif,
                );
                $query = $conn->prepare($sql)->execute($params);
            }
        }

        return $response;
    }
?>