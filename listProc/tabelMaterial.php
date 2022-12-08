<div class="container mt-5 position-absolute p-0" style="left:250px">
    <!-- Card Table -->
    <div class="card" style="width:1100px">
        <div class="card-body">
            <!-- Tabel Project -->
            <table id="table-material" class="table table-striped m-1">
                <thead class="bg-primary" >
                    <tr>
                        <th class="d-none"></th>
                        <th style="width:10px"></th>
                        <th scope="col" style="font-size: 13px;width:10px" class="text-center">No</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Material Category</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Material Desc</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Spesification</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Catalog Or CAS Number</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Company</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Website</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Finish Dossage Form</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Keterangan</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Summary Report</th>
                        <th scope="col" style="font-size: 13px;width:350px" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../dbConfig.php";
                    $no = 1;
                    $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE feedbackRPIC=1")->fetchAll();
                    foreach($dataMaterial as $row){
                ?>
                    <tr>
                        <td class="d-none"><?php echo $row['id']?></td>
                        <td class="dt-control"></td>
                        <td style="font-size:13px;"><?php echo $no++?></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialCategory']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialDeskripsi']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialSpesification']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['company']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['website']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['finishDossageForm']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['keterangan']?></div></td>
                        <td><div class="text-wrap" style="font-size:13px;">-</div></td>
                        <td>
                            <!-- Edit Material -->
                            <button type="button" class="btn btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editMaterial<?php echo $row['id']?>">
                                <div style="font-size:13px">Edit Material</div>
                            </button>
                            <?php include "component/formUpdateMaterial.php"?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div> 
    <script>
        $(document).ready(function(){
            var materialTable = $('#table-material').DataTable({
                scrollX: true,
                lengthMenu: [3, 5, 10],
            })

            // Menampilkan tabel material, apabila user melakukan event click ditabel project
            $('#table-material<?php echo $_GET['projectCode']?> tbody').on('click', 'td.dt-control', function () {
                    var tr = $(this).closest('tr');
                    // Membuat variabel untuk mengambil data project dibaris yang mengalami event click
                    var row = materialTable.row(tr);
                    if (row.child.isShown()) {
                        // Menghilangkan tabel material jika event click ditutup
                        var table = $("#table-supplier"+row.data()[0], row.child());
                        table.DataTable().clear().destroy();
                        
                        // Fungsi untuk menyembunyikan baris
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Menampilkan tabel material jika event click dilakukan
                        row.child( tableSupplier(row.data()[0])).show();
                        tr.addClass('shown');
                    }
            });
        })

        // Membuat Tabel Supplier didalam sebuah fungsi
        function tableSupplier(d){
            $(document).ready(function(){
                loadDataSupplier(d)
            })
            return (
                '<div class="container-fluid m-0 p-0" id="contentDataSupplier'+d+'"></div>'
            )
        }

        function loadDataSupplier(d){
            $.ajax({
                url: 'component/subTabel/tabelSupplier.php',
                type: 'get',
                data: { idMaterial: d},
                success: function(data) {
                    $('#contentDataSupplier'+d+'').html(data);
                }
            });
        }
    </script>
    <!-- -- -->
  </body>
</html>