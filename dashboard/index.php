<?php
    include "../dbConfig.php"; 
    $currentPage = 'dashboard';
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css'>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
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

        <div class="container position-absolute p-0" style="left:250px;top:70px">
            <h4>Dashboard...</h4>
            <h5>Selamat Datang RPIC</h5>
            <?php include "layout/statistik.php"?>
        </div>
    </body>
</html>