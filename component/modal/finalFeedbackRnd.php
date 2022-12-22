<!-- Modal UpdateSupplier-->
<div class="modal" id="finalFeedbackRnd<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Final Feedback RND</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formFinalFeedbackRnd<?php echo $row['id']?>">
                    <input type="text" class="d-none" name="idMaterial" value="<?php echo $_GET['idMaterial']?>">
                    <input type="text" class="d-none" name="idSupplier" value="<?php echo $row['id']?>">
                    <input type="text" class="d-none" name="supplier" value="<?php echo $row['supplier']?>">
                    <!-- Final Feedback RnD -->
                    <div class="mb-1">
                        <label for="finalFeedbackRnd" class="form-label fw-bold" style="margin-button:2px">Final Feedback RND</label>
                        <textarea class="form-control form-control-sm" id="finalFeedbackRnd" rows="3" name="finalFeedbackRnd" required><?php echo $row['finalFeedbackRnd']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Review Harga (*Tandai (-) jika tidak Diisi).
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
        $('form#formFinalFeedbackRnd<?php echo $row['id']?>').on('submit', function(e){
            console.log($(this).serialize());
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../controller/actionFeedback.php",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: data.status == 0?'success':'warning',
                        title: data.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#finalFeedbackRnd<?php echo $row['id']?>').modal('hide');
        })
    })
</script>