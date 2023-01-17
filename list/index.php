<?php
    $currentPage = 'list'; 

    session_start();
    
    // Jika user belum login maka akan me-redirect kehalaman login
    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit();
    }

    if(isset($_POST['setVendor'])){
        $_SESSION['vendor'] = $_POST['setVendor'];
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

        <title>Sourcing | List</title>

        <style>
            /* CSS Sidebar Responsive */
            .container{
                margin-top:75px;
                margin-left:220px;
            }
            .card{
                width:1050px;
                margin-top:10px;
            }
            .card .contentMaterial{
                width:1000px;
            }
            #check:checked ~ .container{
                margin-left:90px;
            }
            #check:checked ~ .container .card .contentMaterial{
                width:1110px;
            }

            #check:checked ~ .container .card{
                width:1160px;
            }

            /* CSS Modal Input */
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
    <body style="overflow-x: hidden;">
        <!-- Sidebar -->
        <?php require "../sidebar.php" ?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>
        
        <br>

        <div class="container">
        <?php echo $_SESSION['vendor']?>
            <!-- Tabel Pengajuan -->
            <?php require "layout/tabelProject.php"?>
        </div>
    </body>
</html>