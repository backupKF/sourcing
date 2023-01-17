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
<div class="modal" id="vendor<?php echo $_GET['idMaterial']?>">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Select Vendor</div>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Select Project -->
                <table class="table" id="tabel-vendor" style="width:100%">
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
                                <form method="POST" id="setNewVendor<?php echo $_GET['idMaterial']?>">
                                    <input class="form-control form-control-sm" type="text" placeholder="Isi Vendor Baru" name="setVendor" style="height:5px">
                                </form>
                                </div>
                            </td>
                            <td class="py-0 text-center" style="width:75px">
                                <button class="btn btn-success btn-sm p-0 px-1" style="height:22px" type="submit" name="setProject" form="setNewVendor<?php echo $_GET['idMaterial']?>">
                                    <span style="font-size:11px;font-family:poppinsBold">Pilih</span>
                                </button>
                            </td>
                        </tr>
                    <?php
                        // Mengambil data project
                        $dataProject = $conn->query("SELECT * FROM TB_Project")->fetchAll();
                        foreach($dataProject as $project) { 
                    ?>
                        <tr>
                            <!-- Column Project Name -->
                            <td class="py-0 column-project-value" style="width:250px">
                                <div class="d-flex align-items-center"style="height:30px">
                                    <?php echo $project['projectName']?>
                                </div>
                            </td>
                            <!-- Action Button -->
                            <td class="py-0 text-center" style="width:75px">
                                <form method="POST">
                                    <button class="btn btn-success btn-sm p-0 px-1" style="height:22px" type="submit" name="setProject" value=<?php echo $project['projectCode']?>>
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
                <button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Select Project -->
<script>
    $(document).ready(function(){
        $('#tabel-vendor').DataTable({
            lengthChange:false,
            pageLength:5,
        })
    })
</script>