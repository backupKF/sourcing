<!-- Tabel Material -->
    <table id="table-material<?php echo $_GET['projectCode']?>" class="table-bordered">
        <thead class="bg-primary" >
            <tr>
                <th class="d-none"></th>
                <th style="width:10px"></th>
                <th scope="col" style="font-size: 13px;width:10px" class="text-center">No</th>
                <th scope="col" style="font-size: 13px;width:50px" class="text-center">Material Category</th>
                <th scope="col" style="font-size: 13px;width:150px" class="text-center">Material Name</th>
                <th scope="col" style="font-size: 13px;width:20px" class="text-center">Priority</th>
                <th scope="col" style="font-size: 13px;width:200px" class="text-center">Spesification</th>
                <th scope="col" style="font-size: 13px;width:100px" class="text-center">Catalog Or CAS Number</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Company</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Website</th>
                <th scope="col" style="font-size: 13px;width:100px" class="text-center">Finish Dossage Form</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Keterangan</th>
                <th scope="col" style="font-size: 13px;width:100px" class="text-center">PIC</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Vendor Terdaftar AERO</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Document Requirement</th>
                <th scope="col" style="font-size: 13px;width:100px" class="text-center">Status</th>
                <th scope="col" style="font-size: 13px;width:250px" class="text-center">Summary Report</th>
                <th scope="col" style="font-size: 13px;width:100px" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include "../../dbConfig.php";
            $no = 1;
            $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE projectCode='{$_GET['projectCode']}' AND feedbackRPIC=1")->fetchAll();
            foreach($dataMaterial as $row){
        ?>
            <tr>
                <td class="d-none"><?php echo $row['id']?></td>
                <td class="dt-control"></td>
                <td style="font-size:13px;"><?php echo $no++?></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialCategory']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialName']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['priority']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['materialSpesification']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['company']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['website']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['finishDossageForm']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['keterangan']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;">-</div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['vendor']?></div></td>
                <td><div class="text-wrap" style="font-size:13px;"><?php echo $row['documentReq']?></div></td>
                <!-- Column Status -->
                <td>
                <?php if($row['statusPengajuan']==''){?>
                    <form action="../controller/actionUpdateMaterial.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id']?>" name="idMaterial">
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="statusPengajuan">
                            <option value=""></option>
                            <option value="OPEN">OPEN</option>
                            <option value="RE-OPEN">RE-OPEN</option>
                            <option value="DONE">DONE</option>
                            <option value="DROP">DROP</option>
                            <option value="NOT YET">NOT YET</option>
                            <option value="HOLD">HOLD</option>
                        </select>
                    </form>
                <?php }else{?>
                    <div style="font-size:13px"><?php echo $row['statusPengajuan']?></div>
                <?php }?>
                </td>
                <!-- Column Summary Report -->
                <td>
                    <div class="overflow-auto" style="height:65px">
                        <!-- Isi Final Feedback Rnd -->
                        <div style="height:30px">
                            <div class="p-0">
                                <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $row['dateSumaryReport']?></div>
                                <div class="text-wrap" style="font-size:12px"><?php echo !empty($row['sumaryReport'])? $row['sumaryReport']:'-'; ?></div>
                            </div>
                        </div>
                    </div>
                    <!-- Action Final Feedback Rnd -->
                    <div>
                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#sumaryReport<?php echo $row['id']?>">
                            <div style="font-size:12px">Sumary Report</div>
                        </button>
                        <?php include "../../component/modal/sumaryReport.php"?>
                    </div>
                </td>
                <!-- Column Action Material -->
                <td>
                    <!-- Edit Material -->
                    <button type="button" class="btn btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editMaterial<?php echo $row['id']?>">
                        <div style="font-size:13px">Edit Material</div>
                    </button>
                    <?php include "../../component/modal/updateMaterialList.php"?>
                    <!-- Prosessing Data -->
                    <script>
                        $('form#formEditMaterial<?php echo $row['id']?>').on('submit', function(e){
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "../controller/actionUpdateMaterial.php",
                                data: $(this).serialize(),
                                success: function(data){
                                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                                }
                            })
                            $('#editMaterial<?php echo $row['id']; ?>').modal('hide');
                        })
                    </script>
                </td>
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
                stateSave: true,
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
                url: 'layout/tabelSupplier.php',
                type: 'get',
                data: { idMaterial: d},
                success: function(data) {
                    $('#contentDataSupplier'+d+'').html(data);
                }
            });
        }
    </script>
<!-- -- -->