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
                <?php 
                    $finalFeedbackRnd = $conn->query("SELECT * FROM TB_FinalFeedbackRnd WHERE idSupplier='{$row['id']}'")->fetchAll();
                ?>
                <form class="bg-warning p-1 was-validated" id="formFinalFeedbackRnd<?php echo $row['id']?>">
                    <input type="hidden" name="idSupplier" value="<?php echo $row['id']?>">
                    <input type="hidden" name="idFinalFeedbackRnd" value="<?php echo $finalFeedbackRnd[0]['id']?>">
                    <!-- Final Feedback RnD -->
                    <div class="mb-1">
                        <label for="finalFeedbackRnd" class="form-label fw-bold" style="margin-button:2px">Final Feedback RND</label>
                        <textarea class="form-control form-control-sm" id="finalFeedbackRnd" rows="3" name="finalFeedbackRnd" required><?php echo $finalFeedbackRnd[0]['finalFeedbackRnd']?></textarea>
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
                url: "controller/actionFeedback.php",
                data: $(this).serialize(),
                success: function(data){
                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#finalFeedbackRnd<?php echo $row['id']?>').modal('hide');
        })
    })
</script>