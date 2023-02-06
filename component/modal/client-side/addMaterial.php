<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

<!-- Modal Add Material -->
<div class="modal" id="modalTambahMaterial" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Tambah Material</div>
            </div>
                    
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../controller/actionPengajuan.php" method="POST" class="was-validated" id="formTambahMaterial<?php echo $_SESSION['project'] ?>" autocomplete="off">
                    <!-- Material Category -->
                    <label class="form-label">Material Category</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" required>
                                <label class="form-check-label" for="api">API</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak">
                                <label class="form-check-label" for="ekstrak">Ekstrak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient">
                                <label class="form-check-label" for="excipient">Excipient</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor">
                                <label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging">
                                <label class="form-check-label" for="packaging">Packaging</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate">
                                <label class="form-check-label" for="intermediate">Intermediate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test">
                                <label class="form-check-label" for="rapidTest">Rapid Test</label>
                            </div>
                        </div>
                    </div>
                    <!-- Material Name -->
                    <div class="mb-3">
                        <label for="materialName" class="form-label">Material Name</label>
                        <textarea class="form-control" id="materialName" rows="3" name="materialName" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Material Name (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Material Spesification -->
                    <div class="mb-3">
                        <label for="materialSpesification" class="form-label">Material Spesification</label>
                        <textarea class="form-control" id="materialSpesification" rows="3" name="materialSpesification" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Material Spesification (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Catalog Or CAS Number -->
                    <div class="mb-3">
                        <label for="catalogOrCasNumber" class="form-label">Catalog Or CAS Number</label>
                        <input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" required>
                        <div class="invalid-feedback">
                            Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Company< -->
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" required>
                        <div class="invalid-feedback">
                            Masukan Company Produk (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Website -->
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" id="website" name="website" required>
                        <div class="invalid-feedback">
                            Masukan Website Produk (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Finish Dossage Form -->
                    <div class="mb-3">
                        <label for="finishDossageForm" class="form-label">Finish Dossage Form</label>
                        <input type="text" class="form-control" id="finishDossageForm" name="finishDossageForm" required>
                        <div class="invalid-feedback">
                            Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan" required></textarea>
                        <div class="invalid-feedback">
                            Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Document Requirement -->
                    <div class="mb-3">
                        <label for="documentReq" class="form-label">Document Requirement</label>
                        <input type="text" class="form-control" id="documentReq" name="documentReq" required>
                        <div class="invalid-feedback">
                            Masukan Document Requirement (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <!-- Set Project -->
                    <input type="hidden" name="projectCode" value="<?php echo $_SESSION['project']?>">
                </form>
            </div>
                        
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
                <input type="submit" value="submit" class="btn btn-primary" name="tambahDataMaterial" form="formTambahMaterial<?php echo $_SESSION['project'] ?>">
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
 </script>