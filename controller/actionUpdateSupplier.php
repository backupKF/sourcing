<?php
    include "../dbConfig.php";

    session_start();

    // me-forbidden jika tidak ada data POST atau GET yang masuk ke Halaman ini
    if(empty($_POST) && empty($_GET)){
        header('http/1.1 403 forbidden');
    }

    // Kondisi untuk meng-handle mengedit Supplier
    if(isset($_POST['idSupplier'])){
        //Mengambil data dan memformat data
        $supplier = trim(strip_tags($_POST['supplier']));
        $manufacture = trim(strip_tags($_POST['manufacture']));
        $originCountry = trim(strip_tags($_POST['originCountry']));
        $leadTime = trim(strip_tags($_POST['leadTime'])); 
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $gradeOrReference = trim(strip_tags($_POST['gradeOrReference']));
        $documentInfo = trim(strip_tags($_POST['documentInfo']));
        $idSupplier = trim(strip_tags($_POST['idSupplier']));
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Variabel untuk pengecekan data supplier
        $checkValue = $conn->query("SELECT supplier, manufacture, originCountry, leadTime, catalogOrCasNumber, gradeOrReference, documentInfo, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll();

        $getSupplierName = $checkValue[0]['supplier'];
        $getIdMaterial = $checkValue[0]['idMaterial'];

        $changeSupplier = "";
        $changeManufacture = "";
        $changeOriginCountry = "";
        $changeLeadTime = "";
        $changeCatalogOrCasNumber = "";
        $changeGradeOrReference = "";
        $changeDocumentInfo = "";

        // Cek Apakah data Supplier tersedia
        if($conn->query("SELECT * FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Check and Validation Manufacture
            if(!empty($manufacture)){
                if($manufacture != $checkValue[0]['manufacture']){
                    $changeManufacture = " Manufacture,";
                }else{
                    $changeManufacture = "";
                }
            }else{
                $manufacture = "-";
            }

            // Check and Validation Origin Country
            if(!empty($originCountry)){
                if($originCountry != $checkValue[0]['originCountry']){
                    $changeOriginCountry = " Origin Country,";
                }else{
                    $changeOriginCountry = "";
                }
            }else{
                $originCountry = "-";
            }

            // Check and Validation Lead Time
            if(!empty($leadTime)){
                if($leadTime != $checkValue[0]['leadTime']){
                    $changeLeadTime = " Lead Time,";
                }else{
                    $changeLeadTime = "";
                }
            }else{
                $leadTime = "-";
            }

            // Check and Validation Catalog Or Cas Number
            if(!empty($catalogOrCasNumber)){
                if($catalogOrCasNumber != $checkValue[0]['catalogOrCasNumber']){
                    $changeCatalogOrCasNumber = " Catalog Or Cas Number,";
                }else{
                    $changeCatalogOrCasNumber = "";
                }
            }else{
                $catalogOrCasNumber = "-";
            }

            // Check and Validation Grade Or Reference
            if(!empty($gradeOrReference)){
                if($gradeOrReference != $checkValue[0]['gradeOrReference']){
                    $changeGradeOrReference = " Grade Or Reference,";
                }else{
                    $changeGradeOrReference = "";
                }
            }else{
                $gradeOrReference = "-";
            }

            // Check and Validation Document Info
            if(!empty($documentInfo)){
                if($documentInfo != $checkValue[0]['documentInfo']){
                    $changeDocumentInfo = " Document Info,";
                }else{
                    $changeDocumentInfo = "";
                }
            }else{
                $documentInfo = "-";
            }

            // Check and Validation Supplier
            if(!empty($supplier)){
                if($supplier != $checkValue[0]['supplier']){
                    $changeSupplier = " Nama supplier,";
                }else{
                    $changeSupplier = "";
                }

                // Jika Nama Vendor Sudah Terdaftar
                if($conn->query("SELECT * FROM TB_MasterVendor WHERE vendorName = '".$supplier."'")->fetchAll()){
                    // Handle Update Data Supplier To Database Tabel TB_Supplier
                    try{
                        $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
                        $query = $conn->prepare($sql);
                        $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
                        
                        // Send Notifikasi
                        if($update == true){
                            $message = "mengedit data".$changeSupplier.$changeManufacture.$changeOriginCountry.$changeLeadTime.$changeCatalogOrCasNumber.$changeGradeOrReference.$changeDocumentInfo." pada supplier : ";
                            $response = sendNotification("Supplier berhasil diedit!!", $getSupplierName." (Material: ".$materialName[0]['materialName'].")", $message, NULL, $getIdMaterial, $idSupplier);
                        }
                    }catch(Exception $e){
                        $response = array(
                            "status" => 1,
                            "message" => "Data tidak dapat disimpan!",
                        );
                    }
                }else{
                    // Jika nama vendor belum terdaftar
                    // Handle Add Data Vendor Name To Database Tabel TB_MasterVendor
                    try{
                        $sqlAddVendor = "INSERT INTO TB_MasterVendor (vendorName, created) 
                        VALUES (?, ?)";
                        $paramsAddVendor = array(
                            $supplier,
                            date("Y-m-d H:i:s"),
                        );
                        $queryAddVendor = $conn->prepare($sqlAddVendor);
                        $insertAddVendor =  $queryAddVendor->execute($paramsAddVendor);
                    }catch(Exception $e){
                        $response = array(
                            "status" => 1,
                            "message" => "Data tidak dapat disimpan!",
                        );
                    }

                    // Jika InsertAddVendor Berhasil
                    if($insertAddVendor == true){
                        // Handle Update Data Supplier To Database Tabel TB_Supplier
                        try{
                            $sql = "UPDATE TB_Supplier SET supplier = ?, manufacture = ?, originCountry = ?, leadTime = ?, catalogOrCasNumber = ?, gradeOrReference = ?, documentInfo = ? WHERE id = ?";
                            $query = $conn->prepare($sql);
                            $update = $query->execute(array($supplier, $manufacture, $originCountry, $leadTime, $catalogOrCasNumber, $gradeOrReference, $documentInfo, $idSupplier));
                        
                            // Send Notifikasi
                            if($update == true){
                                $message = "mengedit data".$changeSupplier.$changeManufacture.$changeOriginCountry.$changeLeadTime.$changeCatalogOrCasNumber.$changeGradeOrReference.$changeDocumentInfo." pada supplier : ";
                                $response = sendNotification("Supplier berhasil diedit!!", $getSupplierName." (Material: ".$materialName[0]['materialName'].")", $message, NULL, $getIdMaterial, $idSupplier);
                            }
                        }catch(Exception $e){
                            $response = array(
                                "status" => 1,
                                "message" => "Data tidak dapat disimpan!",
                            );
                        }
                    }
                }
            }else{
                $response = array(
                    "status" => 1,
                    "message" => "Data supplier wajib di isi!!"
                );
            }

        }else{
            $response = array(
                "status" => 1,
                "message" => "Data supplier tidak ditemukan", 
            );
        }

        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle tambah MoU, MoQ, dan Price
    if(isset($_POST['addDetail'])){
        //Mengambil data dan memformat data
        $MoQ = trim(strip_tags($_POST['MoQ']));
        $UoM = trim(strip_tags($_POST['UoM']));
        $price = trim(strip_tags($_POST['price']));
        $hardCash = trim(strip_tags($_POST['hardCash']));
        $quantity = trim(strip_tags($_POST['quantity']));
        $idSupplier = trim(strip_tags($_POST['id']));
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Membuat detail info price
        $priceDetail = $hardCash.$price.$quantity;

        // Cek Apakah data Supplier tersedia
        if($dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){
            // Handle Add Data Detail MoQ, UoM, Price To Database Tabel TB_DetailSupplier
            try{
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
                    $response = sendNotification("Berhasil memasukan detail supplier!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "menambahkan detail supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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

    
        echo json_encode($response);
        exit();
    }

    // Kondisi untuk meng-handle hapus MoU, MoQ, dan Price
    if(($_REQUEST['actionType'] == 'delete') && !empty($_GET['idDetailSupplier'])){
        //Mengambil data dan memformat data
        $idDetailSupplier = $_GET['idDetailSupplier'];
        $idSupplier = $_GET['idSupplier'];
        $materialName = $conn->query("SELECT materialName FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE TB_Supplier.id=".$idSupplier)->fetchAll();

        // Cek Apakah data Supplier tersedia
        if($dataSupplier = $conn->query("SELECT supplier, idMaterial FROM TB_Supplier WHERE id = ".$idSupplier)->fetchAll()){

            // Handle Delete Data Detail MoQ, UoM, Price To Database Tabel TB_DetailSupplier
            try{
                $sql = "DELETE FROM TB_DetailSupplier WHERE idDetailSupplier = ?"; 
                $query = $conn->prepare($sql); 
                $delete = $query->execute(array($idDetailSupplier));
                
                // Send Notifikasi
                if($delete == true){
                    $response = sendNotification("Berhasil menghapus detail supplier!!", $dataSupplier[0]['supplier']." (Material: ".$materialName[0]['materialName'].")", "menghapus detail supplier : ", NULL, $dataSupplier[0]['idMaterial'], $idSupplier);
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