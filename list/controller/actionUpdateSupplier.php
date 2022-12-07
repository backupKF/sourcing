<?php
    include "../../dbConfig.php";

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
    }
?>