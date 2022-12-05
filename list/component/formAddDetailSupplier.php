<!-- Modal Detail Supplier-->
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
                <input type="hidden" name="id" value="<?php echo $row['id']?>">

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
                <input type="submit" class="btn btn-primary" name="submit" value="Submit" form="formAddDetail<?php echo $row['id']?>">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('form').on('submit', function(e){
            console.log($(this).serialize())
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "controller/actionAddDetail.php",
                data: $(this).serialize(),
                success: function(data){
                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#tambahDetailSupplier<?php echo $row['id']?>').modal('hide');
        })
    })
</script>