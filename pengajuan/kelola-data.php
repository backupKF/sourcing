<?php 
    $currentPage = 'pengajuan'; 

    if(!session_id()){ 
        session_start(); 
    } 

    include "../dbConfig.php";

    $projectName = $conn->query("SELECT projectName FROM TB_Project WHERE projectCode='{$_SESSION['project']}' ")->fetchAll();

    $sessMaterial = !empty($_SESSION['sessMaterial'])?$_SESSION['sessMaterial']:'';
    // Get status message from session 
    if(!empty($sessMaterial['status']['msg'])){ 
        $statusMsg = $sessMaterial['status']['msg']; 
        $statusMsgType = $sessMaterial['status']['type']; 
        unset($_SESSION['sessMaterial']['status']); 
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

        <link rel='stylesheet' href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css'>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

        <title>Sourcing | Pengajuan</title>
    </head>
    <body>
        <!-- Sidebar -->
        <?php include "../sidebar.php"?>
        <br>

        <!-- Form Kelola Data Pengajuan -->
        <div class="container" style="margin-left: 270px">
            <div class="card" style="width: 95%;">
                <div class="card-body">
                    <h5 class="card-title">Kelola Data Pengajuan</h5>
                    <hr>
                    <!-- Select Project -->
                    <form method="POST">
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="disabledTextInput" class="form-labe fw-bold ms-1 mb-2">Project</label>
                                <input class="form-control" type="text" placeholder="<?php echo isset($_SESSION['project'])?"{$_SESSION['project']}  |  {$projectName[0]["projectName"]}":""; ?>" aria-label="Disabled input example" disabled readonly>
                            </div>
                            <div class="mb-3 col">
                                <button type="button" class="btn btn-primary" style="margin-top:32px" data-bs-target="#project" data-bs-toggle="modal">
                                    Select
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <!-- Form Tambah Pengajuan Sourcing-->
                    <button class="btn btn-primary mt-1 mb-3 ms-1" type="button" data-bs-target="#tambahMaterial" data-bs-toggle="modal">
                        Tambah Data Material
                    </button>
                    <?php include "component/modalFormMaterial.php"?>
                    <!-- End Form Tambah Pengajuan Sourcing-->

                    <!-- Display status message -->
                    <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                        <div class="col-xs-4">
                            <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                        </div>
                    <?php } ?>

                    <!-- Tabel Data Hasil Pengajuan Sourcing -->
                        <table class="table-pagination row-border stripe hover" style="width:200%">
                            <thead>
                                <tr>
                                    <th scope="col" style="font-size: 11px;width:1%" class="text-center">No</th>
                                    <th scope="col" style="font-size: 11px;width:10%" class="text-center">Material Category</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Material Desc</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Spesification</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Catalog Or CAS Number</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Company</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Website</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Finish Dossage Form</th>
                                    <th scope="col" style="font-size: 11px;width:11%" class="text-center">Keterangan</th>
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
                                        <td style="font-size: 11px;" class="text-center"><?php echo $count?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['materialCategory']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['materialDeskripsi']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['materialSpesification']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['catalogOrCasNumber']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['company']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['website']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['finishDossageForm']?></td>
                                        <td style="font-size: 11px;" class="text-center"><?php echo $row['keterangan']?></td>
                                    </tr>
                                <?php 
                                    } }
                                ?>
                            </tbody>
                        </table>
                    <!-- End Tabel Data Hasil Pengajuan Sourcing -->
                    <hr>    
                    <!-- Action -->
                    <div class="d-flex">
                        <form action="controller/actionPengajuan.php" method="POST">
                            <input type="submit" value="Masukan ke Riwayat Pengajuan" class="btn btn-primary ms-3" name="tambahPengajuan">
                        </form>
                    </div>
                    <!-- End Action -->
                </div>
            </div>
        </div>
        <!-- End Kelola Data Pengajuan -->
        
        <!-- Modal Set Project -->
        <?php include "component/modalSetProject.php"?>
    
        <script>
            $(document).ready( function () {
                $('.table-pagination').DataTable({
                    scrollX: true,
                    lengthMenu: [3 , 5 , 10],
                });
            } );
        </script>
    </body>
</html>