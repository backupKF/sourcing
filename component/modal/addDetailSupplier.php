<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Add Detail Supplier-->
<div class="modal" id="tambahDetailSupplier<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah informasi MoQ, UoM, Price</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="was-validated" id="formAddDetail<?php echo $row['id']?>">
                <!-- Input MoQ-->
                <div class="mb-3">
                    <label for="MoQ" class="form-label fw-bold">MoQ</label>
                    <input type="text" class="form-control" id="MoQ" name="MoQ" required>
                    <div class="invalid-feedback">
                         Masukan MoQ (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Manufacture -->
                <div class="mb-3">
                    <label for="UoM" class="form-label fw-bold">UoM</label>
                    <input type="text" class="form-control" id="UoM" name="UoM" required>
                    <div class="invalid-feedback">
                        Masukan UoM (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <!-- Input Price -->
                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                    <div class="invalid-feedback">
                        Masukan Price (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
            </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <button type="button" class="btn btn-primary" onclick="funcAddDetailSupplier(<?php echo $row['id']?>)">Submit</button>
            </div>
        </div>
    </div>
</div>