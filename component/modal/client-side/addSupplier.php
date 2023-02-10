<?php
    session_start();

    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal Add Supplier-->
<div class="modal" id="tambahSupplier<?php echo $_GET['idMaterial']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Tambah Supplier</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="was-validated" id="formAddSupplier<?php echo $_GET['idMaterial']?>" autocomplete="off">
                <!-- Input Supplier -->
                <div class="mb-3">
                    <label for="supplier" class="form-label">Supplier</label>
                    <div class="row">
                        <!-- Select Result -->
                        <div class="col-10 pe-0">
                            <input type="text" class="form-control" name="supplier" id="vendorInputAddSupplier" value="" readonly required>
                        </div>
                        <!-- Button Change Modal Vendor -->
                        <div class="col-2">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalSetVendorAddSupplier<?php echo $_GET['idMaterial']?>">Select</button>
                        </div>
                    </div>
                    <!-- Message Error -->
                    <div id="errorSupplier" class="text-danger" style="font-size:14px;font-family:poppinsRegular"></div>
                </div>
                <!-- Input Manufacture -->
                <div class="mb-3">
                    <label for="manufacture" class="form-label">Manufacture</label>
                    <input type="text" class="form-control" id="manufacture" name="manufacture" required>
                    <div class="invalid-feedback">
                        Masukan Manufacture (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Origin Country -->
                <div class="mb-3">
                    <label for="originCountry" class="form-label">Origin Country</label>
                    <input type="text" class="form-control" id="originCountry" name="originCountry" required>
                    <div class="invalid-feedback">
                        Masukan Origin Country (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Lead Time -->
                <div class="mb-3">
                    <label for="leadTime" class="form-label">Lead Time</label>
                    <input type="text" class="form-control" id="leadTime" name="leadTime" required>
                    <div class="invalid-feedback">
                        Masukan Lead Time (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Catalog or CAS Number -->
                <div class="mb-3">
                    <label for="catalogOrCasNumber" class="form-label">Catalog or CAS Number</label>
                    <input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" required>
                    <div class="invalid-feedback">
                        Masukan Catalog or CAS Number (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Grade/Reference -->
                <div class="mb-3">
                    <label for="gradeOrReference" class="form-label">Grade/Reference</label>
                    <input type="text" class="form-control" id="gradeOrReference" name="gradeOrReference" required>
                    <div class="invalid-feedback">
                        Masukan Grade/Reference (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                 <!-- Document Info -->
                <div class="mb-3">
                    <label for="documentInfo" class="form-label">Document Info</label>
                    <input type="text" class="form-control" id="documentInfo" name="documentInfo" required>
                    <div class="invalid-feedback">
                        Masukan Document Info (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
            </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary" form="formAddSupplier<?php echo $_GET['idMaterial']?>">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Set Vendor -->
<?php include "setVendor.php"?>

<script>
    // Listen Event Submit
    document.getElementById("formAddSupplier<?php echo $_GET['idMaterial']?>").addEventListener('submit', event => {
    event.preventDefault();
    // actual logic, e.g. validate the form
    funcAddSupplier(<?php echo $_GET['idMaterial']?>)
    });
</script>