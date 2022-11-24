<?php
     if(!session_id()){ 
        session_start(); 
    } 

    $materials = $_SESSION['materials'];
    if(isset($_POST['tambahDataMaterial'])){
        $materialCategory = trim(strip_tags($_POST['materialCategory']));
        $materialDeskripsi = trim(strip_tags($_POST['materialDeskripsi']));
        $materialSpesification =  trim(strip_tags($_POST['materialSpesification']));
        $catalogOrCasNumber = trim(strip_tags($_POST['catalogOrCasNumber']));
        $company = trim(strip_tags($_POST['company']));
        $website = trim(strip_tags($_POST['website']));
        $finishDossageForm = trim(strip_tags($_POST['finishDossageForm']));
        $keterangan = trim(strip_tags($_POST['keterangan']));
        $setProject = trim(strip_tags($_POST['setProject']));

        if(empty($materialCategory)) {
            $materialCategory = "-"; 
        }
        if(empty($materialDeskripsi)) {
            $materialDeskripsi = "-"; 
        }
        if(empty($materialSpesification)) {
            $materialSpesification = "-"; 
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
            $finishDossageForm = "-"; 
        }
        if(empty($keterangan)) {
            $keterangan = "-"; 
        }

        $newData = ["materialCategory" => $materialCategory, 
                    "materialDesk" => $materialDeskripsi, 
                    "materialSpesification" => $materialSpesification,
                    "catalogOrCasNumber" => $catalogOrCasNumber,
                    "company" => $company,
                    "website" => $website,
                    "finishDossageForm" => $finishDossageForm,
                    "keterangan" => $keterangan,
                    "projectCode" => $setProject,
                ];
        $materials[] = $newData;

        $_SESSION['materials'] = $materials;
        // foreach($materials as $material){
        //     echo "{$material['materialSpesification']} <br>";
        // }

        // print_r($materials);
        // unset($_SESSION['materials']);

        header('Location: ../index.php');
    }
?>
