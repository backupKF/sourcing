<?php
    $currentPage = 'view'; 

    session_start();
    include "../dbConfig.php";

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
    
    // Check Login
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
        <script src="../plugin/sweetalert/sweetalert.js"></script>

        <title>Sourcing | View</title>

        <style>
            body{
                overflow-x: hidden;
            }

            /* CSS Sidebar Responsive */
            .container{
                margin-left:260px;
                margin-top:50px;
                margin-bottom:25px;
            }
            .card{
                width:1010px;
                margin-top:10px;
            }
            #check:checked ~ .container{
                margin-left:125px;
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
    <body>
        <!-- Sidebar -->
        <?php require "../sidebar.php" ?>

        <!-- Navbar -->
        <?php require "../navbar.php" ?>

        <br>
        <!-- Detail Sourcing -->
        <div class="container">
            <!-- Card Table -->
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <!-- Formulir Material -->
                    <div id="formEditMaterial"></div>

                    <hr>

                    <!-- Tabel Supplier -->
                    <div id="tabelSupplier"></div>

                    <a href="../viewSourcing/index.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>

        <script>
        $(document).ready(function(){
            loadDataSupplier(<?php echo $_GET['idMaterial']?>,<?php echo $_GET['idSupplier']?>)
            loadDataMaterial(<?php echo $_GET['idMaterial']?>)
        })

        // Function Load Data Supplier
        function loadDataSupplier(idMaterial, idSupplier){
            $.ajax({
                type: 'GET',
                url: 'layout/tabelSupplier.php',
                data: {idMaterial: idMaterial, idSupplier: idSupplier},
                success: function(data){
                    $('#tabelSupplier').html(data);
                }
            });
        }

        // Function Load Data Material
        function loadDataMaterial(id){
            $.ajax({
                type: 'GET',
                url: 'layout/formEditMaterial.php',
                data: {idMaterial: id},
                success: function(data){
                    $('#formEditMaterial').html(data);
                }
            });
        }
        </script>

    </body>
</html>