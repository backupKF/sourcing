<?php
    include "../dbConfig.php";
    $currentPage = 'view'; 

    session_start();
    
    // Kondosi apabila user belum login, maka akan me-redirect ke halaman login
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

        <title>Sourcing | View</title>

    </head>
    <body class="bg-dark bg-opacity-10">
    <!-- Sidebar -->
    <?php require "../sidebar.php" ?>

    <!-- Navbar -->
    <?php require "../navbar.php" ?>
    
    <br>

    <div class="container position-absolute p-0" style="left:235px;top:70px">
        <!-- Tabel View-->
        <?php require "layout/tabelView.php";?>
    </div>
    </body>
</html>