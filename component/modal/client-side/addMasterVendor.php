<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal Select Vendor -->
<div class="modal" id="modalAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Tambah Master Vendor</div>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
                <label class="mb-1 labelVendor" >Tambah Vendor Baru : </label>
                <div class="mb-2">
                    <form class="was-validated" id="formAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>" autocomplete="off" onsubmit="event.preventDefault(); funcSetNewVendor<?php echo $_GET['idMaterial'] ?>(<?php echo $_GET['idMaterial'] ?>, 'modalAddMasterVendor-supplierAdd')">
                        <input class="form-control form-control-sm" id="inputAddNewMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>" maxlength="80" type="text" placeholder="Masukan Vendor Baru" name="addNewMasterVendor" required>
                        <div class="invalid-feedback">
                            Masukan Nama Vendor Baru (*Tandai (-) jika tidak Diisi).
                        </div>
                    </form>
                    <span class="text-danger" id="errorMsgAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>" style="font-size:10px;font-family:poppinsSemiBold"></span>
                </div>
                <div>
                    <input type="submit" class="btn btn-success btn-sm" value="Save" form="formAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalSetVendorAddSupplier<?php echo $_GET['idMaterial']?>" onclick="funcReloadDataTabelVendor<?php echo $_GET['idMaterial'] ?>();">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
