<?php
    include "../../dbConfig.php";

    $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode")->fetchAll();
        $json = array();
        foreach($dataRiwayat as $row){
            array_push($json, $row);
        }
    $json_data['data'] = $json;
    echo json_encode($json_data)
?>