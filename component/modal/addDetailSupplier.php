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
                <div class="modal-title">Tambah informasi MoQ, UoM, Price</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="was-validated" id="formAddDetail<?php echo $row['id']?>" autocomplete="off">
                    <!-- Input MoQ-->
                    <div class="mb-3">
                        <label for="MoQ" class="form-label">MoQ</label>
                        <input type="text" class="form-control" id="MoQ" name="MoQ" required>
                        <div class="invalid-feedback">
                            Masukan MoQ (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Input Manufacture -->
                    <div class="mb-3">
                        <label for="UoM" class="form-label">UoM</label>
                        <input type="text" class="form-control" id="UoM" name="UoM" required>
                        <div class="invalid-feedback">
                            Masukan UoM (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Input Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                        <div class="invalid-feedback">
                            Masukan Price (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Input Hard Cash -->
                    <label for="UoM" class="form-label">Hard Cash : </label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hardCash" id="hcRupiah" value="Rp." required>
                            <label class="form-check-label" for="hcRupiah">Rupiah[RP]</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hardCash" id="hcDollar" value="$">
                            <label class="form-check-label" for="hcDollar">Dollar[$]</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hardCash" id="hcEuro" value="€">
                            <label class="form-check-label" for="hcEuro">Euro[€]</label>
                        </div>
                    </div>
                    <!-- Input Quantity -->
                    <label for="UoM" class="form-label">Quantity : </label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="quantity" id="qKg" value="/kg" required>
                            <label class="form-check-label" for="qKg">Kilo Gram</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="quantity" id="qG" value="/gr">
                            <label class="form-check-label" for="qG">Gram</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="quantity" id="qMl" value="/mg">
                            <label class="form-check-label" for="qMl">Mili Gram</label>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <input type="submit" class="btn btn-primary" value="Submit" form="formAddDetail<?php echo $row['id']?>">
            </div>
        </div>
    </div>
</div>
<script>
    // Listen Event Submit
    document.getElementById("formAddDetail<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcAddDetailSupplier(<?php echo $row['id']?>)
    });
</script>