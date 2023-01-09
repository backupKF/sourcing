<?php
  if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Location: ../../dashboard/index.php');
    exit();
  };
?>

<!-- Modal Form View Material -->
<div class="modal" id="viewMaterial<?php echo $row['id']?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Detail Material</h5>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <h5>Material Name: </h5>
                <p class="mb-4"><?php echo $row['materialName']?></p>
                <h5>Material Cartegory : </h5>
                <p class="mb-4"><?php echo $row['materialCategory']?></p>
                <h5>Material Spesification: </h5>
                <p class="mb-4"><?php echo $row['materialSpesification']?></p>
                <h5>Catalog Or Cas Number: </h5>
                <p class="mb-4"><?php echo $row['catalogOrCasNumber']?></p>
                <h5>Company: </h5>
                <p class="mb-4"><?php echo $row['company']?></p>
                <h5>Website: </h5>
                <p class="mb-4"><?php echo $row['website']?></p>
                <h5>Finish Dossage Form: </h5>
                <p class="mb-4"><?php echo $row['finishDossageForm']?></p>
                <h5>Keterangan: </h5>
                <p class="mb-4"><?php echo $row['keterangan']?></p>
                <h5>Document Requirement: </h5>
                <p class="mb-4"><?php echo $row['documentReq']?></p>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
            </div>
        </div>
    </div>
</div>