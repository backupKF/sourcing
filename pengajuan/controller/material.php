<?php
    include "../../dbConfig.php";

        $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE projectCode='{$_GET['projectCode']}'")->fetchAll();
        $json = array();
        foreach($dataMaterial as $row){
            array_push($json, $row);
        }
        $json_data['data'] = $json;
        echo json_encode($json_data)
?>