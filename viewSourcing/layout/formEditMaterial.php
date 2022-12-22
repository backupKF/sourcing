            <?php
                include "../../dbConfig.php";
                $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE id='{$_GET['idMaterial']}' AND feedbackRPIC=1")->fetchAll();
            ?>
            <form class="was-validated" id="formEditMaterial">
                <!-- Get ID -->
                <input type="hidden" name="id" value="<?php echo !empty($dataMaterial[0]['id'])? $dataMaterial[0]['id']:'';?>">
                <input type="hidden" name="editMaterial" value="true">
                <!-- Material Category -->
                <label class="form-label fw-bold">Material Category</label>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" <?php echo $dataMaterial[0]['materialCategory']=="API"? 'checked' :''; ?> required>
                            <label class="form-check-label" for="api">API</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak" <?php echo $dataMaterial[0]['materialCategory']=="Ekstrak"? 'checked' :''; ?> >
                            <label class="form-check-label" for="ekstrak">Ekstrak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient" <?php echo $dataMaterial[0]['materialCategory']=="Excipient"? 'checked' :''; ?> >
                            <label class="form-check-label" for="excipient">Excipient</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor" <?php echo $dataMaterial[0]['materialCategory']=="Narkotik, Psikotropik & Prekursor"? 'checked' :''; ?> >
                            <label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging" <?php echo $dataMaterial[0]['materialCategory']=="Packaging"? 'checked' :''; ?> >
                            <label class="form-check-label" for="packaging">Packaging</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate" <?php echo $dataMaterial[0]['materialCategory']=="Intermediate"? 'checked' :''; ?> >
                            <label class="form-check-label" for="intermediate">Intermediate</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? 'checked' :''; ?> >
                            <label class="form-check-label" for="rapidTest">Rapid Test</label>
                        </div>
                    </div>
                </div>

                <hr class="m-0">

                <div class="row">
                    <div class="col m-0 mt-1">
                        <!-- Material Deskripsi -->
                        <div class="mb-3">
                            <label for="materialName" class="form-label fw-bold">Material Deskripsi</label>
                            <textarea class="form-control form-control-sm" id="materialName" rows="3" name="materialName" required><?php echo !empty($dataMaterial[0]['materialName'])? $dataMaterial[0]['materialName']:''; ?></textarea>
                            <div class="invalid-feedback">
                                Masukan Material Deskripsi (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">   
                        <!-- Material Spesification -->
                        <div class="mb-3">
                        <label for="materialSpesification" class="form-label fw-bold">Material Spesification</label>
                        <textarea class="form-control form-control-sm" id="materialSpesification" rows="3" name="materialSpesification" required><?php echo !empty($dataMaterial[0]['materialSpesification'])? $dataMaterial[0]['materialSpesification']:''; ?></textarea>
                        <div class="invalid-feedback">
                            Masukan Material Spesification (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                </div>
                    
                <hr class="m-0">

                <div class="row">
                    <div class="col m-0 mt-1">
                        <!-- Priority -->
                        <div class="mb-3">
                            <label for="priority" class="form-label fw-bold">Priority</label>
                            <input type="number" class="form-control form-control-sm" id="priority" name="priority" required value="<?php echo !empty($dataMaterial[0]['priority'])? $dataMaterial[0]['priority']:'';?>">
                            <div class="invalid-feedback">
                                Masukan Priority (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">
                        <!-- Finish Dossage Form -->
                        <div class="mb-3">
                            <label for="finishDossageForm" class="form-label fw-bold">Finish Dossage Form</label>
                            <input type="text" class="form-control form-control-sm" id="finishDossageForm" name="finishDossageForm" required value="<?php echo !empty($dataMaterial[0]['finishDossageForm'])? $dataMaterial[0]['finishDossageForm']:''; ?>">
                            <div class="invalid-feedback">
                                Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">
                        <!-- Vendor Terdaftar AERO -->
                        <div class="mb-3">
                            <label for="vendor" class="form-label fw-bold">Vendor Terdaftar AERO</label>
                            <input type="text" class="form-control form-control-sm" id="vendor" name="vendor" required value="<?php echo !empty($dataMaterial[0]['vendor'])? $dataMaterial[0]['vendor']:'';?>">
                            <div class="invalid-feedback">
                                Masukan Vendor Terdaftar AERO (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">
                        <!-- Document Requirement -->
                        <div class="mb-3">
                            <label for="documentReq" class="form-label fw-bold">Document Requirement</label>
                            <input type="text" class="form-control form-control-sm" id="documentReq" name="documentReq" required value="<?php echo !empty($dataMaterial[0]['documentReq'])? $dataMaterial[0]['documentReq']:'';?>">
                            <div class="invalid-feedback">
                                 Masukan Document Requirement (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                </div>
                    
                <hr class="m-0">

                <div class="row">
                    <div class="col m-0 mt-1">
                        <!-- Catalog Or CAS Number -->
                        <div class="mb-3">
                            <label for="catalogOrCasNumber" class="form-label fw-bold">Catalog Or CAS Number</label>
                            <input type="text" class="form-control form-control-sm" id="catalogOrCasNumber" name="catalogOrCasNumber" required value="<?php echo !empty($dataMaterial[0]['catalogOrCasNumber'])? $dataMaterial[0]['catalogOrCasNumber']:'';?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test" || $dataMaterial[0]['materialCategory']=="Intermediate" ? '' :'disabled'; ?>>
                            <div class="invalid-feedback">
                                Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">
                        <!-- Company< -->
                        <div class="mb-3">
                            <label for="company" class="form-label fw-bold">Company</label>
                            <input type="text" class="form-control form-control-sm" id="company" name="company" required value="<?php echo !empty($dataMaterial[0]['company'])? $dataMaterial[0]['company']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                            <div class="invalid-feedback">
                                Masukan Company Produk (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    <div class="col m-0 mt-1">
                        <!-- Website -->
                        <div class="mb-3">
                            <label for="website" class="form-label fw-bold">Website</label>
                            <input type="text" class="form-control form-control-sm" id="website" name="website" required value="<?php echo !empty($dataMaterial[0]['website'])? $dataMaterial[0]['website']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                            <div class="invalid-feedback">
                                Masukan Website Produk (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="m-0">

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                    <textarea class="form-control form-control-sm" id="keterangan" rows="3" name="keterangan" required><?php echo !empty($dataMaterial[0]['keterangan'])? $dataMaterial[0]['keterangan']:''; ?></textarea>
                    <div class="invalid-feedback">
                        Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).
                    </div>
                </div>
                <button class="btn btn-warning btn-sm" style="width:120px;margin-left:12px">
                    Edit Material
                </button>
            </form>
            <script>
                $(document).ready(function(){
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

                    $('form#formEditMaterial').on('submit', function(e){
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "../controller/actionUpdateMaterial.php",
                            data: $(this).serialize(),
                            success: function(data){
                                loadDataMaterial(<?php echo $_GET['idMaterial']?>)
                            }
                        })
                    })
                })
            </script>