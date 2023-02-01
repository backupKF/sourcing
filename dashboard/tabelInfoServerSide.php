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

        <style>
            body{
                overflow-x: hidden;
            }

            /* CSS Sidebar Responsive */
            .container{
                margin-top:40px;
                margin-left:255px;
            }
            .card{
                width:1050px;
                margin-top:10px;
            }
            #check:checked ~ .container{
                margin-left:125px;
            }
            #check:checked ~ .container .card{
                width:1160px;
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <?php require "../sidebar.php"?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>

        <br>

        <div class="container">
            <!-- Tombol Kembali -->
            <a href="index.php" class="btn btn-danger mt-2">Back</a>
            <!-- Tabel Info -->
            <div class="card shadow bg-body rounded">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-2" style="font-size:20px;font-family:poppinsBold">Material Sourcing {Status <?php echo $_GET['status']?>}</h3>
                    <!-- Table Info -->
                    <table id="table-info" class="table">
                        <thead>
                            <tr>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Material Name</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Material Category</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:300px">Spesifikasi</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:150px">Target Launching</th>
                                <th style="font-size:13px;font-family:poppinsRegular;width:250px">Supplier</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                // Datatable table info
                var projectInfo = $('#table-info').DataTable({
                    scrollX : true,
                    lengthChange: false,
                    pageLength: 7,
                    scrollY: '360px',
                    scrollCollapse: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '../controller/loadData/loadDataTabelInfoStatusSourcing.php',
                        type: 'GET',
                        data: {
                            status: "<?php echo $_GET['status']?>",
                        }
                    },
                    columns: [
                        {
                            data: "materialName"
                        },
                        {
                            data: "materialCategory"
                        },
                        {
                            data: "materialSpesification"
                        },
                        {
                            data: "targetLaunching"
                        },
                        {
                            data: "supplier"
                        },
                    ]
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
