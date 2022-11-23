<?php
    include "../../dbConfig.php";

    $dataProject = $conn->query("SELECT DISTINCT TB_Project.projectCode, TB_Project.projectName FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode")->fetchAll();
    $json = array();
    foreach($dataProject as $row){
        array_push($json, $row);
    }
    $json_data['data'] = $json;
    echo json_encode($json_data)
?>