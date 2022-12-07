<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <style>
        table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
            padding-right: 0px;
        }
        table.dataTable tbody td div.detail{
            padding: 0px;
        }
        table.dataTable tbody td{
            word-wrap:break-word;
        }
    </style>
    <!-- -- -->
  </head>
  <body>
    <div class="container mt-5 position-absolute p-0" style="left:250px">
        <div style="width:1100px">
            <table class="table p-1" id="table-view">
                <thead>
                    <tr class="bg-light">
                        <th scope="col" style="font-size: 15px;width:10px" class="text-center">No</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Material Deskripsi</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Material Category</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Supplier</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Manufacture</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Project Name</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Status</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Feedback R&D</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Feedback Proc</th>
                        <th scope="col" style="font-size: 15px;width:200px" class="text-center">Final Feedback R&D</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "../dbConfig.php";
                        $no = 1;
                        $dataViewList = $conn->query("SELECT TB_Supplier.id, materialDeskripsi, materialCategory, supplier, manufacture, projectCode, status, feedbackRndPriceReview  FROM TB_Supplier INNER JOIN TB_PengajuanSourcing ON TB_Supplier.idMaterial = TB_PengajuanSourcing.id")->fetchAll();
                        foreach($dataViewList as $viewList){
                            ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $viewList['materialDeskripsi']?></td>
                            <td><?php echo $viewList['materialCategory']?></td>
                            <td><?php echo $viewList['supplier']?></td>
                            <td><?php echo $viewList['manufacture']?></td>
                            <td><?php echo $viewList['projectCode']?></td>
                            <td><?php echo $viewList['status']?></td>
                            <td>
                                <div class="row ps-2 d-flex align-items-start" style="font-size:13px;">
                                    <div class="row fw-bold">
                                        Review Harga:
                                    </div>
                                    <div class="row">
                                        <?php echo !empty($viewList['feedbackRndPriceReview'])?$viewList['feedbackRndPriceReview']:'-'?>
                                    </div> 
                                </div>
                                <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                                    <div class="col">
                                        <div class="row fw-bold">
                                            Sampel dan lainnya:
                                        </div>
                                        <?php
                                            $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$viewList['id']}' ORDER BY ID DESC")->fetchAll();
                                        ?>
                                        <div class="row">
                                            <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $feedbackRnd[0]['dateFeedback']?></div>
                                            <div style="font-size:12px;width:250px" class="text-wrap ps-0"><?php echo $feedbackRnd[0]['sampel']?></div>
                                            <div style="font-size:9px" class="fw-bold ps-0"><?php echo !empty($feedbackRnd[0]['writer'])? 'By: '.$feedbackRnd[0]['writer']:'-'; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                                    <div class="col">
                                        <?php
                                            $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$viewList['id']}' ORDER BY ID DESC")->fetchAll();
                                        ?>
                                        <div class="row">
                                            <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $feedbackProc[0]['dateFeedbackProc']?></div>
                                            <div style="font-size:12px" class="text-wrap ps-0"><?php echo $feedbackProc[0]['feedback']?></div>
                                            <div style="font-size:9px" class="fw-bold ps-0"><?php echo !empty($feedbackProc[0]['writer'])? 'By: '.$feedbackProc[0]['writer']:'-'; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                                    <div class="col">
                                        <?php
                                            $finalFeedbackRnd = $conn->query("SELECT * FROM TB_FinalFeedbackRnd WHERE idSupplier='{$viewList['id']}'")->fetchAll();
                                        ?>
                                        <div class="row">
                                            <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $finalFeedbackRnd[0]['dateFinalFeedbackRnd']?></div>
                                            <div style="font-size:12px" class="ps-0"><?php echo !empty($finalFeedbackRnd[0]['finalFeedbackRnd'])?$finalFeedbackRnd[0]['finalFeedbackRnd']:'-'; ?></div>
                                        </div>
                                    </div>
                                </div>
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
            $('#table-view').DataTable({
                scrollX: true,
            });
         })
    </script>

  </body>
</html>