<!-- Modal Select Project -->
<div class="modal" id="project" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Pilih Project</h5>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
            <!-- Select Project -->
            <form action="./controller/actionPengajuan.php" method="POST">
                <select class="form-select" size="8" aria-label="multiple select example" name="project">
                    <?php 
                        $project = $conn->query("SELECT * FROM TB_Project")->fetchAll();
                        foreach($project as $row) { 
                    ?>
                        <option value="<?php echo $row['projectCode']?>" > <?php echo $row['projectCode'] ," | ", $row['projectName']?></option>
                    <?php } ?>
                </select>  
                <!-- End Select Project -->
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
                <input type="submit" value="submit" class="btn btn-primary" name="setProject">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Select Project -->