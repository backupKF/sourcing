<?php
    $currentPage = 'list'; 

    if(!session_id()){ 
        session_start(); 
    }  
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
        <script src="../plugin/sweetalert/sweetalert.js"></script>

        <title>Sourcing | List</title>
    
    </head>
    <body class="bg-dark bg-opacity-10 position-relative">
    <!-- Sidebar -->
    <?php require "../sidebar.php" ?>

    <!-- Navbar -->
    <?php require "../navbar.php"?>
    
    <br>

    <div class="container mt-0 position-absolute p-0" id="detail-sourcing" style="left:230px;top:70px">
        <!-- Tabel Pengajuan -->
        <?php require "layout/tabelProject.php"?>
    </div>

    </body>
</html>