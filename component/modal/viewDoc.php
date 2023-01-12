<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal View Document -->
<div class="modal" id="viewDoc<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">View Upload</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th style="font-size:15px;font-family:poppinsSemiBold">File Name</th>
                        <th style="font-size:15px;font-family:poppinsSemiBold">View</th>
                        <th style="font-size:15px;font-family:poppinsSemiBold">Action</th>
                    </thead>
                    <?php
                        include "../../../dbConfig.php";
                        $no = 1;
                        if($dataSupplier = $conn->query("SELECT * FROM TB_File WHERE idSupplier='{$row['id']}'")->fetchAll()){
                            foreach($dataSupplier as $file){
                    ?>
                            <tbody>
                                <td style="font-size:15px;font-family:poppinsItalic"><?php echo $file['fileName']?></td>
                                <td><a class="text-decoration-none btn btn-success d-inline ms-1" style="width:80px;height:25px;font-size:13px;font-family:poppinsSemiBold;padding:3px" href="../assets/uploads/<?php echo $file['fileHash']?>" target="_blank">View</a></td>
                                <td><button type="button" style="width:50px;height:25px;font-size:13px;font-family:poppinsSemiBold" class="btn btn-danger d-inline ms-1 p-0" onclick="deleteFile(<?php echo $file['id']?>,<?php echo $row['id']?>)">Delete</button></td>
                            </tbody>
                    <?php 
                            }
                        }else{
                    ?>
                        <tbody>
                            <td></td>
                            <td>Not Found</td>
                            <td></td>
                        </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>