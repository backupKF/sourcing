<?php
    session_start();

    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Select Vendor -->'+
'<div class="modal" id="modalSetVendorUpdateSupplier'+dataSupplier.id+'">'+
    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title">Select Vendor</div>'+
            '</div>'+
                        
            '<!-- Modal Body -->'+
            '<div class="modal-body position-relative">'+
                '<!-- Button Tambah data master supplier -->'+
                '<button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalAddMasterVendor-supplierUpdate'+dataSupplier.id+'">Tambah Data Master Supplier</button>'+
                '<div class="text-success mb-1" id="successMsgAddMasterVendor-supplierUpdate'+dataSupplier.id+'" style="font-size:10px;font-family:poppinsSemiBold"></div>'+
                '<!-- Select Project -->'+
                '<table class="table vendor" id="tabel-vendorUpdateSupplier'+dataSupplier.id+'" style="width:100%">'+
                    '<thead style="background-color:#00b0aa">'+
                        '<tr>'+
                            '<td class="column-project-head" style="width:100px">Vendor Name</td>'+
                            '<td class="column-project-head" style="width:20px"></td>'+
                        '</tr>'+
                    '</thead>'+
                '</table>'+
            '</div>'+

            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplier'+dataSupplier.id+'">'+
                    'Back'+
                '</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+

'<!-- Modal Add Master Vendor -->'+
<?php include "addMasterVendor.php"?>