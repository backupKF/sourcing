<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Feedback Rnd-->'+
'<div class="modal" id="feedbackRnd'+dataSupplier.id+'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
    '<div class="modal-dialog modal-dialog-centered">'+
        '<div class="modal-content" style="width: 1500px;">'+
            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title" id="staticBackdropLabel">Feedback Sampel dan lainnya</div>'+
            '</div>'+
            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="p-1 was-validated" id="formFeedbackRnd'+dataSupplier.id+'" autocomplete="off" onsubmit="event.preventDefault(); funcFeedbackRnd<?php echo $_GET['idMaterial']?>('+dataSupplier.id+');">'+
                    '<!-- Review Harga -->'+
                    '<div class="mb-1">'+
                        '<label for="priceReview" class="form-label" style="margin-button:2px">Review Harga</label>'+
                        '<textarea class="form-control form-control-sm" id="priceReview" rows="3" name="priceReview" required>'+ dataSupplier.feedbackRndPriceReview +'</textarea>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Review Harga (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</div>'+
                    '<!-- Sampel dan lainnya -->'+
                    '<div class="mb-1">'+
                        '<label for="sampel" class="form-label" style="margin-button:2px">Sampel dan lainnya</label>'+
                        '<textarea class="form-control form-control-sm" id="sampel" rows="3" name="sampel" required></textarea>'+
                        '<div class="invalid-feedback">'+
                            'Masukan Sampel dan lainnya (*Tandai (-) jika tidak Diisi).'+
                        '</div>'+
                    '</div>'+
                    '<input type="submit" class="btn btn-primary btn-sm" value="Submit">'+
                '</form>'+
                '<!-- Tampilan Content Feedback Rnd -->'+
                '<div class="overflow-auto" style="height:160px;">'+
                    dataSupplier.outputFeedbackRnd +
                '</div>'+
            '</div>'+
            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+