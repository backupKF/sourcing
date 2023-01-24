<?php
    session_start();

    // Jika tidak ada data GET maka akan me-redirect ke halaman index
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <table id="table-riwayat" class="table">
            <thead>
                <tr>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:10px" class="text-center">No</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:150px" class="text-center">Sourcing Number</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:150px" class="text-center">Material Name</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Date Sourcing</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Project Code</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:120px" class="text-center">Project Name</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Team Leader</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Researcher</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Feedback TL</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Feedback RPIC</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:120px" class="text-center">Date Approved TL</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:125px" class="text-center">Date Accepted RPIC</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Status</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:180px" class="text-center">Action Material</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../../dbConfig.php";
                    if(!empty($_GET["sn"]) && empty($_GET["idMaterial"])){
                        // Jika terdapat data GET Sourcing Number
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode WHERE sourcingNumber=".$_GET['sn']." ORDER BY id DESC")->fetchAll();
                    }else if(!empty($_GET["sn"]) && !empty($_GET["idMaterial"])){
                        // Jika terdapat data GET Sourcing Number dan Id Material
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode WHERE sourcingNumber=".$_GET['sn']." AND id=".$_GET['idMaterial']." ORDER BY id DESC")->fetchAll();
                    }else{
                        // Jika selain dari kondisi di atas
                        $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode ORDER BY id DESC")->fetchAll();
                    }
                    $no=1;
                    foreach($dataRiwayat as $row){
                ?>
                     <tr>
                        <!-- Column Number -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $no++?></td>

                        <!-- Column Sourcing Number -->
                        <td style="font-size:12px;font-family:poppinsRegular;" class="text-center"><?php echo $row['sourcingNumber']?></td>

                        <!-- Column Material Name -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['materialName']?></td>

                        <!-- Column Date Sourcing -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['dateSourcing']?></td>

                        <!-- Column Project Code -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['projectCode']?></td>

                        <!-- Column Project Name -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['projectName']?></td>

                        <!-- Column Team Leader -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['teamLeader']?></td>

                        <!-- Column Researcher -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['researcher']?></td> 

                        <!-- Column feedback tl -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                        <?php
                            // Jika user level == 2 dan feedback tl == false/0
                            if($_GET['userLevel'] == 2 && $row['feedbackTL'] == 0){
                        ?>
                            <!-- Menampilkan action feedback tl -->
                            <form onclick="funcFeedbackTL(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formFeedbackTL_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackTL">
                                    <option selected>NO STATUS</option>
                                    <option value=1>APPROVED</option>
                                </select>
                            </form>
                        <?php
                            // Jika user level selain == 2 dan feedback tl == false/0
                            }else if($_GET['userLevel'] != 2 && $row['feedbackTL'] == 0){
                        ?>
                            <div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>
                        <?php
                            //Jika Selain kondisi diatas 
                            }else{
                        ?>
                            <div class="text-center bg-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">APPROVED</div>
                        <?php
                            }
                        ?>
                        </td>

                        <!-- Column feedback RPIC -->
                        <td style="font-size:12px;">
                        <?php
                            // Jika user level == 1 dan feedback rpic == false/0 dan feedbackTL == 1
                            if($_GET['userLevel'] == 1 && $row['feedbackRPIC'] == 0 && $row['feedbackTL'] == 1){
                        ?>
                            <!-- Menampilkan action feedback rpic -->
                            <form onclick="funcFeedbackRPIC(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formFeedbackRPIC_<?php echo $row['id']?>">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackRPIC">
                                        <option selected>NO STATUS</option>
                                        <option value=1>ACCEPTED</option>
                                    </select>
                            </form>
                        <?php
                            // Jika user level == 1 dan feedback rpic == false/0 dan feedbackTL == 0
                            }else if($_GET['userLevel'] == 1 && $row['feedbackRPIC'] == 0 && $row['feedbackTL'] == 0){
                        ?>
                            <div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>
                        <?php
                            // Jika user level selain == 2 dan feedback rpic == false/0
                            }else if($_GET['userLevel'] != 1 && $row['feedbackRPIC'] == 0){
                        ?>
                            <div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>
                        <?php
                            //Jika Selain kondisi diatas
                            }else{
                        ?>
                            <div class="text-center bg-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">ACCEPTED</div>
                        <?php
                            }
                        ?>
                        </td>

                        <!-- Column Date Approved TL -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['dateApprovedTL']?></td>

                        <!-- Column Date Aceppted RPIC -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['dateAcceptedRPIC']?></td>
                        
                        <!-- Column Status -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                            <?php
                                // Jika user level == 1
                                if($_GET['userLevel'] == 1){
                            ?>
                                <!-- Action Status -->
                                <form onclick="funcStatusRiwayat(<?php echo $row['id']?>, '<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)" id="formStatusRiwayat_<?php echo $row['id']?>">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="statusRiwayat">
                                        <option <?php echo ($row['statusRiwayat']=="NO STATUS")?'selected':'';?>>NO STATUS</option>
                                        <option <?php echo ($row['statusRiwayat']=="ON PROCESS")?'selected':'';?> value="ON PROCESS">ON PROCESS</option>
                                        <option <?php echo ($row['statusRiwayat']=="HOLD")?'selected':'';?> value="HOLD">HOLD</option>
                                        <option <?php echo ($row['statusRiwayat']=="CANCEL")?'selected':'';?> value="CANCEL">CANCEL</option>
                                    </select>
                                </form>
                            <?php
                                // Jika selain dari kondisi diatas
                                }else{
                            ?>
                                <div class="text-center text-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px"><?php echo $row['statusRiwayat']?></div>
                            <?php
                                }
                            ?>
                        </td>

                        <!--Column Action Material -->
                        <td>
                            <!-- Button -->
                            <div class="text-center">
                                <!-- Jika Feedback Tl == 1/true -->
                                <?php if($row['feedbackTL'] != 1){ ?>
                                    <!-- Button Edit Material -->
                                    <button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial<?php echo $row['id']?>" data-bs-toggle="modal">Edit</button>
                                <?php } ?>
                                <!-- Button View Material -->
                                <button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial<?php echo $row['id']?>" data-bs-toggle="modal">View</button>
                                <!-- Jika user level == 1 -->
                                <?php 
                                    if($_GET['userLevel'] == 1){ ?>  
                                    <!-- Button Delete -->
                                    <button class="btn btn-danger btn-sm d-inline ms-1" type="button" onclick="funcDeleteMaterial(<?php echo $row['id']?>,'<?php echo $row['materialName']?>', <?php echo $row['sourcingNumber']?>)">Delete</a>
                                <?php } ?>
                            </div>

                            <!-- Modal Update Material -->
                            <?php 
                                if($row['feedbackTL'] != 1){ 
                                    include "../../component/modal/updateMaterialRiwayat.php";
                                }
                            ?>
                            <!-- Modal View Material -->
                            <?php include "../../component/modal/viewMaterial.php";?>

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
        // Datatable tabel riwayat
        var tableRiwayat = $('#table-riwayat').DataTable({
            scrollX: true,
            stateSave: true,
            lengthMenu: [5 , 10, 15],
        })

        // CSS Table
        $('.dataTables_filter input[type="search"]').css(
            {
                'height':'25px',
                'font-family':'poppinsRegular',
                'display':'inline-block'
            }
        );
        $('.dataTables_filter label').css(
            {
                'font-size':'15px',
                'font-family':'poppinsSemiBold',
                'display':'inline-block'
            }
        );
        $('.dataTables_length').css(
            {
                'font-size':'15px',
                'font-family':'poppinsSemiBold',
            }
        );
        $('.dataTables_length select').css(
            {
                'height':'25px',
                'font-family':'poppinsRegular',
                'padding':'0'
            }
        );
        $('.dataTables_info').css(
            {
                'font-size':'13px',
                'font-family': 'poppinsSemiBold'
            }
        );
        $('.dataTables_paginate').css(
            {
                'font-size':'13px',
                'font-family': 'poppinsSemiBold'
            }
        );
    });

    // Send data to Action Update Material for feedback tl
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

    // Send data to Action Update Material for feedback rpic
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

                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
            }
        })
    }

    // Send data to Action Update Material for status riwayat
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

                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
            }
        })
    }

    // Send data to Action Update Material for delete material
    function funcDeleteMaterial(idMaterial, materialName){
        Swal.fire({
            title: 'Apakah anda yakin untuk menghapus material ini?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
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
                        loadDataRiwayat(<?php echo $_SESSION['user']['level']?>)
                    }
                })
            }
        })
    }

    // Send data to Action Update Material for update material
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
                    
                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>)
            }
        })
        $('#editMaterial'+idMaterial).modal('hide');
    }
</script>