<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal Feedback Proc-->
<div class="modal" id="feedbackProc<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Feedback Proc</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formFeedbackProc<?php echo $row['id']?>" autocomplete="off">
                    <!-- Feedback Proc -->
                    <div class="mb-1">
                        <label for="feedback" class="form-label" style="margin-button:2px">Feedback Proc</label>
                        <textarea class="form-control form-control-sm" id="feedback" rows="3" name="feedback" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Feedback Proc (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
                <!-- Tampilan content riwayat feedback proc -->
                <div class="overflow-auto" style="height:200px;">
                    <?php
                        $dataDetailFeedbackProc = $conn->query("SELECT * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll();
                        foreach($dataDetailFeedbackProc as $dataProc){
                    ?>
                        <div class="ms-1 my-2">
                            <!-- Tanggal Feedback Proc -->
                            <div class="bg-success bg-opacity-75" style="width:95px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $dataProc['dateFeedbackProc']?></div>
                            <!-- Isi Feedback Proc -->
                            <div class="text-wrap" style="font-size:14px;font-family:poppinsMedium;"><?php echo $dataProc['feedback']?></div>
                            <!-- Penulis -->
                             <div style="font-size:10px;font-family:poppinsBold;">By: <?php echo $dataProc['writer']?></div>
                        </div>

                        <hr class="m-0">
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
    document.getElementById("formFeedbackProc<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcFeedbackProc(<?php echo $row['id']?>)
    });
</script>