<?php
    session_start();

    // Kondisi dimana apabila tidak ada data get maka akan meredirect ke halaman index.php
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>

<!-- Tabel Material -->
    <table id="table-material<?php echo $_GET['projectCode']?>" class="table table-striped">
        <thead class="bg-primary" >
            <tr>
                <th style="width:10px"></th>
                <th class="d-none"></th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:10px" class="text-center">No</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:50px" class="text-center">Material Category</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:150px" class="text-center">Material Name</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:20px" class="text-center">Priority</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:20px" class="text-center">Target Launching</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:270px" class="text-center">Spesification</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:100px" class="text-center">Catalog Or CAS Number</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">Company</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">Website</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:100px" class="text-center">Finish Dossage Form</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">Keterangan</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:100px" class="text-center">PIC</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">Vendor Terdaftar AERO</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">Document Requirement</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:100px" class="text-center">Status</th>
                <th scope="col" style="font-size:13px;font-family:poppinsSemiBold;width:260px" class="text-center">Summary Report</th>
                <?php if($_SESSION['user']['level'] == 1){?>
                    <th scope="col" style="font-size: 13px;font-family:poppinsSemiBold;width:100px" class="text-center">Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php
            include "../../dbConfig.php";
            ${'no'. $_GET['projectCode']} = 1;
            // Mengambil data material
            $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE projectCode='{$_GET['projectCode']}' AND feedbackRPIC=1 ORDER BY id DESC")->fetchAll();
            foreach($dataMaterial as $row){
        ?>
            <tr>
                <td class="dt-control"></td>
                <td class="d-none"><?php echo $row['id']?></td>
                <td style="font-size:12px;font-family:poppinsRegular;"><?php echo ${'no'. $_GET['projectCode']}++ ?></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['materialCategory']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['materialName']?></div></td>
                <td><div class="text-center" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['priority']?></div></td>
                <td><div class="text-center" style="font-size:12px;font-family:poppinsRegular;">-</div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['materialSpesification']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['catalogOrCasNumber']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['company']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['website']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['finishDossageForm']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['keterangan']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['teamLeader']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['vendor']?></div></td>
                <td><div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo $row['documentReq']?></div></td>
                <!-- Column Status -->
                <td>
                    <?php 
                        // Jika user level 1
                        if($_SESSION['user']['level'] == 1){
                    ?>
                        <form id="formSetStatusSourcing_<?php echo $row['id']?>">
                        <input type="hidden" value="<?php echo $row['id']?>" name="idMaterial">
                            <select class="form-select form-select-sm" style="height:25px;font-size:12px;font-family:poppinsRegular;" aria-label=".form-select-sm example" onchange="funcUpdateStatusSourcing(<?php echo $row['id']?>,'<?php echo $row['materialName']?>')" id="statusSourcing">
                                <option <?php echo ($row['statusSourcing']=="NO STATUS")?'selected':'';?> value="">NO STATUS</option>
                                <option <?php echo ($row['statusSourcing']=="OPEN")?'selected':'';?> value="OPEN">OPEN</option>
                                <option <?php echo ($row['statusSourcing']=="RE-OPEN")?'selected':'';?> value="RE-OPEN">RE-OPEN</option>
                                <option <?php echo ($row['statusSourcing']=="DONE")?'selected':'';?> value="DONE">DONE</option>
                                <option <?php echo ($row['statusSourcing']=="DROP")?'selected':'';?> value="DROP">DROP</option>
                                <option <?php echo ($row['statusSourcing']=="NOT YET")?'selected':'';?> value="NOT YET">NOT YET</option>
                                <option <?php echo ($row['statusSourcing']=="HOLD")?'selected':'';?> value="HOLD">HOLD</option>
                            </select>
                        </form>
                    <?php
                        // Jika user bukan level 1
                        }else{
                    ?>
                        <div class="text-center bg-success bg-opacity-75 m-0" style="font-size:12px;font-family:poppinsBold;"><?php echo $row['statusSourcing']?></div>
                    <?php 
                        }
                    ?>
                </td>
                <!-- Column Summary Report -->
                <td>
                    <!-- Tanggal Sumary Report-->
                    <div class="ps-0" style="width:100px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $row['dateSumaryReport']?></div>
                    <!-- Isi Sumary Report -->
                    <div class="overflow-auto" style="height:65px">
                        <div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;"><?php echo !empty($row['sumaryReport'])? $row['sumaryReport']:'-'; ?></div>
                    </div>

                    <!-- Action Final Feedback Rnd -->
                    <?php 
                        // Jika user level 1
                        if($_SESSION['user']['level'] == 1){
                    ?>
                        <div>
                            <button type="button" class="btn btn-sm btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#sumaryReport<?php echo $row['id']?>">
                                <div style="font-size:12px">Sumary Report</div>
                            </button>
                            <?php include "../../component/modal/sumaryReport.php"?>
                        </div>
                    <?php 
                        }
                    ?>

                </td>
                <?php
                    // Jika User Level 1 
                    if($_SESSION['user']['level'] == 1){
                ?>
                    <!-- Column Action Material -->
                    <td>
                        <!-- Edit Material -->
                        <button type="button" class="btn btn-sm btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editMaterial<?php echo $row['id']?>">
                            <div style="font-size:13px">Edit Material</div>
                        </button>
                        <?php include "../../component/modal/updateMaterialList.php"?>
                    </td>
                <?php 
                    } 
                ?>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            var materialTable = $('#table-material<?php echo $_GET['projectCode']?>').DataTable({
                scrollX: true,
                lengthMenu: [3 , 5],
                stateSave: true,
            })

            // Menampilkan tabel material, apabila user melakukan event click ditabel project
            $('#table-material<?php echo $_GET['projectCode']?> tbody').on('click', 'td.dt-control', function () {
                    var tr = $(this).closest('tr');
                    // Membuat variabel untuk mengambil data project dibaris yang mengalami event click
                    var row = materialTable.row(tr);
                    if (row.child.isShown()) {
                        // Menghilangkan tabel material jika event click ditutup
                        var table = $("#table-supplier"+row.data()[1], row.child());
                        table.DataTable().clear().destroy();
                        
                        // Fungsi untuk menyembunyikan baris
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Menampilkan tabel material jika event click dilakukan
                        row.child( tableSupplier(row.data()[1], row.data()[4])).show();
                        tr.addClass('shown');
                    }
            });

            // CSS Tabel
            $('.dataTables_filter input[type="search"]').css(
                {
                    'height':'25px',
                    'font-family':'poppinsRegular',
                    'display':'inline-block',
                    'margin-button':'2px',
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
            $('.dataTables_scroll').css(
                {
                    'margin-button':'2px',
                }
            );
        })

        // Membuat Tabel Supplier didalam sebuah fungsi
        function tableSupplier(d, materialName){
            loadDataSupplier(d, materialName)
            return (
                '<div class="container-fluid m-0 p-0" style="background-color:#fffedb" id="contentDataSupplier'+d+'"></div>'
            )
        }

        // Load Data Supplier
        function loadDataSupplier(d, materialName){
            $.ajax({
                url: 'layout/tabelSupplier.php',
                type: 'get',
                data: { idMaterial: d, materialName: materialName},
                success: function(data) {
                    $('#contentDataSupplier'+d+'').html(data);
                }
            });
        }

        // Send data to Action Update Material for update status sourcing
        function funcUpdateStatusSourcing(idMaterial, materialName){
            let statusSourcing = $('form#formSetStatusSourcing_'+idMaterial+' select#statusSourcing').val();
            $.ajax({
                url: '../controller/actionUpdateMaterial.php',
                type: 'POST',
                data: {
                    "idMaterial": idMaterial,
                    "materialName": materialName,
                    "statusSourcing": statusSourcing,
                },
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
                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                }
            })
        }

        // Send data to Action Update Material for update sumary report
        function funcUpdateSumaryReport(idMaterial, materialName){
            $.ajax({
                url: '../controller/actionUpdateMaterial.php',
                type: 'POST',
                data: $('form#formSumaryReport'+idMaterial).serialize()+'&materialName='+materialName,
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
                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                }
            })
            $('#sumaryReport'+idMaterial).modal('hide');
        }

        // Send data to Action Update Material for update material
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

                        loadDataMaterial('<?php echo $_GET['projectCode']?>')
                    }
                })

                $('#editMaterial'+idMaterial).modal('hide');
            }
    </script>
<!-- -- -->