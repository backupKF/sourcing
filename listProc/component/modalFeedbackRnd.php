<!-- Modal UpdateSupplier-->
<div class="modal" id="feedbackRnd<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Feedback Sampel dan lainnya</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="bg-warning p-1 was-validated" id="formFeedbackRnd<?php echo $row['id']?>">
                    <input type="hidden" name="feedbackRnd" value="true">
                    <input type="hidden" name="idSupplier" value="<?php echo $row['id']?>">
                    <input type="hidden" name="writer" value="anonymous">
                    <!-- Review Harga -->
                    <div class="mb-1">
                        <label for="priceReview" class="form-label fw-bold" style="margin-button:2px">Review Harga</label>
                        <textarea class="form-control form-control-sm" id="priceReview" rows="3" name="priceReview" required><?php echo $row['feedbackRndPriceReview']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Review Harga (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Sampel dan lainnya -->
                    <div class="mb-1">
                        <label for="sampel" class="form-label fw-bold" style="margin-button:2px">Sampel dan lainnya</label>
                        <textarea class="form-control form-control-sm" id="sampel" rows="3" name="sampel" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Sampel dan lainnya (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Submit">
                </form>
                <div class="overflow-auto" style="height:200px">
                    <?php
                        $dataDetailFeedbackRnd = $conn->query("SELECT * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}'")->fetchAll();
                        foreach($dataDetailFeedbackRnd as $data){
                    ?>
                        <div class="my-2">
                            <div class="text-success text-center" style="width:85px;font-size:14px;">
                                <?php echo $data['dateFeedback']?>
                            </div>
                            <div class="text-wrap" style="width:440px">
                                <?php echo $data['sampel']?>
                            </div>
                            <div class="fw-bold" style="font-size:12px">
                                By: <?php echo $data['writer']?>
                            </div>
                        </div>
                        <hr>
                    <?php
                        }
                    ?>
                </div>
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
        $('form#formFeedbackRnd<?php echo $row['id']?>').on('submit', function(e){
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
            $('#feedbackRnd<?php echo $row['id']?>').modal('hide');
        })
    })
</script>