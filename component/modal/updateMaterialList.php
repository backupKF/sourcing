<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Update Material List -->
<div class="modal" id="editMaterial<?php echo $row['id']; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Update Material
                </h5>
            </div>
                    
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="was-validated" id="formEditMaterial<?php echo $row['id']?>" autocomplete="off">
                    <!-- Material Category -->
                    <label class="form-label fw-bold">Material Category</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" <?php echo $row['materialCategory']=="API"? 'checked' :''; ?> required>
                                <label class="form-check-label" for="api">API</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak" <?php echo $row['materialCategory']=="Ekstrak"? 'checked' :''; ?> >
                                <label class="form-check-label" for="ekstrak">Ekstrak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient" <?php echo $row['materialCategory']=="Excipient"? 'checked' :''; ?> >
                                <label class="form-check-label" for="excipient">Excipient</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor" <?php echo $row['materialCategory']=="Narkotik, Psikotropik & Prekursor"? 'checked' :''; ?> >
                                <label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging" <?php echo $row['materialCategory']=="Packaging"? 'checked' :''; ?> >
                                <label class="form-check-label" for="packaging">Packaging</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate" <?php echo $row['materialCategory']=="Intermediate"? 'checked' :''; ?> >
                                <label class="form-check-label" for="intermediate">Intermediate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test" <?php echo $row['materialCategory']=="Rapid Test"? 'checked' :''; ?> >
                                <label class="form-check-label" for="rapidTest">Rapid Test</label>
                            </div>
                        </div>
                    </div>
                    <!-- Material Name -->
                   <div class="mb-3">
                        <label for="materialName" class="form-label fw-bold">Material Name</label>
                        <textarea class="form-control" id="materialName" rows="3" name="materialName" required><?php echo !empty($row['materialName'])? $row['materialName']:''; ?></textarea>
                        <div class="invalid-feedback">
                            Masukan Material Name (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Priority -->
                    <div class="mb-3">
                        <label for="priority" class="form-label fw-bold">Priority</label>
                        <input type="number" class="form-control" id="priority" name="priority" required value="<?php echo !empty($row['priority'])? $row['priority']:'';?>">
                        <div class="invalid-feedback">
                            Masukan Priority (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Material Spesification -->
                    <div class="mb-3">
                        <label for="materialSpesification" class="form-label fw-bold">Material Spesification</label>
                        <textarea class="form-control" id="materialSpesification" rows="3" name="materialSpesification" required><?php echo !empty($row['materialSpesification'])? $row['materialSpesification']:''; ?></textarea>
                        <div class="invalid-feedback">
                            Masukan Material Spesification (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Catalog Or CAS Number -->
                    <div class="mb-3">
                        <label for="catalogOrCasNumber" class="form-label fw-bold">Catalog Or CAS Number</label>
                        <input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" required value="<?php echo !empty($row['catalogOrCasNumber'])? $row['catalogOrCasNumber']:'';?>" <?php echo $row['materialCategory']=="Rapid Test" || $row['materialCategory']=="Intermediate" ? '' :'disabled'; ?>>
                        <div class="invalid-feedback">
                            Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Company< -->
                    <div class="mb-3">
                        <label for="company" class="form-label fw-bold">Company</label>
                        <input type="text" class="form-control" id="company" name="company" required value="<?php echo !empty($row['company'])? $row['company']:''; ?>" <?php echo $row['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                        <div class="invalid-feedback">
                            Masukan Company Produk (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Website -->
                    <div class="mb-3">
                        <label for="website" class="form-label fw-bold">Website</label>
                        <input type="text" class="form-control" id="website" name="website" required value="<?php echo !empty($row['website'])? $row['website']:''; ?>" <?php echo $row['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                        <div class="invalid-feedback">
                            Masukan Website Produk (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Finish Dossage Form -->
                    <div class="mb-3">
                        <label for="finishDossageForm" class="form-label fw-bold">Finish Dossage Form</label>
                        <input type="text" class="form-control" id="finishDossageForm" name="finishDossageForm" required value="<?php echo !empty($row['finishDossageForm'])? $row['finishDossageForm']:''; ?>">
                        <div class="invalid-feedback">
                            Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan" required><?php echo !empty($row['keterangan'])? $row['keterangan']:''; ?></textarea>
                        <div class="invalid-feedback">
                            Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Vendor Terdaftar AERO -->
                    <div class="mb-3">
                        <label for="vendor" class="form-label fw-bold">Vendor Terdaftar AERO</label>
                        <input type="text" class="form-control" id="vendor" name="vendor" required value="<?php echo !empty($row['vendor'])? $row['vendor']:'';?>">
                        <div class="invalid-feedback">
                            Masukan Vendor Terdaftar AERO (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Document Requirement -->
                    <div class="mb-3">
                        <label for="documentReq" class="form-label fw-bold">Document Requirement</label>
                        <input type="text" class="form-control" id="documentReq" name="documentReq" required value="<?php echo !empty($row['documentReq'])? $row['documentReq']:'';?>">
                        <div class="invalid-feedback">
                            Masukan Document Requirement (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                </form>
            </div>
                        
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
                <button type="submit" class="btn btn-primary" form="formEditMaterial<?php echo $row['id']?>">Submit</button>
            </div>
        </div>
    </div>
</div>
 <!-- End Formulir Tambah Material -->

 <script>
        $(document).ready(function() {
            $( "input#api" ).click(function() {
                $("input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#ekstrak" ).click(function() {
                $("input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#excipient" ).click(function() {
                $("input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#napsipre" ).click(function() {
                $("input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#packaging" ).click(function() {
                $("input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#intermediate" ).click(function() {
                $("input#catalogOrCasNumber").removeAttr('disabled');
                $("input#company").attr('disabled', 'disabled');
                $("input#website").attr('disabled', 'disabled');
            });
            $( "input#rapidTest" ).click(function() {
                $("input#catalogOrCasNumber").removeAttr("disabled");
                $("input#company").removeAttr("disabled");
                $("input#website").removeAttr("disabled");
            });
        });

        document.getElementById("formEditMaterial<?php echo $row['id']?>").addEventListener('submit', event => {
            event.preventDefault();
            // actual logic, e.g. validate the form
            funcUpdateMaterial(<?php echo $row['id']?>)
        });
 </script>