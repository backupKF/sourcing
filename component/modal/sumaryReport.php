<?php
  if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header('Location: ../../dashboard/index.php');
    exit();
  };
?>


<!-- Modal UpdateSupplier-->
<div class="modal" id="sumaryReport<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Sumary Report</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="p-1 was-validated" id="formSumaryReport<?php echo $row['id']?>">
                    <input type="hidden" name="idMaterial" value="<?php echo $row['id']?>">
                    <!-- Sumary Report  -->
                    <div class="mb-1">
                        <label for="sumaryReport" class="form-label fw-bold" style="margin-button:2px">Sumary Report</label>
                        <textarea class="form-control form-control-sm" id="sumaryReport" rows="3" name="sumaryReport" required><?php echo $row['sumaryReport']?></textarea>
                        <div class="invalid-feedback">
                            Masukan Sumary Report (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning btn-sm m-0" onclick="funcUpdateSumaryReport(<?php echo $row['id']?>,'<?php echo $row['materialName']?>')">Submit</button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>