<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Feedback Proc-->'+
'<div class="modal" id="feedbackProc'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">Feedback Proc</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="p-1 was-validated" id="formFeedbackProc'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcFeedbackProc('+dataSupplier.id+');">'+
                    '<!-- Feedback Proc -->'+
                    '<div class="mb-1">'+
                        '<label for="feedback" class="form-label" style="margin-button:2px">Feedback Proc</label>'+
                        '<textarea class="form-control form-control-sm" id="feedback" rows="3" name="feedback" required></textarea>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Feedback Proc (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</div>'+
                    '<input type="submit" class="btn btn-primary btn-sm" value="Submit">'+
                '</form>'+
                '<!-- Tampilan content riwayat feedback proc -->'+
                '<div class="overflow-auto" style="height:200px;">'+
                    dataSupplier.outputFeedbackProc +
                '</div>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+