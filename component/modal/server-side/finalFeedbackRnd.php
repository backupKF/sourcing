<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Feedback Final Rnd -->'+
'<div class="modal" id="finalFeedbackRnd'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">Final Feedback RND</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="p-1 was-validated" id="formFinalFeedbackRnd'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcFinalFeedbackRnd('+dataSupplier.id+');">'+
                    '<!-- Final Feedback RnD -->'+
                    '<div class="mb-1">'+
                        '<label for="finalFeedbackRnd" class="form-label" style="margin-button:2px">Final Feedback RND</label>'+
                        '<textarea class="form-control form-control-sm" id="finalFeedbackRnd" rows="3" name="finalFeedbackRnd" required>'+dataSupplier.finalFeedbackRnd+'</textarea>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Final Feedback Rnd (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</div>'+
                    '<input type="submit" class="btn btn-primary btn-sm" value="Submit">'+
                '</form>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+