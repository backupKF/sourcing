<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Update Supplier -->
<div class="modal" id="editSupplier<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Edit Supplier</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="was-validated" id="formUpdateSupplier<?php echo $row['id']?>" autocomplete="off">
                <input type="hidden" name="idSupplier" value="<?php echo $row['id']?>">

                <!-- Input Supplier -->
                <div class="mb-3">
                    <label for="supplier" class="form-label">Supplier</label>
                    <input type="text" class="form-control supplier" id="supplier" name="supplier" value="<?php echo $row['supplier']?>" required>
                    <div class="invalid-feedback">
                         Masukan Supplier (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Manufacture -->
                <div class="mb-3">
                    <label for="manufacture" class="form-label">Manufacture</label>
                    <input type="text" class="form-control" id="manufacture" name="manufacture" value="<?php echo $row['manufacture']?>" required>
                    <div class="invalid-feedback">
                        Masukan Manufacture (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Origin Country -->
                <div class="mb-3">
                    <label for="originCountry" class="form-label">Origin Country</label>
                    <input type="text" class="form-control" id="originCountry" name="originCountry" value="<?php echo $row['originCountry']?>" required>
                    <div class="invalid-feedback">
                        Masukan Origin Country (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Lead Time -->
                <div class="mb-3">
                    <label for="leadTime" class="form-label">Lead Time</label>
                    <input type="date" class="form-control" id="leadTime" name="leadTime" placeholder="dd-mm-yyyy" value="<?php echo date('Y-m-d',strtotime($row["leadTime"]))?>" required>
                    <div class="invalid-feedback">
                        Masukan Lead Time (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Catalog or CAS Number -->
                <div class="mb-3">
                    <label for="catalogOrCasNumber" class="form-label">Catalog or CAS Number</label>
                    <input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" value="<?php echo $row['catalogOrCasNumber']?>" required>
                    <div class="invalid-feedback">
                        Masukan Catalog or CAS Number (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Grade/Reference Standard -->
                <div class="mb-3">
                    <label for="gradeOrReference" class="form-label">Grade/Reference</label>
                    <input type="text" class="form-control" id="gradeOrReference" name="gradeOrReference" value="<?php echo $row['gradeOrReference']?>" required>
                    <div class="invalid-feedback">
                        Masukan Grade/Reference (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                 <!-- Document Info -->
                <div class="mb-3">
                    <label for="documentInfo" class="form-label">Document Info</label>
                    <input type="text" class="form-control" id="documentInfo" name="documentInfo" value="<?php echo $row['documentInfo']?>" required>
                    <div class="invalid-feedback">
                        Masukan Document Info (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
            </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit"  form="formUpdateSupplier<?php echo $row['id']?>">
            </div>
        </div>
    </div>
</div>
<script>
    // Listen Event Submit
    document.getElementById("formUpdateSupplier<?php echo $row['id']?>").addEventListener('submit', event => {
    event.preventDefault();
    // actual logic, e.g. validate the form
    funcUpdateSupplier(<?php echo $row['id']?>)
    });
</script>