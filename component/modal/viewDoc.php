<!-- Modal UpdateSupplier-->
<div class="modal" id="viewDoc<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">View Upload</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Action</th>
                    </thead>
                    <?php
                        include "../../../dbConfig.php";
                        $no = 1;
                        $dataSupplier = $conn->query("SELECT * FROM TB_File WHERE idSupplier='{$row['id']}'")->fetchAll();
                        foreach($dataSupplier as $file){
                    ?>
                    <tbody>
                        <td><?php echo $file['fileName']?></td>
                        <td><a href="../assets/uploads/<?php echo $file['fileHash']?>" target="_blank">View</a></td>
                        <td><button type="button" onclick="deleteFile<?php echo $row['id']?>(<?php echo $file['id']?>)">delete</button></td>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>

<script>
    function deleteFile<?php echo $row['id']?>(id){
        $.ajax({
            type: 'GET',
            url: '../controller/actionHandlerFile.php',
            data:{id: id, actionType: "delete"},
            dataType: 'json',
            success: function(response){
                $('#viewDoc<?php echo $row['id']?>').modal('hide');
                loadDataSupplier(<?php echo $_GET['idMaterial']?>)
            }
        })
    }
</script>