<!-- Modal UpdateSupplier-->
<div class="modal" id="sumaryReport<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sumary Report</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formSumaryReport<?php echo $row['id']?>">
                    <input type="hidden" name="idMaterial" value="<?php echo $row['id']?>">
                    <!-- Sumary Report  -->
                    <div class="mb-1">
                        <label for="sumaryReport" class="form-label fw-bold" style="margin-button:2px">Sumary Report</label>
                        <textarea class="form-control form-control-sm" id="sumaryReport" rows="3" name="sumaryReport" required><?php echo $row['sumaryReport']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Sumary Report (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit">
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('form#formSumaryReport<?php echo $row['id']?>').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controller/actionUpdateMaterial.php",
                data: $(this).serialize(),
                success: function(data){
                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                }
            })
            $('#sumaryReport<?php echo $row['id']?>').modal('hide');
        })
    })
</script>