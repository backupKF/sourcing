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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Feedback Proc</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formFeedbackProc<?php echo $row['id']?>" autocomplete="off">
                    <input type="hidden" name="feedbackProc" value="true">
                    <input type="hidden" name="idSupplier" value="<?php echo $row['id']?>">
                    <input type="hidden" name="writer" value="anonymous">
                    <!-- Feedback Proc -->
                    <div class="mb-1">
                        <label for="feedback" class="form-label fw-bold" style="margin-button:2px">Feedback Proc</label>
                        <textarea class="form-control form-control-sm" id="feedback" rows="3" name="feedback" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Feedback Proc (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
                <!-- Tampilan content riwayat feedback proc -->
                <div class="overflow-auto" style="height:200px;background-color:#f1fca7">
                    <?php
                        $dataDetailFeedbackProc = $conn->query("SELECT * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY id DESC")->fetchAll();
                        foreach($dataDetailFeedbackProc as $dataProc){
                    ?>
                        <div class="my-2">
                            <div class="text-success text-center" style="width:100px;font-size:15px">
                                <?php echo $dataProc['dateFeedbackProc']?>
                            </div>
                            <div style="font-size:14px;width:440px" class="text-wrap">
                                <?php echo $dataProc['feedback']?>
                            </div>
                            <div style="font-size:12px" class="fw-bold">
                                By: <?php echo $dataProc['writer']?>
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
    document.getElementById("formFeedbackProc<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcFeedbackProc(<?php echo $row['id']?>)
    });
</script>