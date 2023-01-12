<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Feedback Rnd-->
<div class="modal" id="feedbackRnd<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Feedback Sampel dan lainnya</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formFeedbackRnd<?php echo $row['id']?>" autocomplete="off">
                    <!-- Review Harga -->
                    <div class="mb-1">
                        <label for="priceReview" class="form-label" style="margin-button:2px">Review Harga</label>
                        <textarea class="form-control form-control-sm" id="priceReview" rows="3" name="priceReview" required><?php echo $row['feedbackRndPriceReview']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Review Harga (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Sampel dan lainnya -->
                    <div class="mb-1">
                        <label for="sampel" class="form-label" style="margin-button:2px">Sampel dan lainnya</label>
                        <textarea class="form-control form-control-sm" id="sampel" rows="3" name="sampel" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Sampel dan lainnya (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
                <!-- Tampilan Content Feedback Rnd -->
                <div class="overflow-auto" style="height:160px;"> 
                    <?php
                        $dataDetailFeedbackRnd = $conn->query("SELECT * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll();
                        foreach($dataDetailFeedbackRnd as $data){
                    ?>
                        <div class="ms-1 my-2">
                            <!-- Tanggal Feedback Rnd -->
                            <div class="bg-success bg-opacity-75" style="width:95px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $data['dateFeedback']?></div>
                            <!-- Isi Feedback Rnd -->
                            <div class="text-wrap" style="font-size:14px;font-family:poppinsMedium;"><?php echo $data['sampel']?></div>
                            <!-- Penulis -->
                             <div style="font-size:10px;font-family:poppinsBold;">By: <?php echo $data['writer']?></div>
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
    document.getElementById("formFeedbackRnd<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcFeedbackRnd(<?php echo $row['id']?>)
    });
</script>