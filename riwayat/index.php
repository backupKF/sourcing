<?php
    include "../dbConfig.php";
    $currentPage = 'riwayat'; 

    session_start();
    
    // Kondisi jika user belum login, maka akan me-redirect ke halaman login
    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit();
    }

    // Kondisi jika user == level 4, maka akan meredirect ke halaman dashboard
    if($_SESSION['user']['level'] == 4){
        header("Location: ../dashboard/index.php");
        exit();
    }
    // Check Reading Notifications
    if(!empty($_GET['rs'])){
        if($checkNotif = $conn->query("SELECT * FROM TB_Notifications WHERE randomId='".$_GET['rs']."'")->fetchAll()){
            $checkUserReadNotif = $conn->query("SELECT * FROM TB_StatusNotifications WHERE idUser=".$_SESSION['user']['id']." AND randomIdNotification='".$_GET['rs']."'")->fetchAll();
            if($checkUserReadNotif[0]['readingStatus'] == 0){
                $sql = "UPDATE TB_StatusNotifications SET readingStatus = ? WHERE idUser = ? AND idNotification = ?";
                $query = $conn->prepare($sql);
                $update = $query->execute(array(1, $checkUserReadNotif[0]['idUser'], $checkUserReadNotif[0]['idNotification']));
            }
        }
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

        <title>Sourcing | Riwayat</title>
        
        <!-- Style Folder Component -->
        <style>
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
    <body class="bg-dark bg-opacity-10">
  
    <!-- Sidebar -->
    <?php require "../sidebar.php" ?>

    <!-- Navbar -->
    <?php require "../navbar.php" ?>

    <br>
    
    <div class="container position-absolute p-0" style="left:230px;top:70px">
        <!-- Tabel Riwayat -->
        <div id="tabel-riwayat"></div>
    </div>

    </body>

    <script>
    $(document).ready(function(){
        loadDataRiwayat(<?php echo $_SESSION['user']['level']?>)
    })

    // Function Load Data Riwayat
    function loadDataRiwayat(userLevel){
        $.ajax({
            type: 'GET',
            url: 'layout/tabelRiwayat.php',
            <?php
                if(empty($_GET['sn']) && empty($_GET['idMaterial'])){
            ?>
                data: {getData: true, userLevel: userLevel},
            <?php
                }
                if(!empty($_GET['sn']) && empty($_GET['idMaterial'])){
            ?>
                data: {sn: <?php echo $_GET['sn']?>, userLevel: userLevel},
            <?php
                }
                if(!empty($_GET['sn']) && !empty($_GET['idMaterial'])){
            ?>
                data: {sn: <?php echo $_GET['sn']?>, idMaterial: <?php echo $_GET['idMaterial']?>, userLevel: userLevel},
            <?php
                }
            ?>
            success: function(data){
                $('#tabel-riwayat').html(data);
            }
        });
    }
    </script>
</html>