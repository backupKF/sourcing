<?php 
    include "../dbConfig.php";
    
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit(); 
    };

    // Mengambil data project
    $projectName = $conn->query("SELECT projectName FROM TB_Project WHERE projectCode='{$_SESSION['project']}' ")->fetchAll();
?>

<!-- Form Data Pengajuan -->
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <h5 class="card-title">Kelola Data Pengajuan</h5>
        <hr>
        <!-- Select Project -->
        <div class="row">
            <!-- Value Project -->
            <div class="mb-3 col">
                <label class="form-labe fw-bold ms-1 mb-2">Project</label>
                <input class="form-control form-control-sm" type="text" placeholder="<?php echo isset($_SESSION['project'])?"{$_SESSION['project']}  |  {$projectName[0]["projectName"]}":""; ?>" disabled readonly>
            </div>
            <!-- Button set project -->
            <div class="mb-3 col">
                <button type="button" class="btn btn-outline-primary btn-sm" style="margin-top:32px" data-bs-target="#project" data-bs-toggle="modal">
                    Select
                </button>
                <!-- Modal Set Project -->
                <?php include "../component/modal/setProjectServerSide.php"?>
            </div>
        </div>
                    
        <hr class="m-0 mb-1">

        <!-- Cek apakah user sudah memilih project -->
        <?php if(isset($_SESSION['project'])){?>
        <!-- Form Tambah Pengajuan Sourcing-->
            <button class="btn btn-outline-primary btn-sm mt-1 mb-3 ms-1" type="button" data-bs-target="#modalTambahMaterial" data-bs-toggle="modal">
                Tambah Data Material
            </button>
        <?php 
            include "../component/modal/addMaterial.php";
            // Jika User belum memilih project
            }else{
        ?>
            <button class="btn btn-outline-primary btn-sm mt-1 mb-3 ms-1 disabled" type="button">
                Tambah Data Material
            </button>
        <?php }?>
        <!-- End Form Tambah Pengajuan Sourcing-->

        <!-- Tabel Data Hasil Pengajuan Sourcing -->
        <table class="table-pagination row-border stripe hover" style="width:200%">
            <thead>
                <tr>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:1%" class="text-center">No</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:10%" class="text-center">Material Category</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Material Name</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Spesification</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Catalog Or CAS Number</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Company</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Website</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Finish Dossage Form</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Keterangan</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%" class="text-center">Document Requirement</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $materials = $_SESSION['materials'];
                    foreach($materials as $row){
                    if($row['projectCode'] == $_SESSION['project']){
                    $count++
                ?>
                <tr>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $count?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['materialCategory']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['materialName']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['materialSpesification']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['catalogOrCasNumber']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['company']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['website']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['finishDossageForm']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['keterangan']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular" class="text-center"><?php echo $row['documentReq']?></td>
                </tr>
                <?php 
                    } }
                ?>
            </tbody>
        </table>
        <!-- End Tabel Data Hasil Pengajuan Sourcing -->
        <hr class="m-0 mb-2">
                        
        <?php if(isset($_SESSION['materials'])){?>
        <!-- Action -->
        <div class="d-flex">
            <form action="../controller/actionPengajuan.php" method="POST">
                <input type="submit" value="Masukan ke Riwayat Pengajuan" class="btn btn-outline-primary btn-sm ms-1" name="tambahPengajuan">
            </form>
        </div>
        <!-- End Action -->
        <?php }else{?>
            <button class="btn btn-outline-primary btn-sm ms-1 disabled" >Masukan ke Riwayat Pengajuan</button>
        <?php }?>
    </div>
    <!-- End Kelola Data Pengajuan -->
</div>
    
<script>
    $(document).ready( function () {
        $('.table-pagination').DataTable({
            scrollX: true,
            lengthMenu: [3 , 5 , 10],
            stateSave: true,
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
    });
</script>