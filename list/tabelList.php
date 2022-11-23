<?php

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container position-relative" style="margin-left:275px;z-index:1;">
        <div class="col-md-11">            
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-dark bg-opacity-50">
                        <th class="text-center" style="font-size: 15px;">
                            No
                        </th>
                        <th class="text-center" style="font-size: 15px;">
                            Project Name
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../dbConfig.php";
                        $dataProject = $conn->query("SELECT DISTINCT TB_Project.projectCode, TB_Project.projectName FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode")->fetchAll();
                        foreach($dataProject as $row) {
                        $checkFeedbackRPIC = $conn->query("SELECT feedbackRPIC FROM TB_RiwayatSourcing WHERE projectCode='{$row['projectCode']}' AND feedbackRPIC=1")->fetchAll();
                        if($checkFeedbackRPIC) {
                            $count++;
                    ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#<?php echo $row['projectCode']?>" aria-expanded="false" aria-controls="material" class="bg-light">
                        <td class="text-center" style="font-size: 15px;width:5%;"><?php echo $count ?></td>
                        <td class="text-center" style="font-size: 15px;"><?php echo $row['projectCode'], " | ", $row['projectName']?></td>
                        <td class="text-center" style="width:5%;"><i class="fa fa-caret-down" style="font-size:15px"></i></td>
                    </tr>

                    <tr>
                        <td colspan="12" style="padding: 0">
                            <div class="collapse overflow-scroll" id="<?php echo $row['projectCode']?>">
                                <table class="table table-bordered" style="width:200%" style="padding: 0">
                                    <thead>
                                        <tr class="bg-info bg-opacity-75">
                                            <th scope="col" style="font-size: 11px;width:10%" class="text-center">Material Category</th>
                                            <th scope="col" style="font-size: 11px;width:15%" class="text-center">Material Desc</th>
                                            <th scope="col" style="font-size: 11px;width:13%" class="text-center">Spesification</th>
                                            <th scope="col" style="font-size: 11px;width:10%" class="text-center">Catalog Or CAS Number</th>
                                            <th scope="col" style="font-size: 11px;width:13%" class="text-center">Company</th>
                                            <th scope="col" style="font-size: 11px;width:13%" class="text-center">Website</th>
                                            <th scope="col" style="font-size: 11px;width:10%" class="text-center">Finish Dossage Form</th>
                                            <th scope="col" style="font-size: 11px;width:15%" class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE projectCode='{$row['projectCode']}'")->fetchAll();
                                            foreach($dataMaterial as $material) {
                                        ?>
                                        <tr class="bg-dark bg-opacity-10" data-bs-toggle="collapse" data-bs-target="#<?php echo "material",$material['id']?>" aria-expanded="false" aria-controls="supplier">
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['materialCategory']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['materialDeskripsi']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['materialSpesification']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['company']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['website']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['materialDeskripsi']?></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['finishDossageForm']?></td></td>
                                            <td scope="col" style="font-size: 11px;" class="text-center"><?php echo $material['keterangan']?></td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" style="padding: 0">
                                                <div class="collapse overflow-scroll" id="<?php echo "material",$material['id']?>">
                                                    <table class="table table-bordered" style="width:110%" style="padding: 0"> 
                                                        <thead>
                                                            <tr class="bg-warning bg-opacity-75">
                                                                <th scope="col" style="font-size: 11px;width:10%" class="text-center">Supplier</th>
                                                                <th scope="col" style="font-size: 11px;width:15%" class="text-center">Manufacture</th>
                                                                <th scope="col" style="font-size: 11px;width:13%" class="text-center">Origin Country</th>
                                                                <th scope="col" style="font-size: 11px;width:10%" class="text-center">MoQ</th>
                                                                <th scope="col" style="font-size: 11px;width:13%" class="text-center">UoM</th>
                                                                <th scope="col" style="font-size: 11px;width:13%" class="text-center">Price</th>
                                                                <th scope="col" style="font-size: 11px;width:10%" class="text-center">Lead Time/th>
                                                                <th scope="col" style="font-size: 11px;width:15%" class="text-center">Catalog or CAS Number</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>		
                                </table>
                            </div>
                        </td>
                    </tr>

                    <?php } }?>

                </tbody>
            </table>
        </div>
    </div>
  </body>
</html>