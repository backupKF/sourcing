<div class="card" style="width:1050px">
    <div class="card-body">
        <table class="table p-1" id="table-riwayat">
            <thead>
                <tr>
                    <th scope="col" style="font-size: 13px;width:10px" class="text-center">No</th>
                    <th scope="col" style="font-size: 13px;width:150px" class="text-center">Material Name</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Date Sourcing</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Project Code</th>
                    <th scope="col" style="font-size: 13px;width:120px" class="text-center">Project Name</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Team Leader</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Researcher</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Feedback TL</th>
                    <th scope="col" style="font-size: 13px;width:100px" class="text-center">Feedback RPIC</th>
                    <th scope="col" style="font-size: 13px;width:120px" class="text-center">Date Approved TL</th>
                    <th scope="col" style="font-size: 13px;width:125px" class="text-center">Date Accepted RPIC</th>
                    <th scope="col" style="font-size: 13px;width:90px" class="text-center">Status</th>
                    <th scope="col" style="font-size: 13px;width:180px" class="text-center">Edit Material</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../../dbConfig.php";
                    $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode")->fetchAll();
                    $no=1;
                    foreach($dataRiwayat as $row){
                ?>
                    <tr>
                        <td style="font-size: 12px;"><?php echo $no++?></td>
                        <td style="font-size: 12px;"><?php echo $row['materialName']?></td>
                        <td style="font-size: 12px;"><?php echo $row['dateSourcing']?></td>
                        <td style="font-size: 12px;"><?php echo $row['projectCode']?></td>
                        <td style="font-size: 12px;"><?php echo $row['projectName']?></td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">-</td>
                        <td style="font-size: 12px;">
                            <form onclick="funcFeedbackTL(<?php echo $row['id']?>)" id="formFeedbackTL_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackTL">
                                    <option <?php echo $row['feedbackTL']==0?'selected':'';?> value=0>No Action</option>
                                    <option <?php echo $row['feedbackTL']==1?'selected':'';?> value=1>Approved</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size: 12px;">
                            <form onclick="funcFeedbackRPIC(<?php echo $row['id']?>)" id="formFeedbackRPIC_<?php echo $row['id']?>">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackRPIC">
                                    <option <?php echo $row['feedbackRPIC']==0?'selected':'';?> value=0>No Action</option>
                                    <option <?php echo $row['feedbackRPIC']==1?'selected':'';?> value=1>Accepted</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size: 12px;"><?php echo $row['dateApprovedTL']?></td>
                        <td style="font-size: 12px;"><?php echo $row['dateAcceptedRPIC']?></td>
                        <td style="font-size: 12px;"><?php echo $row['statusRiwayat']?></td>
                        <td>
                            <!-- Button -->
                            <div class="text-center">
                                <!-- Button Edit Material -->
                                <button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial<?php echo $row['id']?>" data-bs-toggle="modal">Edit</button>
                                <!-- Button View Material -->
                                <button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial<?php echo $row['id']?>" data-bs-toggle="modal">View</button>
                                <!-- Button Delete -->
                                <button type="button" class="btn btn-danger btn-sm d-inline ms-1" onclick="deleteMaterial(<?php echo $row['id']?>)">Delete</a>
                            </div>
                            <!-- Modal Update Material -->
                            <?php include "../../component/modal/updateMaterialRiwayat.php"?>
                            <!-- Modal View Material -->
                            <?php include "../../component/modal/viewMaterial.php"?>
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
    $(document).ready(function() {
        var tableRiwayat = $('#table-riwayat').DataTable({
            scrollX: true,
            stateSave: true,
        })
    });
    $('.dataTables_scrollBody tbody').css(
        {'height':'20px'}
    );

    function funcFeedbackTL(idMaterial){
        let feedbackTL = $('form#formFeedbackTL_'+idMaterial+' select#feedbackTL').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackTL: feedbackTL},
            dataType: 'json',
            success: function(response){
                loadDataRiwayat();
            }
        })
    }

    function funcFeedbackRPIC(idMaterial){
        let feedbackRPIC = $('form#formFeedbackRPIC_'+idMaterial+' select#feedbackRPIC').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackRPIC: feedbackRPIC},
            dataType: 'json',
            success: function(response){
                loadDataRiwayat();
            }
        })
    }

    function deleteMaterial(id){
        $.ajax({
            type: 'GET',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: id, actionType: "delete"},
            dataType: 'json',
            success: function(response){
                loadDataRiwayat()
            }
        })
    }

    function funcUpdateMaterial(id){
        $.ajax({
            type: "POST",
            url: "../controller/actionUpdateMaterial.php",
            data: $('form#formEditMaterial'+id).serialize(),
            dataType: 'json',
            success: function(response){
                loadDataRiwayat()
            }
        })
        $('#editMaterial'+id).modal('hide');
    }
</script>