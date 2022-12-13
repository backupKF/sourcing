<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container position-relative" style="margin-left:235px;margin-top:10px">
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
                            $dataRiwayat = $conn->query("SELECT * FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode")->fetchAll();
                            $no=1;
                            foreach($dataRiwayat as $data){
                        ?>
                            <tr>
                                <td style="font-size: 12px;"><?php echo $no++?></td>
                                <td style="font-size: 12px;"><?php echo $data['materialName']?></td>
                                <td style="font-size: 12px;"><?php echo $data['dateSourcing']?></td>
                                <td style="font-size: 12px;"><?php echo $data['projectCode']?></td>
                                <td style="font-size: 12px;"><?php echo $data['projectName']?></td>
                                <td style="font-size: 12px;">-</td>
                                <td style="font-size: 12px;">-</td>
                                <td style="font-size: 12px;">
                                    <form action="controller/actionRiwayat.php" method="POST">
                                        <input type="hidden" name="setID" value="<?php echo $data['id']?>">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackTL">
                                            <option <?php echo $data['feedbackTL']==0?'selected':'';?> value=0>No Action</option>
                                            <option <?php echo $data['feedbackTL']==1?'selected':'';?> value=1>Approved</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="font-size: 12px;">
                                    <form action="controller/actionRiwayat.php" method="POST">
                                        <input type="hidden" name="setID" value="<?php echo $data['id']?>">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackRPIC">
                                            <option <?php echo $data['feedbackRPIC']==0?'selected':'';?> value=0>No Action</option>
                                            <option <?php echo $data['feedbackRPIC']==1?'selected':'';?> value=1>Accepted</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="font-size: 12px;"><?php echo $data['dateApprovedTL']?></td>
                                <td style="font-size: 12px;"><?php echo $data['dateAcceptedRPIC']?></td>
                                <td style="font-size: 12px;"><?php echo $data['statusRiwayat']?></td>
                                <td>
                                    <!-- Button -->
                                    <div class="text-center">
                                        <!-- Button Edit Material -->
                                        <button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial<?php echo $data['id']?>" data-bs-toggle="modal">Edit</button>
                                        <!-- Button View Material -->
                                        <button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial<?php echo $data['id']?>" data-bs-toggle="modal">View</button>
                                        <!-- Button Delete -->
                                        <a href="controller/actionRiwayat.php?action_type=delete&id=<?php echo $data['id']?>" class="btn btn-danger btn-sm d-inline ms-1" id="delete">Delete</a>
                                    </div>
                                    <?php include "component/modalEditMaterial.php"?>
                                    <?php include "component/modalViewMaterial.php"?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var tableRiwayat = $('#table-riwayat').DataTable({
                scrollX: true,
            })
        });
        $('.dataTables_scrollBody tbody').css(
            {'height':'20px'}
        );
    </script>
  </body>
</html>