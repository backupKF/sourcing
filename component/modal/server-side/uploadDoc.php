<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Upload Document -->'+
'<div class="modal" id="uploadDoc'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">File Upload</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form id="uploadFile'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcUploadDoc('+dataSupplier.id+');">'+
                    '<input type="hidden" name="idSupplier" value="'+dataSupplier.id+'">'+
                    '<div class="form-group">'+
                        '<label for="file">File:</label>'+
                        '<input type="file" class="form-control" id="file" name="file" required />'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<input type="submit" class="btn btn-info submitBtn mt-3" value="Submit" from="uploadFile'+dataSupplier.id+'">'+
                    '</div>'+
                '</form>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+