<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal View Material -->'+
'<div class="modal" id="viewMaterial'+data.id+'" data-bs-backdrop="static">'+
    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title">Detail Material</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<h5>Material Name: </h5>'+
                '<p class="mb-4">'+data.materialName+'</p>'+
                '<h5>Material Cartegory : </h5>'+
                '<p class="mb-4">'+data.materialCategory+'</p>'+
                '<h5>Material Spesification: </h5>'+
                '<p class="mb-4">'+data.materialSpesification+'</p>'+
                '<h5>Catalog Or Cas Number: </h5>'+
                '<p class="mb-4">'+data.catalogOrCasNumber+'</p>'+
                '<h5>Company: </h5>'+
                '<p class="mb-4">'+data.company+'</p>'+
                '<h5>Website: </h5>'+
                '<p class="mb-4">'+data.website+'</p>'+
                '<h5>Finish Dossage Form: </h5>'+
                '<p class="mb-4">'+data.finishDossageForm+'</p>'+
                '<h5>Keterangan: </h5>'+
                '<p class="mb-4">'+data.keterangan+'</p>'+
                '<h5>Document Requirement: </h5>'+
                '<p class="mb-4">'+data.documentReq+'</p>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+