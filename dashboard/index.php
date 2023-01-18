<?php
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
        <script src="../plugin/googlechart/loader.js"></script>
        

        <title>Dashboard</title>

        <style>
            body{
                overflow-x: hidden;
            }

            /* CSS Sidebar Responsive */
            .container{
                margin-left:260px;
            }

            .container .statistik{
                width:1050px;
            }

            .statistik .card-sourcing-sumary{
                width:320px;
                height:115px;
            }

            #check:checked ~ .container{
                margin-left:140px;
            }
            #check:checked ~ .container .statistik{
               width:1160px;
            }
            #check:checked ~ .container .statistik .card-sourcing-sumary{
               width:355px;
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
            <!-- Statistik -->
            <?php include "layout/statistik.php"?>
        </div>
    </body>
</html>