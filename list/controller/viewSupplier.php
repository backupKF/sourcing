<?php
    include "../../dbConfig.php";

    $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial='{$_GET['materialCode']}'")->fetchAll();
    $json = array();
        foreach($dataSupplier as $row){
            array_push($json, $row);
        }
    $json_data['data'] = $json;
    echo json_encode($json_data);

    // if(isset($_GET['idSupplier'])){
    //     $detailSupplier = $conn->query("SELECT MoQ, UoM, price FROM TB_DetailSupplier INNER JOIN TB_Supplier ON TB_DetailSupplier.idSupplier = TB_Supplier.id WHERE idSupplier=13")->fetchAll();
    //     $json = array();
    //         foreach($detailSupplier as $row){
    //             array_push($json, $row);
    //         }
    //     $json_data['detail'] = $json;
    //     echo json_encode($json_data);
    // }
?>