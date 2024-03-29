<?php 
    include "../dbConfig.php";
    
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../index.php');
        exit(); 
    };

    // Mengambil data project
    $projectName = $conn->query("SELECT projectCode, projectName FROM TB_Project WHERE id='{$_SESSION['idProject']}' ")->fetchAll();
?>

<!-- Form Data Pengajuan -->
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <div class="card-title" style="font-size:24px;font-family:poppinsBold">Kelola Data Pengajuan</div>
        <hr>
        <!-- Select Project -->
        <div class="row">
            <!-- Value Project -->
            <div class="mb-3 col">
                <label class="form-label fw-bold ms-1 mb-2">Project</label>
                <input class="form-control form-control-sm" type="text" placeholder="<?php echo isset($_SESSION['idProject'])?"{$projectName[0]['projectCode']}  |  {$projectName[0]["projectName"]}":""; ?>" disabled readonly>
            </div>
            <!-- Button set project -->
            <div class="mb-3 col">
                <button type="button" class="btn btn-outline-primary btn-sm" style="margin-top:32px" data-bs-target="#project" data-bs-toggle="modal">
                    Select
                </button>
                <!-- Modal Set Project -->
                <?php include "../component/modal/client-side/setProject.php"?>
            </div>
        </div>
                    
        <hr class="m-0 mb-1">

        <!-- Cek apakah user sudah memilih project -->
        <?php if(isset($_SESSION['idProject'])){?>
        <!-- Form Tambah Pengajuan Sourcing-->
            <button class="btn btn-outline-primary btn-sm mt-1 mb-3 ms-1" type="button" data-bs-target="#modalTambahMaterial" data-bs-toggle="modal">
                Tambah Data Material
            </button>
        <?php 
            include "../component/modal/client-side/addMaterial.php";
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
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:1%">No</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:10%">Material Category</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Material Name</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Spesification</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Catalog Or CAS Number</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Company</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Website</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Finish Dossage Form</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Keterangan</th>
                    <th scope="col" style="font-size: 11px;font-family: poppinsSemiBold;width:11%">Document Requirement</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($_SESSION['materials'])){
                        $materials = $_SESSION['materials'];
                        foreach($materials as $row){
                        if($row['idProject'] == $_SESSION['idProject']){
                        $count++
                ?>
                <tr>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $count?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['materialCategory']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['materialName']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['materialSpesification']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['catalogOrCasNumber']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['company']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['website']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['finishDossageForm']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['keterangan']?></td>
                    <td style="font-size: 11px;font-family: poppinsRegular"><?php echo $row['documentReq']?></td>
                </tr>
                <?php 
                            } 
                        }
                    }
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