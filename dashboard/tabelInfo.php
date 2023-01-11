<?php
    include "../dbConfig.php"; 
    $currentPage = 'dashboard';

    session_start();
    
    // Apabila user belum login maka akan me-redirect ke halaman login
    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit();
    }
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../plugin/font/css/font.css" rel="stylesheet"/>
    <link href="../plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../plugin/jquery/jquery.min.js"></script>
    <link href='../plugin/datatable/css/jquery.dataTables.min.css'  rel='stylesheet'>
    <script src="../plugin/datatable/js/jquery.dataTables.min.js"></script>

    <title>Dashboard</title>
    
    </head>
    <body class="position-relative">
        <!-- Sidebar -->
        <?php require "../sidebar.php"?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>

        <br>

        <div class="container position-absolute p-0" style="left:250px;top:70px">
            <!-- Tombol Kembali -->
            <a href="index.php" class="btn btn-danger mt-2">Back</a>
            <!-- Tabel Info -->
            <div class="card" style="width:1050px;margin-top:10px;background-color:">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-2" style="font-size:20px;font-family:poppinsBold">Material Sourcing {Status <?php echo $_GET['status']?>}</h3>
                    <!-- Table Info -->
                    <table class="display responsive nowrap m-1" id="table-info">
                        <thead>
                            <tr>
                                <th style="font-size:13px;font-family:poppinsRegular;width:10px">No</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Material Name</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Material Category</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:300px">Spesifikasi</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Target Launching</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:250px">Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getIdMaterial = $conn->query("SELECT id, materialName, materialCategory, materialSpesification FROM TB_PengajuanSourcing WHERE statusSourcing='{$_GET['status']}' ORDER BY id DESC")->fetchAll();
                                $no=1;
                                foreach($getIdMaterial as $data){
                                    if($getData= $conn->query("SELECT * FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial='{$data['id']}' ORDER BY TB_Supplier.id DESC")->fetchAll()){
                                        foreach($getData as $row){
                            ?>
                                            <tr>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $no++?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $row['materialName']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $row['materialCategory']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular" class="text-wrap"><?php echo $row['materialSpesification']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular">-</td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $row['supplier']?></td>
                                            </tr>
                            <?php
                                        }
                                    }else{
                            ?>
                                            <tr>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $no++?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $data['materialName']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $data['materialCategory']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular"><?php echo $data['materialSpesification']?></td>
                                                <td style="font-size:12px;font-family:poppinsRegular">-</td>
                                                <td style="font-size:12px;font-family:poppinsRegular">-</td>
                                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                // Datatable table info
                var projectInfo = $('#table-info').DataTable({
                    lengthMenu: [5, 10],
                    scrollX: true,
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
            })
        </script>
    </body>
</html>
