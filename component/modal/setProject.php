<?php
    session_start();

    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Select Project -->
<div class="modal" id="project" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Pilih Project</h5>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Select Project -->
                <table class="table table-bordered p-2" id="tabel-info" style="width:100%">
                    <thead>
                        <tr class="d-none">
                            <td>Project Code</td>
                            <td>Project Name</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $dataProject = $conn->query("SELECT * FROM TB_Project")->fetchAll();
                        foreach($dataProject as $project) { 
                    ?>
                        <form action="../controller/actionPengajuan.php" method="POST" id="formSetProject<?php echo $project['projectCode']?>">
                            <tr>
                                <td class="py-0" style="width:150px">
                                    <input type="text" name="project" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $project['projectCode']?>">
                                </td>
                                <td class="py-0" style="width:250px">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $project['projectName']?>"> 
                                </td>
                                <td class="text-center p-0 py-1" style="width:75px">
                                    <input type="submit" form="formSetProject<?php echo $project['projectCode']?>" value="pilih" class="btn btn-primary btn-sm" name="setProject">
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Select Project -->
<script>
    // $(document).ready(function(){
    //     $('#tabel-info').DataTable({
    //         paging: false,
    //         ordering: false,
    //         info: false,
    //     })
    // })
</script>