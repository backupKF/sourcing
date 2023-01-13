<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal Feedback Doc Req-->
<div class="modal" id="feedbackDocReq<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title" id="staticBackdropLabel">Feedback Document Requirment</div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <?php 
                    // Mengambil data Doc Req
                    $feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll();
                ?>
                <form class="was-validated" id="formFeedbackDocReq<?php echo $row['id']?>" autocomplete="off">
                    <input type="hidden" name="idFeedbackDocReq" value="<?php echo $feedbackDocReq[0]['id']?>">
                     <!-- Feedback Doc CoA -->
                     <div class="row">
                            <div class="col">
                                CoA
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="CoA" value="ok" <?php echo $feedbackDocReq[0]['CoA']=="ok"? 'checked' :''; ?> id="CoA">
                                    <label class="form-check-label" for="CoA">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="CoA" value="notOk" <?php echo $feedbackDocReq[0]['CoA']=="notOk"? 'checked' :''; ?> id="CoA">
                                    <label class="form-check-label" for="CoA">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Doc MSDS -->
                        <div class="row">
                            <div class="col">
                                MSDS
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="MSDS" value="ok" <?php echo $feedbackDocReq[0]['MSDS']=="ok"? 'checked' :''; ?> id="MSDS">
                                    <label class="form-check-label" for="MSDS">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="MSDS" value="notOk" <?php echo $feedbackDocReq[0]['MSDS']=="notOk"? 'checked' :''; ?> id="MSDS">
                                    <label class="form-check-label" for="MSDS">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Doc MoA -->
                        <div class="row">
                            <div class="col">
                                MoA
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="MoA" value="ok" <?php echo $feedbackDocReq[0]['MoA']=="ok"? 'checked' :''; ?> id="MoA">
                                    <label class="form-check-label" for="MoA">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="MoA" value="notOk" <?php echo $feedbackDocReq[0]['MoA']=="notOk"? 'checked' :''; ?> id="MoA">
                                    <label class="form-check-label" for="MoA">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Doc Halal -->
                        <div class="row">
                            <div class="col">
                                Halal
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="Halal" value="ok" <?php echo $feedbackDocReq[0]['Halal']=="ok"? 'checked' :''; ?> id="Halal">
                                    <label class="form-check-label" for="Halal">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="Halal" value="notOk" <?php echo $feedbackDocReq[0]['Halal']=="notOk"? 'checked' :''; ?> id="Halal">
                                    <label class="form-check-label" for="Halal">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Doc DMF -->
                        <div class="row">
                            <div class="col">
                                DMF
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="DMF" value="ok" <?php echo $feedbackDocReq[0]['DMF']=="ok"? 'checked' :''; ?> id="DMF">
                                    <label class="form-check-label" for="DMF">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="DMF" value="notOk" <?php echo $feedbackDocReq[0]['DMF']=="notOk"? 'checked' :''; ?> id="DMF">
                                    <label class="form-check-label" for="DMF">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Doc GMP -->
                        <div class="row">
                            <div class="col">
                                GMP
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="GMP" value="ok" <?php echo $feedbackDocReq[0]['GMP']=="ok"? 'checked' :''; ?> id="GMP">
                                    <label class="form-check-label" for="GMP">
                                        OK
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check p-0">
                                    <input class="form-check-input" type="radio" name="GMP" value="notOk" <?php echo $feedbackDocReq[0]['GMP']=="notOk"? 'checked' :''; ?> id="GMP">
                                    <label class="form-check-label" for="GMP">
                                        NOT OK
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- -- -->
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit" form="formFeedbackDocReq<?php echo $row['id']?>">
            </div>
        </div>
    </div>
</div>
<script>
    // Listen Event Submit
    document.getElementById("formFeedbackDocReq<?php echo $row['id']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcFeedbackDocReq(<?php echo $row['id']?>)
    });
</script>