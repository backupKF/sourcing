<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Feedback Final Rnd -->
<div class="modal" id="finalFeedbackRnd<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Final Feedback RND</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formFinalFeedbackRnd<?php echo $row['id']?>" autocomplete="off">
                    <!-- Final Feedback RnD -->
                    <div class="mb-1">
                        <label for="finalFeedbackRnd" class="form-label" style="margin-button:2px">Final Feedback RND</label>
                        <textarea class="form-control form-control-sm" id="finalFeedbackRnd" rows="3" name="finalFeedbackRnd" required><?php echo $row['finalFeedbackRnd']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Final Feedback Rnd (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
    // Listen Event Submit
    document.getElementById("formFinalFeedbackRnd<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcFinalFeedbackRnd(<?php echo $row['id']?>)
    });
</script>