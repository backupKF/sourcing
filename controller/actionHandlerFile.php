<?php
    include "../dbConfig.php";

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

        $uploadStatus = 1; 
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
            if($update == true || $insert == true){
                $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                $subject = $dataMaterial[0]['supplier']; 
                $message = "menambahkan document requirement, Supplier : ";
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
        }
        else{ 
            $response['message'] = 'Please fill all the mandatory fields (name and email).'; 
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

        // $delete = true;

        // Send Notifikasi
        if($delete == true){
            $response = array(
                "status" => 0,
                "message" => "Berhasil menghapus File!!", 
            );
            $dataMaterial = $conn->query("SELECT idMaterial, supplier FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
            $subject = $dataMaterial[0]['supplier']; 
            $message = "menghapus document requirement, Supplier : ";
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