<?php
    $currentPage = 'view'; 
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

        <title>Sourcing | View</title>
        
    </head>
    <body class="bg-dark bg-opacity-10">
        <!-- Sidebar -->
        <?php require "../sidebar.php" ?>

        <!-- Navbar -->
        <?php require "../navbar.php"?>

        <br>
        <!-- Detail Sourcing -->
        <div class="container position-absolute p-0" style="left:230px;top:70px">
            <!-- Card Table -->
            <div class="card" style="width:1050px">
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