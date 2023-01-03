<?php
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>

<div class="card" style="width:1050px">
    <div class="card-body">
        <table class="table p-1" id="table-riwayat">
            <thead>
                <tr>
                    <th scope="col" style="font-size: 13px;width:10px" class="text-center">No</th>
                    <th scope="col" style="font-size: 13px;width:150px" class="text-center">Sourcing Number</th>
                    <th scope="col" style="font-size: 13px;width:150px" class="text-center">Material Name</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Date Sourcing</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Project Code</th>
                    <th scope="col" style="font-size: 13px;width:120px" class="text-center">Project Name</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Team Leader</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Researcher</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Feedback TL</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Feedback RPIC</th>
                    <th scope="col" style="font-size: 13px;width:120px" class="text-center">Date Approved TL</th>
                    <th scope="col" style="font-size: 13px;width:125px" class="text-center">Date Accepted RPIC</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Status</th>
                    <th scope="col" style="font-size: 13px;width:180px" class="text-center">Edit Material</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../../dbConfig.php";
                    $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode ORDER BY id DESC")->fetchAll();
                    $no=1;
                    foreach($dataRiwayat as $row){
                ?>
                    <tr>
                        <td style="font-size: 12px;"><?php echo $no++?></td>
                        <td style="font-size: 12px;" class="text-center"><?php echo $row['sourcingNumber']?></td>
                        <td style="font-size: 12px;"><?php echo $row['materialName']?></td>
                        <td style="font-size: 12px;"><?php echo $row['dateSourcing']?></td>
                        <td style="font-size: 12px;"><?php echo $row['projectCode']?></td>
                        <td style="font-size: 12px;"><?php echo $row['projectName']?></td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">
                            <form onclick="funcFeedbackTL(<?php echo $row['id']?>, '<?php echo $row['materialName']?>')" id="formFeedbackTL_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackTL">
                                    <option <?php echo $row['feedbackTL']==0?'selected':'';?> value=0>No Action</option>
                                    <option <?php echo $row['feedbackTL']==1?'selected':'';?> value=1>Approved</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size: 12px;">
                            <form onclick="funcFeedbackRPIC(<?php echo $row['id']?>, '<?php echo $row['materialName']?>')" id="formFeedbackRPIC_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackRPIC">
                                    <option <?php echo $row['feedbackRPIC']==0?'selected':'';?> value=0>No Action</option>
                                    <option <?php echo $row['feedbackRPIC']==1?'selected':'';?> value=1>Accepted</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size: 12px;"><?php echo $row['dateApprovedTL']?></td>
                        <td style="font-size: 12px;"><?php echo $row['dateAcceptedRPIC']?></td>
                        <td style="font-size: 12px;">
                            <form onclick="funcStatusRiwayat(<?php echo $row['id']?>, '<?php echo $row['materialName']?>')" id="formStatusRiwayat_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="statusRiwayat">
                                    <option <?php echo $row['statusRiwayat']==""?'selected':'';?> value=0>No Action</option>
                                    <option <?php echo $row['statusRiwayat']=="ON PROCESS"?'selected':'';?> value="ON PROCESS">ON PROCESS</option>
                                    <option <?php echo $row['statusRiwayat']=="HOLD"?'selected':'';?> value="HOLD">HOLD</option>
                                    <option <?php echo $row['statusRiwayat']=="CANCEL"?'selected':'';?> value="CANCEL">CANCEL</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <!-- Button -->
                            <div class="text-center">
                                <!-- Button Edit Material -->
                                <button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial<?php echo $row['id']?>" data-bs-toggle="modal">Edit</button>
                                <!-- Button View Material -->
                                <button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial<?php echo $row['id']?>" data-bs-toggle="modal">View</button>
                                <!-- Button Delete -->
                                <button class="btn btn-danger btn-sm d-inline ms-1" type="button" onclick="funcDeleteMaterial(<?php echo $row['id']?>,'<?php echo $row['materialName']?>')">Delete</a>
                            </div>
                            <!-- Modal Update Material -->
                            <?php include "../../component/modal/updateMaterialRiwayat.php"?>
                            <!-- Modal View Material -->
                            <?php include "../../component/modal/viewMaterial.php"?>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var tableRiwayat = $('#table-riwayat').DataTable({
            scrollX: true,
            stateSave: true,
        })
    });
    $('.dataTables_scrollBody tbody').css(
        {'height':'20px'}
    );

    function funcFeedbackTL(idMaterial, materialName){
        let feedbackTL = $('form#formFeedbackTL_'+idMaterial+' select#feedbackTL').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackTL: feedbackTL, materialName: materialName},
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

                loadDataRiwayat();
            }
        })
    }

    function funcFeedbackRPIC(idMaterial, materialName){
        let feedbackRPIC = $('form#formFeedbackRPIC_'+idMaterial+' select#feedbackRPIC').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackRPIC: feedbackRPIC, materialName: materialName},
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

                loadDataRiwayat();
            }
        })
    }

    function funcStatusRiwayat(idMaterial, materialName){
        let statusRiwayat = $('form#formStatusRiwayat_'+idMaterial+' select#statusRiwayat').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, statusRiwayat: statusRiwayat, materialName: materialName},
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

                loadDataRiwayat();
            }
        })
    }

    function funcDeleteMaterial(idMaterial, materialName){
        $.ajax({
            type: 'GET',
            url: '../controller/actionUpdateMaterial.php',
            data:{ idMaterial: idMaterial, actionType: "delete", materialName: materialName },
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
                loadDataRiwayat()
            }
        })
    }

    function funcUpdateMaterial(idMaterial){
        $.ajax({
            type: "POST",
            url: "../controller/actionUpdateMaterial.php",
            data: $('form#formEditMaterial'+idMaterial).serialize()+'&editMaterial=true&idMaterial='+idMaterial,
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
                    
                loadDataRiwayat()
            }
        })
        $('#editMaterial'+idMaterial).modal('hide');
    }
</script>