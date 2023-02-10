<?php
    session_start();

    // include "../../dbConfig.php";

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
                
                '<label class="mb-1 labelVendor" >Tambah Supplier Baru : </label>'+
                '<div class="row mb-2">'+
                    '<div class="col">'+
                        '<form id="formSetNewVendorUpdateSupplier'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcSetNewVendor('+dataSupplier.id+',`formSetNewVendorUpdateSupplier`);">'+
                            '<input class="form-control form-control-sm" type="text" placeholder="Masukan Vendor Baru" name="setNewVendor" style="height:5px">'+
                        '</form>'+
                    '</div>'+
                    '<div class="col">'+
                        '<button type="submit" class="btn btn-success btn-sm p-0 px-1" style="height:22px" form="formSetNewVendorUpdateSupplier'+dataSupplier.id+'">'+
                            '<span style="font-size:11px;font-family:poppinsBold">Pilih</span>'+
                        '</button>'+
                    '</div>'+
                '</div>'+

                '<label class="labelVendor mb-1">Cari Supplier :</label>'+

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
'<!-- Modal Select Vendor -->'+