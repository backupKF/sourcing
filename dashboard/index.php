<?php
    include "../dbConfig.php"; 
    $currentPage = 'dashboard';

    session_start();
    
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
        <script src="../plugin/googlechart/loader.js"></script>
        

        <title>Dashboard</title>
    
    </head>
    <body class="position-relative">
        <!-- Sidebar -->
        <?php require "../sidebar.php"?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>

        <br>

        <div class="container position-absolute p-0" style="left:250px;top:70px">
            <h2 style="font-family:'poppinsBold'" class="mt-5 mb-3">Selamat Datang, <?php echo $_SESSION['user']['name']?></h2>
            <!-- Statistik -->
            <?php include "layout/statistik.php"?>
        </div>
    </body>
</html>