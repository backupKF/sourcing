<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Sumary Report -->'+
'<div class="modal" id="sumaryReport'+dataMaterial.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">Sumary Report</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="p-1 was-validated" id="formSumaryReport'+dataMaterial.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcUpdateSumaryReport('+dataMaterial.id+',`'+dataMaterial.materialName+'`)">'+
                    '<input type="hidden" name="idMaterial" value="'+dataMaterial.id+'">'+
                    '<!-- Sumary Report  -->'+
                    '<div class="mb-1">'+
                        '<label for="sumaryReport" class="form-label" style="margin-button:2px">Sumary Report</label>'+
                        '<textarea class="form-control form-control-sm" id="sumaryReport" rows="3" name="sumaryReport" required>'+dataMaterial.sumaryReport+'</textarea>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Sumary Report (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</div>'+
                    '<input type="submit" class="btn btn-warning btn-sm m-0" value="Submit">'+
                '</form>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+