<!-- Tabel Project -->
    <table id="table-material<?php echo $_GET['projectCode']?>" class="table-bordered">
        <thead class="bg-primary" >
            <tr>
                <th class="d-none"></th>
                <th style="width:10px"></th>
                <th scope="col" style="font-size: 13px;width:10px" class="text-center">No</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Material Category</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Material Desc</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Spesification</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Catalog Or CAS Number</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Company</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Website</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Finish Dossage Form</th>
                <th scope="col" style="font-size: 13px;width:340px" class="text-center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include "../../../dbConfig.php";
            $no = 1;
            $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE projectCode='{$_GET['projectCode']}' AND feedbackRPIC=1")->fetchAll();
            foreach($dataMaterial as $row){
        ?>
            <tr>
                <td class="d-none"><?php echo $row['id']?></td>
                <td class="dt-control"></td>
                <td><?php echo $no++?></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['materialCategory']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['materialDeskripsi']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['materialSpesification']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['company']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['website']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['finishDossageForm']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:12px;"><?php echo $row['keterangan']?></div></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            var materialTable = $('#table-material<?php echo $_GET['projectCode']?>').DataTable({
                scrollX: true,
                lengthMenu: [3 , 5],
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