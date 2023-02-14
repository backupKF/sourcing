<?php 

    // Halaman Saat Ini
    $currentPage = 'dashboard';
    
    include "../dbConfig.php";

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

        <title>Dashboard | Tabel Info</title>

        <style>
            body{
                overflow-x: hidden;
            }

            /* CSS For Sidebar Responsive */
            .container{
                margin-top:65px;
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

            /* CSS Tabel Info Status */
            th{
                font-size:12px;
                font-family:poppinsBold;
            }
            td {
                font-size:12px;
                font-family:poppinsMedium;
            }
            .title-table {
                font-size:20px;
                font-family:poppinsBold
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
            <!-- Tabel Info -->
            <div class="card shadow bg-body rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <!-- Tombol Kembali -->
                            <a href="index.php" class="btn btn-danger btn-sm">Back</a>
                        </div>
                        <div class="col-8">
                            <!-- title -->
                            <div class="m-0 title-table">Material Sourcing {Status <?php echo $_GET['status']?>}</div>
                        </div>
                    </div>

                    <hr>

                    <!-- Table Info -->
                    <table id="table-info" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:150px">Material Name</th>
                                <th style="width:150px">Material Category</th>
                                <th style="width:300px">Spesifikasi</th>
                                <th style="width:150px">Target Launching</th>
                                <th style="width:250px">Supplier</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="width:150px">Material Name</th>
                                <th style="width:150px">Material Category</th>
                                <th style="width:300px">Spesifikasi</th>
                                <th style="width:150px">Target Launching</th>
                                <th style="width:250px">Supplier</th>
                            </tr>
                        </tfoot>
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
                    scrollY: '320px',
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
