<?php
    include "../../dbConfig.php";

    $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial='{$_GET['idMaterial']}'")->fetchAll();
    $json = array();
        foreach($dataSupplier as $row){
            array_push($json, $row);
        }
    $json_data['data'] = $json;
    echo json_encode($json_data);
?>