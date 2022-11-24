<?php
    include "../../dbConfig.php";

    $dataRiwayat = $conn->query("SELECT * FROM TB_RiwayatSourcing INNER JOIN TB_Project ON TB_RiwayatSourcing.projectCode = TB_Project.projectCode")->fetchAll();
        $json = array();
        foreach($dataRiwayat as $row){
            array_push($json, $row);
        }
    $json_data['data'] = $json;
    echo json_encode($json_data)
?>