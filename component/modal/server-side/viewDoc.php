<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal View Document -->'+
'<div class="modal" id="viewDoc'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">View Upload</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<table class="table">'+
                    '<thead>'+
                        '<th style="font-size:15px;font-family:poppinsSemiBold">File Name</th>'+
                        '<th style="font-size:15px;font-family:poppinsSemiBold">View</th>'+
                        '<th style="font-size:15px;font-family:poppinsSemiBold">Action</th>'+
                    '</thead>'+
                    dataSupplier.outputViewDoc +
                '</table>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+