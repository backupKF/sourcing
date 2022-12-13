<!-- Modal Form View Material -->
<div class="modal" id="viewMaterial<?php echo $data['id']?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Detail Material</h5>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <h5>Material Name: </h5>
                <p class="mb-4"><?php echo $data['materialName']?></p>
                <h5>Material Cartegory : </h5>
                <p class="mb-4"><?php echo $data['materialCategory']?></p>
                <h5>Material Spesification: </h5>
                <p class="mb-4"><?php echo $data['materialSpesification']?></p>
                <h5>Catalog Or Cas Number: </h5>
                <p class="mb-4"><?php echo $data['catalogOrCasNumber']?></p>
                <h5>Company: </h5>
                <p class="mb-4"><?php echo $data['company']?></p>
                <h5>Website: </h5>
                <p class="mb-4"><?php echo $data['website']?></p>
                <h5>Finish Dossage Form: </h5>
                <p class="mb-4"><?php echo $data['finishDossageForm']?></p>
                <h5>Keterangan: </h5>
                <p class="mb-4"><?php echo $data['keterangan']?></p>
                <h5>Document Requirement: </h5>
                <p class="mb-4"><?php echo $data['documentReq']?></p>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
            </div>
        </div>
    </div>
</div>