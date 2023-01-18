<?php
    include "../dbConfig.php";

    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    if(isset($_POST['idSupplier'])){
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = trim(strip_tags($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));

        $checkValue = $conn->query("SELECT supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
        $changeSupplier = "";
        $changeManufacture = "";
        $changeOriginCountry = "";
        $changeLeadTime = "";
        $changeCatalogOrCasNumber = "";
        $changeGradeOrReference = "";
        $changeDocumentInfo = "";

        if(!empty($manufacture)){
            if($manufacture != $checkValue[0]['manufacture']){
                $changeManufacture = ", manufacture";
            }else{
                $changeManufacture = "";
            }
        }else{
            $manufacture = "-";
        }

        if(!empty($originCountry)){
            if($originCountry != $checkValue[0]['originCountry']){
                $changeOriginCountry = ", Origin Country";
            }else{
                $changeOriginCountry = "";
            }
        }else{
            $originCountry = "-";
        }

        if(!empty($leadTime)){
            if($leadTime != $checkValue[0]['leadTime']){
                $changeLeadTime = ", Lead Time";
            }else{
                $changeLeadTime = "";
            }
        }else{
            $leadTime = "-";
        }

        if(!empty($catalogOrCasNumber)){
            if($catalogOrCasNumber != $checkValue[0]['catalogOrCasNumber']){
                $changeCatalogOrCasNumber = ", Catalog Or Cas Number";
            }else{
                $changeCatalogOrCasNumber = "";
            }
        }else{
            $catalogOrCasNumber = "-";
        }

        if(!empty($gradeOrReference)){
            if($gradeOrReference != $checkValue[0]['gradeOrReference']){
                $changeGradeOrReference = ", Grade Or Reference";
            }else{
                $changeGradeOrReference = "";
            }
        }else{
            $gradeOrReference = "-";
        }

        if(!empty($documentInfo)){
            if($documentInfo != $checkValue[0]['documentInfo']){
                $changeDocumentInfo = ", Document Info";
            }else{
                $changeDocumentInfo = "";
            }
        }else{
            $documentInfo = "-";
        }

        if(!empty($supplier)){
            if($supplier != $checkValue[0]['supplier']){
                $changeSupplier = ", supplier";
            }else{
                $changeSupplier = "";
            }


            if($conn->query("SELECT * FROM TB_MasterVendor WHERE vendorName = '".$supplier."'")->fetchAll()){
                $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
                
                // Send Notifikasi
                if($update == true){
                    $message = "mengedit data".$changeSupplier.$changeManufacture.$changeOriginCountry.$changeLeadTime.$changeCatalogOrCasNumber.$changeGradeOrReference.$changeDocumentInfo.". Pada supplier : ";
                    $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                    $response = sendNotification("Supplier berhasil diedit!!", $dataSupplier[0]['supplier'], $message, NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
                }
            }else{
                // Memasukan data vendor ke database
                $sqlAddVendor = "INSERT INTO TB_MasterVendor (vendorName) 
                VALUES (?)";
                $paramsAddVendor = array(
                    $supplier
                );
                $queryAddVendor = $conn->prepare($sqlAddVendor);
                $insertAddVendor =  $queryAddVendor->execute($paramsAddVendor);

                if($insertAddVendor == true){
                    $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
                    $query = $conn->prepare($sql);
                    $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
                
                    // Send Notifikasi
                    if($update == true){
                        $message = "mengedit data".$changeSupplier.$changeManufacture.$changeOriginCountry.$changeLeadTime.$changeCatalogOrCasNumber.$changeGradeOrReference.$changeDocumentInfo.". Pada supplier : ";
                        $dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();
                        $response = sendNotification("Supplier berhasil diedit!!", $dataSupplier[0]['supplier'], $message, NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
                    }
                }
            }
        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier wajib di isi!!"
            );
        }

        echo json_encode($response);
    }

    if(isset($_POST['addDetail'])){
        $MoQ = trim(strip_tags($_POST['MoQ']));
        $UoM = trim(strip_tags($_POST['UoM']));
        $price = trim(strip_tags($_POST['price']));
        $hardCash = trim(strip_tags($_POST['hardCash']));
        $quantity = trim(strip_tags($_POST['quantity']));
        $idSupplier = trim(strip_tags($_POST['id']));

        $priceDetail = $hardCash.$price.$quantity;

        $sql = "INSERT INTO TB_DetailSupplier (MoQ, UoM, price, idSupplier) 
        VALUES (?,?,?,?)";
        $params = array(
            $MoQ,
            $UoM,
            $priceDetail,
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

    // Kondisi saat menghapus detail Supplier
    if(($_REQUEST['actionType'] == 'delete') && !empty($_GET['idDetailSupplier'])){
        $idDetailMaterial = $_GET['idDetailSupplier'];
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
        // $response = $_GET['idSupplier'];
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
            $sql = "UPDATE TB_StatusNotifications SET notifStatus = 1, readingStatus = 1 WHERE idUser = ".$_SESSION['user']['id']." AND idNotification = ".$idNotification[0]['id']; 
            $query = $conn->prepare($sql)->execute();
        }

        return $response;
    }
?>