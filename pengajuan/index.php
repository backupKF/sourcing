<?php
    // Halaman Saat Ini
    $currentPage = 'pengajuan'; 

    session_start();
    
    // Apabila user belum login maka akan me-redirect ke halaman login
    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit();
    }

    // Kondisi jika user == level 4, maka akan meredirect ke halaman dashboard
    if($_SESSION['user']['level'] == 4){
        header("Location: ../dashboard/index.php");
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
        <script src="../plugin/sweetalert/sweetalert.js"></script>

        <title>Sourcing | Pengajuan</title>

        <style>
            body{
                overflow-x: hidden;
            }

            /* CSS Sidebar Responsive */
            .container{
                margin-top:75px;
                margin-left:255px;
            }
            .card{
                width:1050px;
                height:500px;
            }
            #check:checked ~ .container{
                margin-left:125px;
            }
            #check:checked ~ .container .card{
                width:1160px;
            }

            div.dataTables_filter, div.dataTables_length {
                padding-bottom: 10px;
            }

            /* CSS Input Modal */
            .form-control{
                font-size: 14px;
                font-family: 'poppinsRegular';
            }
            .form-label{
                font-size:15px;
                font-family: 'poppinsSemiBold';
            }
            .form-check{
                font-size: 14px;
                font-family: 'poppinsRegular';
            }
            .modal-header{  
                display: flex;
                justify-content: center;
                font-size: 17px;
                font-family: 'poppinsBold';
                background-color: #e0fcd9;
            }
        </style>

    </head>

    <body>
        <!-- Sidebar -->
        <?php require "../sidebar.php" ?>

        <!-- Navbar -->
        <?php require "../navbar.php" ?>

        <br>

        <div class="container">
            <!-- Formulir Pengajuan -->
            <?php require "layout/formulirPengajuan.php"?>
        </div>
    </body>
</html>