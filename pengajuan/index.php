<?php
    // Halaman Saat Ini
    $currentPage = 'pengajuan'; 

    session_start();
    
    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit();
    }

    if($_SESSION['user']['level'] == 3){
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
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href="../plugin/bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="../plugin/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="../plugin/jquery/jquery.min.js"></script>
        <link href='../plugin/datatable/css/jquery.dataTables.min.css'  rel='stylesheet'>
        <script src="../plugin/datatable/js/jquery.dataTables.min.js"></script>
        <script src="../plugin/sweetalert/sweetalert.js"></script>
        <title>Sourcing | Pengajuan</title>
        <style>
            .poppins {
                font-family: 'Poppins';
            }
        </style>
    </head>

    <body class="bg-dark bg-opacity-10">
        <!-- Sidebar -->
        <?php require "../sidebar.php" ?>

        <!-- Navbar -->
        <?php require "../navbar.php" ?>

        <br>

        <div class="container position-absolute p-0" style="left:230px;top:50px">
            <!-- Formulir Pengajuan -->
            <?php require "layout/formulirPengajuan.php"?>
        </div>
    </body>
</html>