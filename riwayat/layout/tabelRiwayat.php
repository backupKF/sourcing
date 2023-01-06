<?php
    if(empty($_GET)){
        header('Location: ../index.php');
    }

    echo $_GET['userLevel']
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
                    if(!empty($_GET["sn"]) && empty($_GET["idMaterial"]) && isset($_SESSION['user'])){
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode WHERE sourcingNumber=".$_GET['sn']." ORDER BY id DESC")->fetchAll();
                    }else if(!empty($_GET["sn"]) && !empty($_GET["idMaterial"]) && isset($_SESSION['user'])){
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode WHERE sourcingNumber=".$_GET['sn']." AND id=".$_GET['idMaterial']." ORDER BY id DESC")->fetchAll();
                    }else{
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode ORDER BY id DESC")->fetchAll();
                    }
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
                        <?php
                            if(2 == 2){
                        ?>
                            <form onclick="funcFeedbackTL(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formFeedbackTL_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackTL">
                                    <option selected>NO STATUS</option>
                                    <option value=1>APPROVED</option>
                                </select>
                            </form>
                        <?php
                            }else
                        ?>
                        </td>
                  
                        <td style="font-size: 12px;">
                        <?php
                            if(1 == 1){
                        ?>
                            <form onclick="funcFeedbackRPIC(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formFeedbackRPIC_<?php echo $row['id']?>">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackRPIC">
                                        <option selected>NO STATUS</option>
                                        <option value=1>ACCEPTED</option>
                                    </select>
                            </form>
                        <?php
                            }
                        ?>
                        </td>

                        <td style="font-size: 12px;"><?php echo $row['dateApprovedTL']?></td>
                        <td style="font-size: 12px;"><?php echo $row['dateAcceptedRPIC']?></td>
                        
                        <td style="font-size: 12px;">
                            <?php
                                if($_GET['userLevel'] == 1){
                            ?>
                                <form onclick="funcStatusRiwayat(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formStatusRiwayat_<?php echo $row['id']?>">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="statusRiwayat">
                                        <option <?php echo ($row['statusRiwayat']=="NO STATUS")?'selected':'';?>>NO STATUS</option>
                                        <option <?php echo ($row['statusRiwayat']=="ON PROCESS")?'selected':'';?> value="ON PROCESS">ON PROCESS</option>
                                        <option <?php echo ($row['statusRiwayat']=="HOLD")?'selected':'';?> value="HOLD">HOLD</option>
                                        <option <?php echo ($row['statusRiwayat']=="CANCEL")?'selected':'';?> value="CANCEL">CANCEL</option>
                                    </select>
                                </form>
                            <?php
                                }else{
                            ?>
                                <div class="text-center" style="font-size: 12px;"><?php echo $row['statusRiwayat']?></div>
                            <?php
                                }
                            ?>
                        </td>
                        
                        <td>
                            <!-- Button -->
                            <div class="text-center">
                                <?php 
                                    if($row['feedbackTL'] != 1){ 
                                        echo $row['feedbackTL']?>
                                    <!-- Button Edit Material -->
                                    <button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial<?php echo $row['id']?>" data-bs-toggle="modal">Edit</button>
                                <?php } ?>
                                <!-- Button View Material -->
                                <button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial<?php echo $row['id']?>" data-bs-toggle="modal">View</button>
                                <?php if($_SESSION['user']['level'] == 1){ ?>  
                                    <!-- Button Delete -->
                                    <button class="btn btn-danger btn-sm d-inline ms-1" type="button" onclick="funcDeleteMaterial(<?php echo $row['id']?>,'<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)">Delete</a>
                                <?php } ?>
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

    function funcFeedbackTL(idMaterial, materialName, sourcingNumber){
        let feedbackTL = $('form#formFeedbackTL_'+idMaterial+' select#feedbackTL').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackTL: feedbackTL, materialName: materialName, sourcingNumber: sourcingNumber},
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

                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
            }
        })
    }

    function funcFeedbackRPIC(idMaterial, materialName, sourcingNumber){
        let feedbackRPIC = $('form#formFeedbackRPIC_'+idMaterial+' select#feedbackRPIC').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackRPIC: feedbackRPIC, materialName: materialName, sourcingNumber: sourcingNumber},
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

    function funcStatusRiwayat(idMaterial, materialName, sourcingNumber){
        let statusRiwayat = $('form#formStatusRiwayat_'+idMaterial+' select#statusRiwayat').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, statusRiwayat: statusRiwayat, materialName: materialName, sourcingNumber: sourcingNumber},
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

    function funcUpdateMaterial(idMaterial, sourcingNumber){
        $.ajax({
            type: "POST",
            url: "../controller/actionUpdateMaterial.php",
            data: $('form#formEditMaterial'+idMaterial).serialize()+'&editMaterial=true&idMaterial='+idMaterial+'&sourcingNumber='+sourcingNumber,
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