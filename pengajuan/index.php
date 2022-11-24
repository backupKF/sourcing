<?php
    // Halaman Saat Ini
    $currentPage = 'pengajuan'; 
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

        <!-- Formulir Pengajuan Sourcing -->
        <!-- <a href="kelola-data.php" style="margin-left:290px" class="btn btn-info mt-3">
            Tambah Data Pengajuan
        </a> -->

        <!-- Tabel Pengajuan -->
        <?php require "./kelola-data.php"?>
    </body>
</html>