<?php
    header('Location: ../index.php')
?>

<!-- Card Table -->
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <!-- Tabel View -->
        <table class="table" id="table-view">
            <thead>
                <tr>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:30px">No</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Material Name</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Material Category</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Supplier</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Manufacture</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Project Name</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Status</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:180px">Feedback R&D</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:180px">Feedback Proc</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:180px">Final Feedback</th>
                    <th class="text-center" style="font-size:14px;font-family:poppinsSemiBold;width:100px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../dbConfig.php";
                    $no = 1;
                    // Mengambil data Material
                    $material = $conn->query('SELECT id, materialName, materialCategory, projectCode, statusSourcing FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 ORDER BY id DESC')->fetchAll();
                    // Mengisi Data Material
                    foreach($material as $materialData){
                        // Kondisi jika material memiliki Supplier
                        if($supplier = $conn->query("SELECT TB_Supplier.id, materialName, materialCategory, supplier, manufacture, projectCode, statusSourcing, dateFinalFeedbackRnd, finalFeedbackRnd, writerFinalFeedbackRnd, idMaterial FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial=".$materialData['id']."ORDER BY id DESC")->fetchAll()){
                            // Maka isi tabel dengan data yang ada di tabel supplier
                            foreach($supplier as $supplierData){
                ?>
                        <!-- Column Number -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $no++?></td>

                        <!-- Column Material Name -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $supplierData['materialName']?></td>

                        <!-- Column Material Category -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $supplierData['materialCategory']?></td>

                        <!-- Column Supplier -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $supplierData['supplier']?></td>

                        <!-- Column Manufacture -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $supplierData['manufacture']?></td>

                        <!-- Column Project -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                            <!-- Mengambil Data Project -->
                            <?php 
                                $dataProject = $conn->query("SELECT * FROM TB_Project WHERE projectCode = '{$supplierData['projectCode']}'")->fetchAll();
                            ?>
                            <!-- Menampilkan data project -->
                            <?php echo $dataProject[0]['projectCode'], ' | ', $dataProject[0]['projectName']?>
                        </td>

                        <!-- Column Status Sourcing -->
                        <td style="font-size:12px;font-family:poppinsRegular;" class="text-center"><?php echo $supplierData['statusSourcing']?></td>

                        <!-- Column Feedback Rnd -->
                        <td>
                            <!-- Mengambil data feedback Rnd -->
                            <?php
                                $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$supplierData['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <!-- Tanggal Feedback -->
                            <div class="bg-success bg-opacity-75" style="width:95px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $feedbackRnd[0]['dateFeedback']?></div>
                            <!-- Isi Detail Feedback Rnd-->
                            <div class="overflow-auto" style="height:60px">
                                <div class="text-wrap pt-1" style="font-size:11px;font-family:poppinsMedium;"><?php echo $feedbackRnd[0]['sampel']?></div>
                            </div>
                            <!-- Penulis -->
                            <div style="font-size:10px;font-family:poppinsBold;"><?php echo !empty($feedbackRnd[0]['writer'])? 'By: '.$feedbackRnd[0]['writer']:'-'; ?></div>
                        </td>

                        <!-- Column Feedback Proc -->
                        <td>
                            <!-- Mengambil data feedback proc -->
                            <?php
                                $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$supplierData['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <!-- Tanggal Feedback Proc -->
                            <div class="bg-success bg-opacity-75" style="width:95px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $feedbackProc[0]['dateFeedbackProc']?></div>
                            <!-- Isi Feedback Proc -->
                            <div class="overflow-auto" style="height:60px">
                                <div class="text-wrap p-1" style="font-size:11px;font-family:poppinsMedium;"><?php echo $feedbackProc[0]['feedback']?></div>
                            </div>
                            <!-- Penulis -->
                            <div style="font-size:10px;font-family:poppinsBold;"><?php echo !empty($feedbackProc[0]['writer'])? 'By: '.$feedbackProc[0]['writer']:'-'; ?></div>
                        </td>

                        <!-- Column Final Feedback Rnd -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                            <!-- Tanggal Final Feedback Rnd -->
                            <div class="bg-success bg-opacity-75" style="width:95px;font-size:11px;font-family:poppinsBold;">Date: <?php echo $supplierData['dateFinalFeedbackRnd']?></div>
                            <!-- Isi Final Feedback Rnd -->
                            <div class="overflow-auto" style="height:60px">
                                <div class="text-wrap pt-1" style="font-size:11px;font-family:poppinsMedium;"><?php echo !empty($supplierData['finalFeedbackRnd'])? $supplierData['finalFeedbackRnd']:'-'; ?></div>
                            </div>
                            <!-- Penulis -->
                            <div style="font-size:10px;font-family:poppinsBold;"><?php echo !empty($supplierData['writerFinalFeedbackRnd'])? 'By: '.$supplierData['writerFinalFeedbackRnd']:'-'; ?></div>
                        </td>

                        <!-- Column Action -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                            <a href="detailSourcing.php?idMaterial=<?php echo $supplierData['idMaterial']?>" class="btn btn-warning btn-sm">
                                Update Sourcing
                            </a>
                        </td>
                    </tr>
                <?php
                        // Jika Material tidak memiliki supplier
                        }}else{
                ?>
                    <tr>
                        <!-- Column nomor -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $no++?></td>
                        <!-- Column Material Name -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $materialData['materialName']?></td>
                        <!-- Column Category -->
                        <td style="font-size:12px;font-family:poppinsRegular;"><?php echo $materialData['materialCategory']?></td>
                        <!-- Column Supplier -->
                        <td style="font-size:12px;font-family:poppinsRegular;">-</td>
                        <!-- Column Manufacture -->
                        <td style="font-size:12px;font-family:poppinsRegular;">-</td>
                        <!-- Column Project -->
                        <td style="font-size:12px;font-family:poppinsRegular;">
                            <?php 
                                $dataProject = $conn->query("SELECT * FROM TB_Project WHERE projectCode = '{$materialData['projectCode']}'")->fetchAll();
                            ?>
                            <div>
                                <?php echo $dataProject[0]['projectCode'], ' | ', $dataProject[0]['projectName']?>
                            </div>
                        </td>
                        <!-- Column Status Sourcing -->
                        <td style="font-size:12px;font-family:poppinsRegular;" class="text-center"><?php echo $materialData['statusSourcing']?></td>
                        <!-- Column Feedback R&D -->
                        <td style="font-size:12px;font-family:poppinsRegular;">-</td>
                        <!-- Column Feedback Proc -->
                        <td style="font-size:12px;font-family:poppinsRegular;">-</td>
                        <!-- Column Final Feedback R&D -->
                        <td style="font-size:12px;font-family:poppinsRegular;">-</td>
                        <!-- Column Action -->
                        <td>
                            <a href="detailSourcing.php?idMaterial=<?php echo $materialData['id']?>" class="btn btn-warning btn-sm">
                                Update Sourcing
                            </a>
                        </td>
                    </tr>
                <?php
                    }}
                ?>
            </tbody>
        </table>
    </div>            
</div>
<!-- -- -->

<script>
    $(document).ready(function() {
        // Datatable table view
        var tableView = $('#table-view').DataTable({
            scrollX : true,
            stateSave: true,
            lengthMenu: [5 , 10, 15],
        })

        // CSS Tabel
        $('.dataTables_filter input[type="search"]').css(
            {
                'height':'25px',
                'font-family':'poppinsRegular',
                'display':'inline-block',
                'margin-button':'2px',
            }
        );
        $('.dataTables_filter label').css(
            {
                'font-size':'15px',
                'font-family':'poppinsSemiBold',
                'display':'inline-block'
            }
        );
        $('.dataTables_length').css(
            {
                'font-size':'15px',
                'font-family':'poppinsSemiBold',
            }
        );
        $('.dataTables_length select').css(
            {
                'height':'25px',
                'font-family':'poppinsRegular',
                'padding':'0'
            }
        );
        $('.dataTables_info').css(
            {
                'font-size':'13px',
                'font-family': 'poppinsSemiBold'
            }
        );
        $('.dataTables_paginate').css(
            {
                'font-size':'13px',
                'font-family': 'poppinsSemiBold'
            }
        );
        $('.dataTables_scroll').css(
            {
                'margin-button':'2px',
            }
        );
    })
</script>
