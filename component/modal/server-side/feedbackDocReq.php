<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Feedback Doc Req-->'+
'<div class="modal" id="feedbackDocReq'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">Feedback Document Requirment</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="was-validated" id="formFeedbackDocReq'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcFeedbackDocReq<?php echo $_GET['idMaterial']?>('+dataSupplier.id+');">'+
                    '<input type="hidden" name="idFeedbackDocReq" value="'+dataSupplier.idfeedbackDocReq+'">'+
                     '<!-- Feedback Doc CoA -->'+
                     '<div class="row">'+
                            '<div class="col">'+
                                'CoA'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="CoA" value="ok" '+ (dataSupplier.docCoA == "ok" ? "checked":"") +' id="CoA">'+
                                    '<label class="form-check-label" for="CoA">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="CoA" value="notOk" '+ (dataSupplier.docCoA == "notOk" ? "checked":"") +' id="CoA">'+
                                    '<label class="form-check-label" for="CoA">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- Feedback Doc MSDS -->'+
                        '<div class="row">'+
                            '<div class="col">'+
                                'MSDS'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="MSDS" value="ok" '+ (dataSupplier.docMSDS == "ok" ? "checked":"") +' id="MSDS">'+
                                    '<label class="form-check-label" for="MSDS">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="MSDS" value="notOk" '+ (dataSupplier.docMSDS == "notOk" ? "checked":"") +' id="MSDS">'+
                                    '<label class="form-check-label" for="MSDS">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- Feedback Doc MoA -->'+
                        '<div class="row">'+
                            '<div class="col">'+
                                'MoA'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="MoA" value="ok" '+ (dataSupplier.docMoA == "ok" ? "checked":"") +' id="MoA">'+
                                    '<label class="form-check-label" for="MoA">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="MoA" value="notOk" '+ (dataSupplier.docMoA == "notOk" ? "checked":"") +' id="MoA">'+
                                    '<label class="form-check-label" for="MoA">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- Feedback Doc Halal -->'+
                        '<div class="row">'+
                            '<div class="col">'+
                                'Halal'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="Halal" value="ok" '+ (dataSupplier.docHalal == "ok" ? "checked":"") +' id="Halal">'+
                                    '<label class="form-check-label" for="Halal">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="Halal" value="notOk" '+ (dataSupplier.docHalal == "notOk" ? "checked":"") +' id="Halal">'+
                                    '<label class="form-check-label" for="Halal">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- Feedback Doc DMF -->'+
                        '<div class="row">'+
                            '<div class="col">'+
                                'DMF'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="DMF" value="ok" '+ (dataSupplier.docDMF == "ok" ? "checked":"") +' id="DMF">'+
                                    '<label class="form-check-label" for="DMF">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="DMF" value="notOk" '+ (dataSupplier.docDMF == "notOk" ? "checked":"") +' id="DMF">'+
                                    '<label class="form-check-label" for="DMF">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- Feedback Doc GMP -->'+
                        '<div class="row">'+
                            '<div class="col">'+
                                'GMP'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="GMP" value="ok" '+ (dataSupplier.docGMP == "ok" ? "checked":"") +' id="GMP">'+
                                    '<label class="form-check-label" for="GMP">'+
                                        'OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check p-0">'+
                                    '<input class="form-check-input" type="radio" name="GMP" value="notOk" '+ (dataSupplier.docGMP == "notOk" ? "checked":"") +' id="GMP">'+
                                    '<label class="form-check-label" for="GMP">'+
                                        'NOT OK'+
                                    '</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<!-- -- -->'+
                '</form>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
                '<input type="submit" class="btn btn-primary" name="submit" value="Submit" form="formFeedbackDocReq'+dataSupplier.id+'">'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+

