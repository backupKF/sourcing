<?php
    include "../dbConfig.php"; 
    $currentPage = 'dashboard';
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../plugin/jquery/jquery.min.js"></script>
    <link href='../plugin/datatable/css/jquery.dataTables.min.css'  rel='stylesheet'>
    <script src="../plugin/datatable/js/jquery.dataTables.min.js"></script>
    <title>Dashboard</title>
    <style>
        .poppins {
            font-family: 'Poppins';
        }
    </style>
    </head>
    <body class="position-relative">
        <!-- Sidebar -->
        <?php require "../sidebar.php"?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>

        <br>

        <!-- Tabel Info -->
        <div class="container position-absolute p-0" style="left:250px;top:70px">
            <div class="card" style="width:1020px;margin-top:10px;background-color:#f5fcde">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-2" style="font-size:20px">Tabel Info Material Sourcing [Status <?php echo $_GET['status']?>]</h3>
                    <table class="display responsive nowrap m-1" id="table-info" style="width:100%">
                        <thead>
                            <tr>
                                <th style="font-size:13px">No</th>
                                <th style="font-size:13px">Material Name</th>
                                <th style="font-size:13px">Material Category</th>
                                <th style="font-size:13px;width:600px">Spesifikasi</th>
                                <th style="font-size:13px">Target Launching</th>
                                <th style="font-size:13px">Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getIdMaterial = $conn->query("SELECT id, materialName, materialCategory, materialSpesification FROM TB_PengajuanSourcing WHERE statusPengajuan='{$_GET['status']}' ORDER BY id DESC")->fetchAll();
                                $no=1;
                                foreach($getIdMaterial as $data){
                                    if($getData= $conn->query("SELECT * FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial='{$data['id']}' ORDER BY TB_Supplier.id DESC")->fetchAll()){
                                        foreach($getData as $row){
                            ?>
                                            <tr>
                                                <td style="font-size:12px"><?php echo $no++?></td>
                                                <td style="font-size:12px"><?php echo $row['materialName']?></td>
                                                <td style="font-size:12px"><?php echo $row['materialCategory']?></td>
                                                <td class="text-wrap" style="font-size:12px"><?php echo $row['materialSpesification']?></td>
                                                <td style="font-size:12px">-</td>
                                                <td style="font-size:12px"><?php echo $row['supplier']?></td>
                                            </tr>
                            <?php
                                        }
                                    }else{
                            ?>
                                            <tr>
                                                <td style="font-size:12px"><?php echo $no++?></td>
                                                <td style="font-size:12px"><?php echo $data['materialName']?></td>
                                                <td style="font-size:12px"><?php echo $data['materialCategory']?></td>
                                                <td style="font-size:12px"><?php echo $data['materialSpesification']?></td>
                                                <td style="font-size:12px">-</td>
                                                <td style="font-size:12px">-</td>
                                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="index.php" class="btn btn-danger mt-2">Back</a>

        </div>
        <!-- -- -->

        <script>
            $(document).ready(function(){
                var projectInfo = $('#table-info').DataTable({
                    lengthMenu: [10, 15],
                    scrollX: true,
                })
                $('.dataTables_filter input[type="search"]').css(
                    {'height':'25px','display':'inline-block'}
                );
                $('.dataTables_filter label').css(
                    {'font-size':'15px','display':'inline-block'}
                );
                $('.dataTables_length label').css(
                    {'font-size':'15px','display':'inline-block'}
                );
                $('.dataTables_length select option').css(
                    {'font-size':'2px'}
                );
                $('.dataTables_info').css(
                    {'font-size':'15px'}
                );
                $('.dataTables_paginate').css(
                    {'font-size':'15px'}
                );
            })
        </script>
    </body>
</html>
