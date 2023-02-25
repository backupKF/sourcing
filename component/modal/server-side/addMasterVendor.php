<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<div class="modal" id="modalAddMasterVendor-supplierUpdate'+dataSupplier.id+'">'+
    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title">Tambah Master Vendor</div>'+
            '</div>'+
                        
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<label class="mb-1 labelVendor" >Tambah Vendor Baru : </label>'+
                '<div class="mb-2">'+
                    '<form class="was-validated" id="formAddMasterVendor-supplierUpdate'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcSetNewVendor<?php echo $_GET['idMaterial']?>('+dataSupplier.id+', `modalAddMasterVendor-supplierUpdate`, '+dataSupplier.scriptCountTabelUpdateVendor+')">'+
                        '<input class="form-control form-control-sm" id="inputAddNewMasterVendor-supplierUpdate'+dataSupplier.id+'" maxlength="80" type="text" placeholder="Masukan Vendor Baru" name="addNewMasterVendor" required>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Nama Vendor Baru (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</form>'+
                    '<div class="text-danger" id="errorMsgAddMasterVendor-supplierUpdate'+dataSupplier.id+'" style="font-size:10px;font-family:poppinsSemiBold"></div>'+
                '</div>'+
                '<div>'+
                    '<input type="submit" class="btn btn-success btn-sm" value="Save" form="formAddMasterVendor-supplierUpdate'+dataSupplier.id+'">'+
                '</div>'+
            '</div>'+

            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalSetVendorUpdateSupplier'+dataSupplier.id+'" onclick="funcReloadDataTabelVendor<?php echo $_GET['idMaterial'] ?>();">'+
                    'Back'+
                '</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+
