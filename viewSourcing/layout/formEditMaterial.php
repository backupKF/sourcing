<?php
    session_start();

    include "../../dbConfig.php";

    // Ketika tidak ada data get yang masuk maka akan me-redirect kehalaman index
    if(empty($_GET)){
        header('Location: ../index.php');
    }
    
    // Mengambil data material
    $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE id='{$_GET['idMaterial']}' AND feedbackRPIC=1")->fetchAll();

    // Jika user level 1
    if($_SESSION['user']['level'] == 1){
?>

<!-- Title -->
<div class="text-center mb-2" style="font-family:poppinsBlack;font-size:25px">Lembar Kerja Update Sourcing</div>

<!-- Status Sourcing -->
<div class="d-flex justify-content-end">
    <span class="badge text-dark" style="font-size:15px;font-family:poppinsBlack;width:120px;<?php echo ($dataMaterial[0]['statusSourcing'] == "DONE" ? "background-color:#9cff9d":($dataMaterial[0]['statusSourcing'] == "OPEN" ? "background-color:#7380fa":($dataMaterial[0]['statusSourcing'] == "RE-OPEN" ? "background-color:#a1ecff":($dataMaterial[0]['statusSourcing'] == "DROP" ? "background-color:#bd7aff":($dataMaterial[0]['statusSourcing'] == "NOT YET" ? "background-color:#ff6040":($dataMaterial[0]['statusSourcing'] == "HOLD" ? "background-color:#f72a34":($dataMaterial[0]['statusSourcing'] == "NO STATUS" ? "background-color:#a1a1a1":""))))))) ?>"><?php echo $dataMaterial[0]['statusSourcing']?></span>
</div>
 
<form class="was-validated" id="formEditMaterial<?php echo $dataMaterial[0]['id']?>" autocomplete="off">
    <!-- Material Category -->
    <label class="form-label" style="font-size:17px;font-family:poppinsBold">Material Category</label>
    <div class="row" style="font-size:15px;font-family:poppinsRegular">
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

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Material Name -->
            <div class="mb-3">
                <label for="materialName" class="form-label" style="font-size:17px;font-family:poppinsBold">Material Name</label>
                <textarea class="form-control form-control-sm" id="materialName" maxlength="150" rows="3" name="materialName" required><?php echo !empty($dataMaterial[0]['materialName'])? $dataMaterial[0]['materialName']:''; ?></textarea>
                <div class="invalid-feedback">
                    Masukan Material Name (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
        <div class="col m-0 mt-1">   
            <!-- Material Spesification -->
            <div class="mb-3">
            <label for="materialSpesification" class="form-label" style="font-size:17px;font-family:poppinsBold">Material Spesification</label>
            <textarea class="form-control form-control-sm" id="materialSpesification" rows="3" name="materialSpesification" required><?php echo !empty($dataMaterial[0]['materialSpesification'])? $dataMaterial[0]['materialSpesification']:''; ?></textarea>
            <div class="invalid-feedback">
                 Masukan Material Spesification (*Tandai (-) jika tidak Diisi).
            </div>
        </div>
    </div>
                    
    <hr class="m-0">

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Priority -->
            <div class="mb-3">
                <label for="priority" class="form-label" style="font-size:17px;font-family:poppinsBold">Priority</label>
                <select class="form-select form-select-sm" aria-label="Default select example" name="priority" required>
                    <option></option>
                    <option value="1" <?php echo $dataMaterial[0]['priority'] == 1 ? 'selected':''; ?> >1</option>
                    <option value="2" <?php echo $dataMaterial[0]['priority'] == 2 ? 'selected':''; ?> >2</option>
                    <option value="3" <?php echo $dataMaterial[0]['priority'] == 3 ? 'selected':''; ?> >3</option>
                </select>
                <div class="invalid-feedback">
                    Masukan Priority (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Finish Dossage Form -->
            <div class="mb-3">
                <label for="finishDossageForm" class="form-label" style="font-size:17px;font-family:poppinsBold">Finish Dossage Form</label>
                <input type="text" class="form-control form-control-sm" id="finishDossageForm" maxlength="80" name="finishDossageForm" required value="<?php echo !empty($dataMaterial[0]['finishDossageForm'])? $dataMaterial[0]['finishDossageForm']:''; ?>">
                <div class="invalid-feedback">
                    Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Document Requirement -->
            <div class="mb-3">
                <label for="documentReq" class="form-label" style="font-size:17px;font-family:poppinsBold">Document Requirement</label>
                <input type="text" class="form-control form-control-sm" id="documentReq" maxlength="100" name="documentReq" required value="<?php echo !empty($dataMaterial[0]['documentReq'])? $dataMaterial[0]['documentReq']:'';?>">
                <div class="invalid-feedback">
                        Masukan Document Requirement (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
    </div>
                    
    <hr class="m-0">

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Catalog Or CAS Number -->
            <div class="mb-3">
                <label for="catalogOrCasNumber" class="form-label" style="font-size:17px;font-family:poppinsBold">Catalog Or CAS Number</label>
                <input type="text" class="form-control form-control-sm" id="catalogOrCasNumber" maxlength="50" name="catalogOrCasNumber" required value="<?php echo !empty($dataMaterial[0]['catalogOrCasNumber'])? $dataMaterial[0]['catalogOrCasNumber']:'';?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test" || $dataMaterial[0]['materialCategory']=="Intermediate" ? '' :'disabled'; ?>>
                <div class="invalid-feedback">
                    Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Company< -->
            <div class="mb-3">
                <label for="company" class="form-label" style="font-size:17px;font-family:poppinsBold">Company</label>
                <input type="text" class="form-control form-control-sm" id="company" maxlength="80" name="company" required value="<?php echo !empty($dataMaterial[0]['company'])? $dataMaterial[0]['company']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                <div class="invalid-feedback">
                    Masukan Company Produk (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Website -->
            <div class="mb-3">
                <label for="website" class="form-label" style="font-size:17px;font-family:poppinsBold">Website</label>
                <input type="text" class="form-control form-control-sm" id="website" maxlength="80" name="website" required value="<?php echo !empty($dataMaterial[0]['website'])? $dataMaterial[0]['website']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                <div class="invalid-feedback">
                    Masukan Website Produk (*Tandai (-) jika tidak Diisi).
                </div>
            </div>
        </div>
    </div>

    <hr class="m-0">

    <!-- Vendor AERO -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="vendorAERO" class="form-label" style="font-size:17px;font-family:poppinsBold">Vendor Terdaftar AERO</label>
        <textarea class="form-control form-control-sm" id="vendorAERO" rows="3" name="vendorAERO" required><?php echo !empty($dataMaterial[0]['vendorAERO'])? $dataMaterial[0]['vendorAERO']:''; ?></textarea>
        <div class="invalid-feedback">
            Masukan Vandor Terdaftar AERO (*Tandai (-) jika tidak Diisi).
        </div>
    </div>
    <!-- Keterangan -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="keterangan" class="form-label" style="font-size:17px;font-family:poppinsBold">Keterangan</label>
        <textarea class="form-control form-control-sm" id="keterangan" rows="3" name="keterangan" required><?php echo !empty($dataMaterial[0]['keterangan'])? $dataMaterial[0]['keterangan']:''; ?></textarea>
        <div class="invalid-feedback">
            Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).
        </div>
    </div>
    <!-- Sumary Repory -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="keterangan" class="form-label" style="font-size:17px;font-family:poppinsBold">Sumary Report</label>
        <textarea class="form-control form-control-sm" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['sumaryReport'])? $dataMaterial[0]['sumaryReport']:''; ?></textarea>
    </div>

    <!-- Button Edit Material -->
    <button type="submit" class="btn btn-warning btn-sm" style="width:120px;margin-left:12px">
        Save
    </button>
</form>

<?php
    }
    // Jika bukan level 1
    if($_SESSION['user']['level'] != 1){
?>
    <!-- Title -->
    <div class="text-center mb-2" style="font-family:poppinsBlack;font-size:25px">Lembar Kerja Update Sourcing</div>

    <!-- Status Sourcing -->
    <div class="d-flex justify-content-end">
        <span class="badge text-dark" style="font-size:15px;font-family:poppinsBlack;width:120px;<?php echo ($dataMaterial[0]['statusSourcing'] == "DONE" ? "background-color:#9cff9d":($dataMaterial[0]['statusSourcing'] == "OPEN" ? "background-color:#7380fa":($dataMaterial[0]['statusSourcing'] == "RE-OPEN" ? "background-color:#a1ecff":($dataMaterial[0]['statusSourcing'] == "DROP" ? "background-color:#bd7aff":($dataMaterial[0]['statusSourcing'] == "NOT YET" ? "background-color:#ff6040":($dataMaterial[0]['statusSourcing'] == "HOLD" ? "background-color:#f72a34":($dataMaterial[0]['statusSourcing'] == "NO STATUS" ? "background-color:#a1a1a1":""))))))) ?>"><?php echo $dataMaterial[0]['statusSourcing']?></span>
    </div>
    <!-- Material Category -->
    <div class="row" style="font-size:15px;font-family:poppinsRegular">
    <div class="col m-0 mt-1">
            <div class="mb-3">
                <label for="materialCategory" class="form-label" style="font-size:17px;font-family:poppinsBold">Material Category</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['materialCategory'])? $dataMaterial[0]['materialCategory']:'';?>" disabled readonly>
            </div>
        </div>
    </div>

    <hr class="m-0">

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Material Name -->
            <div class="mb-3">
                <label for="materialName" class="form-label" style="font-size:17px;font-family:poppinsBold">Material Name</label>
                <textarea class="form-control form-control-sm" id="materialName" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['materialName'])? $dataMaterial[0]['materialName']:''; ?></textarea>
            </div>
        </div>
        <div class="col m-0 mt-1">   
            <!-- Material Spesification -->
        <div class="mb-3">
            <label for="materialSpesification" class="form-label" style="font-size:17px;font-family:poppinsBold">Material Spesification</label>
            <textarea class="form-control form-control-sm" id="materialSpesification" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['materialSpesification'])? $dataMaterial[0]['materialSpesification']:''; ?></textarea>
        </div>
    </div>
                    
    <hr class="m-0">

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Priority -->
            <div class="mb-3">
                <label for="priority" class="form-label" style="font-size:17px;font-family:poppinsBold">Priority</label>
                <input type="number" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['priority'])? $dataMaterial[0]['priority']:'';?>" disabled readonly>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Finish Dossage Form -->
            <div class="mb-3">
                <label for="finishDossageForm" class="form-label" style="font-size:17px;font-family:poppinsBold">Finish Dossage Form</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['finishDossageForm'])? $dataMaterial[0]['finishDossageForm']:''; ?>" disabled readonly>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Document Requirement -->
            <div class="mb-3">
                <label for="documentReq" class="form-label" style="font-size:17px;font-family:poppinsBold">Document Requirement</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['documentReq'])? $dataMaterial[0]['documentReq']:'';?>" disabled readonly>
            </div>
        </div>
    </div>
                    
    <hr class="m-0">

    <div class="row" style="font-size:15px;font-family:poppinsRegular">
        <div class="col m-0 mt-1">
            <!-- Catalog Or CAS Number -->
            <div class="mb-3">
                <label for="catalogOrCasNumber" class="form-label" style="font-size:17px;font-family:poppinsBold">Catalog Or CAS Number</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['catalogOrCasNumber'])? $dataMaterial[0]['catalogOrCasNumber']:'';?>" disabled readonly>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Company< -->
            <div class="mb-3">
                <label for="company" class="form-label" style="font-size:17px;font-family:poppinsBold">Company</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['company'])? $dataMaterial[0]['company']:''; ?>" disabled readonly>
            </div>
        </div>
        <div class="col m-0 mt-1">
            <!-- Website -->
            <div class="mb-3">
                <label for="website" class="form-label" style="font-size:17px;font-family:poppinsBold">Website</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo !empty($dataMaterial[0]['website'])? $dataMaterial[0]['website']:'-'; ?>" disabled readonly>
            </div>
        </div>
    </div>

    <hr class="m-0">

    <!-- Vendor AERO -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="vendorAERO" class="form-label" style="font-size:17px;font-family:poppinsBold">Vendor Terdaftar AERO</label>
        <textarea class="form-control form-control-sm" id="vendorAERO" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['vendorAERO'])? $dataMaterial[0]['vendorAERO']:''; ?></textarea>
    </div>
    <!-- Keterangan -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="keterangan" class="form-label" style="font-size:17px;font-family:poppinsBold">Keterangan</label>
        <textarea class="form-control form-control-sm" id="keterangan" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['keterangan'])? $dataMaterial[0]['keterangan']:''; ?></textarea>
    </div>

    <!-- Sumary Report -->
    <div class="mb-3" style="font-size:15px;font-family:poppinsRegular">
        <label for="keterangan" class="form-label" style="font-size:17px;font-family:poppinsBold">Sumary Report</label>
        <textarea class="form-control form-control-sm" id="sumaryReport" rows="3" disabled readonly><?php echo !empty($dataMaterial[0]['sumaryReport'])? $dataMaterial[0]['sumaryReport']:''; ?></textarea>
    </div>
<?php
    }
?>
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

        // Listening event submit
        document.getElementById("formEditMaterial<?php echo $dataMaterial[0]['id'] ?>").addEventListener('submit', event => {
            event.preventDefault();
            // actual logic, e.g. validate the form
            funcUpdateMaterialViewSourcing()
        });   
    })

    // Send data to Action Update Material for Update Material
    function funcUpdateMaterialViewSourcing(){
        $.ajax({
            type: "POST",
            url: "../controller/actionUpdateMaterial.php",
            data: $('form#formEditMaterial<?php echo $dataMaterial[0]['id'] ?>').serialize()+'&editMaterial=true&idMaterial=<?php echo $_GET['idMaterial']?>',
            dataType: 'json',
            success: function(response){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                loadDataMaterial(<?php echo $_GET['idMaterial']?>)
            }
        })
    }
</script>