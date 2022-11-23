<?php
  if(!session_id()){
    session_start();
  }

  include "../../dbConfig.php";

  // Get form fields value
  if(isset($_POST["submit"])){
    $idMaterial = $_POST['id'];
    $materialCategory = trim(strip_tags($_POST['materialCategory']));
    $materialDeskripsi = trim(strip_tags($_POST['materialDeskripsi']));
    $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
    $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
    $company = trim(strip_tags($_POST['company']));
    $website = trim(strip_tags($_POST['website']));
    $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
    $keterangan = trim(strip_tags($_POST['keterangan']));
    $setProject = trim(strip_tags($_POST['setProject']));
  
    // Field validation
    $errorMsg = '';
    if(empty($materialCategory)) {
      $errorMsg .= '<p>Silahkan Masukan Material Deskripsi</p>'; 
    }
    if(empty($materialDeskripsi)) {
      $errorMsg .= '<p>Silahkan Masukan Material Deskripsi</p>'; 
    }
    if(empty($materialSpesification)) {
      $errorMsg .= '<p>Silahkan Masukan Material Spesification</p>'; 
    }
    if(empty($catalogOrCasNumber)){
      $catalogOrCasNumber = "-";
    }
    if(empty($company)){
      $company = "-";
    }
    if(empty($website)){
      $website = "-";
    }
    if(empty($finishDossageForm)) {
      $errorMsg .= '<p>Silahkan Masukan Finish Dossage Form</p>'; 
    }
    if(empty($keterangan)) {
      $errorMsg .= '<p>Silahkan Masukan keterangan</p>'; 
    }

    // Process the form data
    if(empty($errorMsg)){
      if(!empty($idMaterial)){
        // Update Data Material
        $sql = "UPDATE TB_PengajuanSourcing SET materialCategory = ?, materialDeskripsi = ?, materialSpesification = ?, catalogOrCasNumber = ?, company = ?, website = ?, finishDossageForm = ?, keterangan = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $update = $query->execute(array($materialCategory, $materialDeskripsi, $materialSpesification, $catalogOrCasNumber, $company, $website, $finishDossageForm, $keterangan, $idMaterial));
        
        if($update){
          $sessMaterial['status']['type'] = 'success';
          $sessMaterial['status']['msg'] = 'Data Material Berhasil Diubah!';

        }else{
          $sessMaterial['status']['type'] = 'error'; 
          $sessMaterial['status']['msg'] = 'Data Material Tidak Berhasil Diubah, Silahkan Coba Lagi!'; 
        }
      }else{
        // Insert Data Material
        $sql = "INSERT INTO TB_PengajuanSourcing (materialCategory, materialDeskripsi,  materialSpesification, catalogOrCasNumber, company, website, finishDossageForm, keterangan, projectCode, created) 
            VALUES (?,?,?,?,?,?,?,?,?,?)";
        $params = array(
          &$materialCategory,
          &$materialDeskripsi,
          &$materialSpesification,
          &$catalogOrCasNumber,
          &$company,
          &$website,
          &$finishDossageForm,
          &$keterangan,
          &$setProject,
          date("Y-m-d H:i:s")
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);

        if($insert) {
          $sessMaterial['status']['type'] = 'success'; 
          $sessMaterial['status']['msg'] = 'Material Berhasil Ditambahkan!'; 
        }else{
          $sessMaterial['status']['type'] = 'error'; 
          $sessMaterial['status']['msg'] = 'Data Material Tidak Berhasil Ditambahkan, Silahkan Coba Lagi!'; 
        }
      }
    }else{ 
      $sessMaterial['status']['type'] = 'error'; 
      $sessMaterial['status']['msg'] = '<p>Harap Mengisi Form Tambah Data Material Dengan Benar</p>'; 
    }

    // Store status into the session 
    $_SESSION['sessMaterial'] = $sessMaterial;

    header("Location: ../index.php");
    exit();

  }elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    $idMaterial = $_GET['id']; 

    // Delete data from SQL server 
    $sql = "DELETE FROM TB_PengajuanSourcing WHERE id = ?"; 
    $query = $conn->prepare($sql); 
    $delete = $query->execute(array($idMaterial)); 

    if($delete){ 
      $sessMaterial['status']['type'] = 'success'; 
      $sessMaterial['status']['msg'] = 'Data Material Berhasil Dihapus.'; 
    }else{ 
      $sessMaterial['status']['type'] = 'error'; 
      $sessMaterial['status']['msg'] = 'Terjadi Kesalahan, Silahkan Coba lagi!.'; 
    } 

    // Store status into the session 
    $_SESSION['sessMaterial'] = $sessMaterial;

    header("Location: ../kelola-data.php");
    exit();
  } 

  if(isset($_POST['setProject'])){
    $_SESSION['project'] = $_POST['project'];
    header('Location: ../kelola-data.php');
  };

  if(isset($_POST['submitData'])){
    $dateSourcing = date("Y-m-d");
    $projectCode = $_SESSION['project'];
    $feedbackTL = 0;
    $feedbackRPIC = 0;


    $riwayat = [
        'dateSourcing' => $dateSourcing,
        'projectCode' => $projectCode,
        'feedbackTL' => $feedbackTL,
        'feedbackRPIC' => $feedbackRPIC,
    ];

    $sql = "INSERT INTO TB_RiwayatSourcing (dateSourcing, projectCode, feedbackTL, feedbackRPIC) 
            VALUES (:dateSourcing, :projectCode, :feedbackTL, :feedbackRPIC)";

    $query = $conn->prepare($sql);
    $query->execute($riwayat);

    unset($_SESSION['project']); 

    header("Location: ../index.php");
  };

  if(isset($_POST['unsetProject'])){
    unset($_SESSION['project']); 
    header("Location: ../index.php");
  }

?>