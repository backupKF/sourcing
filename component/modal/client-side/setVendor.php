<?php
    session_start();

    include "../../dbConfig.php";

    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>

<!-- CSS Table -->
<style>
    .column-project-value{
        font-size:12px;
        font-family:'poppinsMedium';
    }
    .column-project-head{
        font-size:14px;
        font-family:'poppinsMedium';
    }
</style>

<!-- Modal Select Vendor -->
<div class="modal" id="<?php echo !empty($row['supplier']) && !empty($_GET['idMaterial'])?'modalSetVendorUpdateSupplier'.$row['id']:'modalSetVendorAddSupplier'.$_GET['idMaterial']?>">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Select Vendor</div>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Select Project -->
                <table class="table" id="<?php echo !empty($row['supplier']) && !empty($_GET['idMaterial'])?'tabel-vendorUpdateSupplier'.$row['id']:'tabel-vendorAddSupplier'.$_GET['idMaterial']?>" style="width:100%">
                    <thead style="background-color:#00b0aa">
                        <tr>
                            <td class="column-project-head">Vendor Name</td>
                            <td class="column-project-head"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-0 column-project-value" style="width:250px">
                                <div class="d-flex align-items-center"style="height:30px">
                                    <form id="<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])?'formSetNewVendorUpdateSupplier'.$row['id']:'formSetNewVendorAddSupplier'.$_GET['idMaterial']?>" autocomplete="off">
                                        <input class="form-control form-control-sm" type="text" placeholder="Isi Vendor Baru" name="setNewVendor" style="height:5px">
                                    </form>
                                </div>
                            </td>
                            <td class="py-0 text-center" style="width:75px">
                                <button type="submit" class="btn btn-success btn-sm p-0 px-1" style="height:22px" form="<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])?'formSetNewVendorUpdateSupplier'.$row['id']:'formSetNewVendorAddSupplier'.$_GET['idMaterial']?>">
                                    <span style="font-size:11px;font-family:poppinsBold">Pilih</span>
                                </button>
                            </td>
                        </tr>
                    <?php
                        // Mengambil data project
                        $dataVendor = $conn->query("SELECT * FROM TB_MasterVendor")->fetchAll();
                        foreach($dataVendor as $vendor) { 
                    ?>
                        <tr>
                            <!-- Column Project Name -->
                            <td class="py-0 column-project-value" style="width:250px">
                                <div class="d-flex align-items-center"style="height:30px">
                                    <?php echo $vendor['vendorName']?>
                                </div>
                            </td>
                            <!-- Action Button -->
                            <td class="py-0 text-center" style="width:75px">
                                <form id="<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? 'formSetVendorUpdateSupplier'.$vendor['id']:'formSetVendorAddSupplier'.$_GET['idMaterial']?>">
                                    <button type="button" class="btn btn-success btn-sm p-0 px-1" style="height:22px" name="setValue" value="<?php echo $vendor['vendorName']?>" onclick="funcSetVendor(<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? $row['id']:$_GET['idMaterial']?>,'<?php echo $vendor['vendorName']?>','<?php echo !empty($row['supplier']) && !empty($_GET['idMaterial'])?'formSetVendorUpdateSupplier':'formSetVendorAddSupplier'?>')">
                                        <span style="font-size:11px;font-family:poppinsBold">Pilih</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? '#editSupplier'.$row['id']:'#tambahSupplier'.$_GET['idMaterial']?>">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Select Project -->
<script>
    $(document).ready(function(){
        $('<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? '#tabel-vendorUpdateSupplier'.$row['id']:'#tabel-vendorAddSupplier'.$_GET['idMaterial']?>').DataTable({
            lengthChange:false,
            pageLength:5,
        })
    })

    // Listen Event Submit
    document.getElementById("<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])?'formSetNewVendorUpdateSupplier'.$row['id']:'formSetNewVendorAddSupplier'.$_GET['idMaterial']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcSetNewVendor(<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? $row['id']:$_GET['idMaterial']?>, '<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])?'formSetNewVendorUpdateSupplier':'formSetNewVendorAddSupplier'?>')
    });
</script>