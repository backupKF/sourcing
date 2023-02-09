<?php
    session_start();
    
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
        font-size:13px;
        font-family:'poppinsMedium';
    }
</style>

<!-- Modal Select Project -->
<div class="modal" id="project" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Pilih Project</div>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Select Project -->
                <table class="table" id="tabel-info" style="width:100%">
                    <thead style="background-color:#00b0aa">
                        <tr>
                            <td class="column-project-head">Project Code</td>
                            <td class="column-project-head">Project Name</td>
                            <td class="column-project-head"></td>
                        </tr>
                    </thead>
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
    $(document).ready(function(){
        $('#tabel-info').DataTable({
            lengthChange:false,
            pageLength:5,
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataSetProject.php',
            },
            columns: [
                {
                    className: "column-project-value",
                    data: "projectCode"
                },
                {
                    className: "column-project-value",
                    data: "projectName"
                },
                {
                    className: "column-project-value",
                    data: function(data){
                        return (
                            '<form action="../controller/actionPengajuan.php" method="POST">'+
                                '<button class="btn btn-success btn-sm p-0 px-1" style="height:22px" type="submit" name="setProject" value="'+data.projectCode+'">'+
                                    '<span style="font-size:11px;font-family:poppinsBold">Pilih</span>'+
                                '</button>'+
                            '</form>'
                        )
                    }
                }
            ]
        })
    })
</script>