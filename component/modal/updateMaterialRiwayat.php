<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

'<!-- Modal Update Material Riwayat -->'+
'<div class="modal" id="editMaterial'+data.id+'" data-bs-backdrop="static">'+
    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
        '<div class="modal-content" style="width: 500px;">'+

            '<!-- Modal Header -->'+
            '<div class="modal-header">'+
                '<div class="modal-title">Update Material</div>'+
            '</div>'+

            '<!-- Modal Body -->'+
            '<div class="modal-body">'+
                '<form class="was-validated" id="formEditMaterial'+data.id+'" autocomplete="off">'+

                    '<!-- Material Category -->'+
                        '<label class="form-label">Material Category</label>'+
                        '<div class="row">'+
                            '<div class="col">'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormAPI('+data.id+')" id="api'+data.id+'" value="API" '+(data.materialCategory == "API" ? 'checked':'')+' required>'+
                                    '<label class="form-check-label" for="api">API</label>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormEkstrak('+data.id+')" id="ekstrak'+data.id+'" value="Ekstrak" '+(data.materialCategory == "Ekstrak" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="ekstrak">Ekstrak</label>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormExcipient('+data.id+')" id="excipient'+data.id+'" value="Excipient" '+(data.materialCategory == "Excipient" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="excipient">Excipient</label>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormNasipre('+data.id+')" id="napsipre'+data.id+'" value="Narkotik, Psikotropik & Prekursor" '+(data.materialCategory == "Narkotik, Psikotropik & Prekursor" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormPackaging('+data.id+')" id="packaging'+data.id+'" value="Packaging" '+(data.materialCategory == "Packaging" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="packaging">Packaging</label>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormIntermediate('+data.id+')" id="intermediate'+data.id+'" value="Intermediate" '+(data.materialCategory == "Intermediate" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="intermediate">Intermediate</label>'+
                                '</div>'+
                                '<div class="form-check">'+
                                    '<input class="form-check-input" type="radio" name="materialCategory" onclick="formatFormRapidTest('+data.id+')" id="rapidTest'+data.id+'" value="Rapid Test" '+(data.materialCategory == "Rapid Test" ? 'checked':'')+' >'+
                                    '<label class="form-check-label" for="rapidTest">Rapid Test</label>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<!-- Material Name -->'+
                        '<div class="mb-3">'+
                            '<label for="materialName" class="form-label">Material Name</label>'+
                            '<textarea class="form-control" id="materialName" rows="3" name="materialName" required>'+(data.materialName != "" ? data.materialName:"")+'</textarea>'+
                            '<div class="invalid-feedback">'+
                                'Masukan Material Name (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+
                        '<!-- Material Spesification -->'+
                        '<div class="mb-3">'+
                            '<label for="materialSpesification" class="form-label">Material Spesification</label>'+
                            '<textarea class="form-control" id="materialSpesification" rows="3" name="materialSpesification" required>'+(data.materialSpesification != "" ? data.materialSpesification:"")+'</textarea>'+
                            '<div class="invalid-feedback">'+
                                'Masukan Material Spesification (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+
                        '<!-- Catalog Or CAS Number -->'+
                        '<div class="mb-3">'+
                            '<label for="catalogOrCasNumber" class="form-label">Catalog Or CAS Number</label>'+
                            '<input type="text" class="form-control" id="catalogOrCasNumber'+data.id+'" name="catalogOrCasNumber" value="'+(data.catalogOrCasNumber != " " ? data.catalogOrCasNumber:"")+'" '+ (data.materialCategory == "Rapid Test" || data.materialCategory == "Intermediate" ? '' :'disabled') +' required>'+
                            '<div class="invalid-feedback">'+
                            'Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                        '<!-- Company< -->'+
                        '<div class="mb-3">'+
                            '<label for="company" class="form-label">Company</label>'+
                            '<input type="text" class="form-control" id="company'+data.id+'" name="company" required value="'+(data.company != " " ? data.company:"")+'" '+ (data.materialCategory == "Rapid Test" ? '' :'disabled') +'>'+
                            '<div class="invalid-feedback">'+
                                'Masukan Company Produk (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                        '<!-- Website -->'+
                        '<div class="mb-3">'+
                            '<label for="website" class="form-label">Website</label>'+
                            '<input type="text" class="form-control" id="website'+data.id+'" name="website" required value="'+(data.website != " " ? data.website:"")+'" '+ (data.materialCategory == "Rapid Test" ? '' :'disabled') +'>'+
                            '<div class="invalid-feedback">'+
                                'Masukan Website Produk (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                        '<!-- Finish Dossage Form -->'+
                        '<div class="mb-3">'+
                            '<label for="finishDossageForm" class="form-label">Finish Dossage Form</label>'+
                            '<input type="text" class="form-control" id="finishDossageForm" name="finishDossageForm" required value="'+(data.finishDossageForm != "" ? data.finishDossageForm:"")+'">'+
                            '<div class="invalid-feedback">'+
                                'Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                        '<!-- Keterangan -->'+
                        '<div class="mb-3">'+
                            '<label for="keterangan" class="form-label">Keterangan</label>'+
                            '<textarea class="form-control" id="keterangan" rows="3" name="keterangan" required>'+(data.keterangan != "" ? data.keterangan:"")+'</textarea>'+
                            '<div class="invalid-feedback">'+
                                'Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                        '<!-- Document Requirement -->'+
                        '<div class="mb-3">'+
                            '<label for="documentReq" class="form-label">Document Requirement</label>'+
                            '<input type="text" class="form-control" id="documentReq" name="documentReq" required value="'+(data.documentReq != "" ? data.documentReq:"")+'">'+
                            '<div class="invalid-feedback">'+
                                'Masukan Document Requirement (*Tandai (-) jika tidak Diisi).'+
                            '</div>'+
                        '</div>'+

                    '</form>'+
            '</div>'+

            '<!-- Modal Footer -->'+
            '<div class="modal-footer">'+
                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                '<input type="submit" value="submit" class="btn btn-primary" onclick="funcUpdateMaterial('+data.id+', '+data.sourcingNumber+')" form="formEditMaterial'+data.id+'">'+
            '</div>'+

        '</div>'+
    '</div>'+
'</div>'+
