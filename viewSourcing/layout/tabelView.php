<?php
    header('Location: ../index.php')
?>

<!-- Card Table -->
<div class="card" style="width:1100px">
    <div class="card-body">
        <!-- Tabel View -->
        <table class="display responsive nowrap" id="table-view">
            <thead>
                <tr>
                    <th class="text-center" style="font-size: 13px;width:30px">No</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Material Name</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Material Category</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Supplier</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Manufacture</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Project Name</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Status</th>
                    <th class="text-center" style="font-size: 13px;width:180px">Feedback R&D</th>
                    <th class="text-center" style="font-size: 13px;width:180px">Feedback Proc</th>
                    <th class="text-center" style="font-size: 13px;width:180px">Final Feedback</th>
                    <th class="text-center" style="font-size: 13px;width:100px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../dbConfig.php";
                    $no = 1;
                    $material = $conn->query('SELECT id, materialName, materialCategory, projectCode, statusPengajuan FROM TB_PengajuanSourcing WHERE feedbackRPIC=1 ORDER BY id DESC')->fetchAll();
                    foreach($material as $materialData){
                        if($supplier = $conn->query("SELECT TB_Supplier.id, materialName, materialCategory, supplier, manufacture, projectCode, statusPengajuan, dateFinalFeedbackRnd, finalFeedbackRnd, idMaterial FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id WHERE idMaterial=".$materialData['id']."ORDER BY id DESC")->fetchAll()){
                            foreach($supplier as $supplierData){
                ?>
                        <td style="font-size: 12px;"><?php echo $no++?></td>
                        <td style="font-size: 12px;"><?php echo $supplierData['materialName']?></td>
                        <td style="font-size: 12px;"><?php echo $supplierData['materialCategory']?></td>
                        <td style="font-size: 12px;"><?php echo $supplierData['supplier']?></td>
                        <td style="font-size: 12px;"><?php echo $supplierData['manufacture']?></td>
                        <td style="font-size: 12px;">
                            <?php 
                                $dataProject = $conn->query("SELECT * FROM TB_Project WHERE projectCode = '{$supplierData['projectCode']}'")->fetchAll();
                            ?>
                            <div>
                                <?php echo $dataProject[0]['projectCode'], ' | ', $dataProject[0]['projectName']?>
                            </div>
                        </td>
                        <td style="font-size: 12px;"><?php echo $supplierData['statusPengajuan']?></td>
                        <td style="font-size: 12px;">
                            <?php
                                $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$supplierData['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <div class="overflow-auto" style="height:60px">
                                <div>
                                    <div class="text-success p-0" style="width:85px;font-size:11px"><?php echo $feedbackRnd[0]['dateFeedback']?></div>
                                    <div class="text-wrap p-0" style="font-size:12px;"><?php echo $feedbackRnd[0]['sampel']?></div>
                                    <div class="fw-bold p-0" style="font-size:9px"><?php echo !empty($feedbackRnd[0]['writer'])? 'By: '.$feedbackRnd[0]['writer']:'-'; ?></div>
                                </div>
                        </div>
                        </td>
                        <td style="font-size: 12px;">
                            <?php
                                $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$supplierData['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <div class="overflow-auto" style="height:60px">
                                <!-- Isi Feedback Proc -->
                                <div style="height:70px">
                                    <div class="p-0">
                                        <div class="text-success" style="width:85px;font-size:11px"><?php echo $feedbackProc[0]['dateFeedbackProc']?></div>
                                        <div class="text-wrap" style="font-size:12px"><?php echo $feedbackProc[0]['feedback']?></div>
                                        <div class="fw-bold" style="font-size:9px"><?php echo !empty($feedbackProc[0]['writer'])? 'By: '.$feedbackProc[0]['writer']:'-'; ?></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 12px;">
                            <div style="height:60px">
                                <span class="text-success" style="width:85px;font-size:12px"><?php echo $supplierData['dateFinalFeedbackRnd']?></span>
                                <span class="text-wrap" style="width:85px;font-size:12px"> : <?php echo $supplierData['finalFeedbackRnd']?></span>
                            </div>
                        </td>
                        <td style="font-size: 12px;">
                            <a href="detailSourcing.php?idMaterial=<?php echo $supplierData['idMaterial']?>" class="btn btn-warning btn-sm">
                                Update Sourcing
                            </a>
                        </td>
                    </tr>
                <?php
                        }}else{
                ?>
                    <tr>
                        <td style="font-size: 12px;"><?php echo $no++?></td>
                        <td style="font-size: 12px;"><?php echo $materialData['materialName']?></td>
                        <td style="font-size: 12px;"><?php echo $materialData['materialCategory']?></td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">
                            <?php 
                                $dataProject = $conn->query("SELECT * FROM TB_Project WHERE projectCode = '{$materialData['projectCode']}'")->fetchAll();
                            ?>
                            <div>
                                <?php echo $dataProject[0]['projectCode'], ' | ', $dataProject[0]['projectName']?>
                            </div>
                        </td>
                        <td style="font-size: 12px;"><?php echo $materialData['statusPengajuan']?></td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">-<td style="font-size: 12px;">
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
    var tableView = $('#table-view').DataTable({
        scrollX : true,
    })
</script>
