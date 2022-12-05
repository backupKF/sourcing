<?php
    include "../../dbConfig.php";

     if(isset($_POST['MoQ'])){
        $MoQ = trim(strip_tags($_POST['MoQ']));
        $UoM = trim(strip_tags($_POST['UoM']));
        $price = trim(strip_tags($_POST['price']));
        $idSupplier = trim(strip_tags($_POST['id']));

        $sql = "INSERT INTO TB_DetailSupplier (MoQ, UoM, price, idSupplier) 
        VALUES (?,?,?,?)";
        $params = array(
            $MoQ,
            $UoM,
            $price,
            $idSupplier,
        );
        $query = $conn->prepare($sql);
        $insert = $query->execute($params);
    }
?>