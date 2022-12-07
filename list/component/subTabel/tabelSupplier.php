<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
  Tambah Supplier
</button>
<?php include "../formAddSupplier.php"?>
<!-- Tabel Supplier -->
<table id="table-supplier<?php echo $_GET['idMaterial']?>" class="pt-2 table-bordered">
    <thead class="bg-warning">
        <tr>
            <th style="font-size:14px;width:10px" class="text-center">No</th>
            <th style="font-size:14px;width:140px" class="text-center">Supplier</th>
            <th style="font-size:14px;width:160px" class="text-center">Manufacture</th>
            <th style="font-size:14px;width:150px" class="text-center">Origin Country</th>
            <th style="font-size:14px;width:50px" class="text-center">Lead Time</th>
            <th style="font-size:14px;width:100px" class="text-center">
                <div class="container">
                    <div class="row">Information MoQ, UoM, Price</div>
                    <div class="row">
                        <div class="col">MoQ</div>
                        <div class="col">UoM</div>
                        <div class="col">Price</div>
                    </div>
                </div>
            </th>
            <th style="font-size:14px;width:100px" class="text-center">Catalog or CAS Number</th>
            <th style="font-size:14px;width:100px" class="text-center">Grade/Reference</th>
            <th style="font-size:14px;width:100px" class="text-center">Document Info</th>
            <th style="font-size:14px" class="text-center">Feedback Doc Req</th>
            <th style="font-size:14px" class="text-center">Feedback R&D</th>
            <th style="font-size:14px" class="text-center">Feedback Proc</th>
            <th style="font-size:14px" class="text-center">Final Feedback R&D</th>
            <th style="font-size:14px" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include "../../../dbConfig.php";
            $no = 1;
            $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial='{$_GET['idMaterial']}'")->fetchAll();
            foreach($dataSupplier as $row){
        ?>
            <tr>
                <!-- Column Nomer -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $no++?></div></td>
                <!-- Column Supplier -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['supplier']?></div></td>
                <!-- Column Manufacture -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['manufacture']?></div></td>
                <!-- Column Origin Country -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['originCountry']?></div></td>
                <!-- Column Lead Time -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['leadTime']?></div></td>
                <!-- Column Information MoQ, UoM, dan Price -->
                <td class="p-0">
                    <!-- Button Modal Tambah Informasi MoQ, UoM, dan Price -->
                    <button type="button" class="btn btn-default p-0" style="width:30px" data-bs-toggle="modal" data-bs-target="#tambahDetailSupplier<?php echo $row['id']?>">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,18V5H7V18L12,15.82L17,18M17,3A2,2 0 0,1 19,5V21L12,18L5,21V5C5,3.89 5.9,3 7,3H17M11,7H13V9H15V11H13V13H11V11H9V9H11V7Z" />
                        </svg>
                    </button>
                    <!-- -- -->

                    <!-- Modal Tambah Informasi MoQ, UoM, dan Price -->
                    <?php include "../formAddDetailSupplier.php"?>
                    <!-- -- -->

                    <!-- Tabel Informasi MoQ, UoM, dan Price -->
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                                include "../../dbConfig.php";
                                $detailSupplier = $conn->query("SELECT idDetailSupplier, MoQ, UoM, price FROM TB_DetailSupplier INNER JOIN TB_Supplier ON TB_DetailSupplier.idSupplier = TB_Supplier.id WHERE idSupplier='{$row['id']}'")->fetchAll();
                                foreach($detailSupplier as $detail){
                            ?>
                            <tr>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['MoQ']?></td>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['UoM']?></td>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['price']?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <!-- -- -->
                </td>
                <!-- Column Catalog Or Cas Number -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                <!-- Column Grade Or Reference -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['gradeOrReference']?></div></td>
                <!-- Column Document Info -->
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['documentInfo']?></div></td>
                <!-- Column Feedback Requirement Document -->
                <td>
                    <div style="font-size:13px;width:150px">
                        <?php 
                             $feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll();
                        ?>
                        <!-- Feedback Doc CoA -->
                        <div class="row">
                            <div class="col">
                                CoA
                            </div>
                            <div class="col">
                               <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['CoA']=="ok"? '' :'d-none'; ?> border">OK</div>
                               <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['CoA']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- Feedback Doc MSDS -->
                        <div class="row">
                            <div class="col">
                                MSDS
                            </div>
                            <div class="col">
                                <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['MSDS']=="ok"? '' :'d-none'; ?> border">OK</div>
                                <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['MSDS']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- Feedback Doc MoA -->
                        <div class="row">
                            <div class="col">
                                MoA
                            </div>
                            <div class="col">
                                <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['MoA']=="ok"? '' :'d-none'; ?> border">OK</div>
                                <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['MoA']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- Feedback Doc Halal -->
                        <div class="row">
                            <div class="col">
                                Halal
                            </div>
                            <div class="col">
                                <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['Halal']=="ok"? '' :'d-none'; ?> border">OK</div>
                                <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['Halal']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- Feedback Doc DMF -->
                        <div class="row">
                            <div class="col">
                                DMF
                            </div>
                            <div class="col">
                                <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['DMF']=="ok"? '' :'d-none'; ?> border">OK</div>
                                <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['DMF']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- Feedback Doc GMP -->
                        <div class="row">
                            <div class="col">
                                GMP
                            </div>
                            <div class="col">
                                <div class="bg-success text-center text-white <?php echo $feedbackDocReq[0]['GMP']=="ok"? '' :'d-none'; ?> border">OK</div>
                                <div class="bg-danger text-center text-white <?php echo $feedbackDocReq[0]['GMP']=="notOk"? '' :'d-none'; ?> border">NOT OK</div>
                            </div>
                        </div>
                        <!-- -- -->
                    </div>
                </td>
                <!-- Column Feedback RnD -->
                <td>
                    <div class="row ps-2 d-flex align-items-start" style="font-size:13px;">
                        <div class="row fw-bold">
                            Review Harga:
                        </div>
                        <div class="row">
                            <?php echo !empty($row['feedbackRndPriceReview'])?$row['feedbackRndPriceReview']:'-'?>
                        </div> 
                    </div>
                    <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                        <div class="col">
                            <div class="row fw-bold">
                                Sampel dan lainnya:
                            </div>
                            <?php
                                $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <div class="row">
                                <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $feedbackRnd[0]['dateFeedback']?></div>
                                <div style="font-size:12px;width:440px" class="text-wrap ps-0"><?php echo $feedbackRnd[0]['sampel']?></div>
                                <div style="font-size:9px" class="fw-bold ps-0"><?php echo !empty($feedbackRnd[0]['writer'])? 'By: '.$feedbackRnd[0]['writer']:'-'; ?></div>
                            </div>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackRnd<?php echo $row['id']?>">Sampel dan lainnya</button>
                            <?php include "../modalFeedbackRnd.php"?>
                        </div>
                    </div>
                </td>
                <!-- Column Feedback Proc -->
                <td>
                    <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                        <div class="col">
                            <?php
                                $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY ID DESC")->fetchAll();
                            ?>
                            <div class="row">
                                <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $feedbackProc[0]['dateFeedbackProc']?></div>
                                <div style="font-size:12px" class="text-wrap ps-0"><?php echo $feedbackProc[0]['feedback']?></div>
                                <div style="font-size:9px" class="fw-bold ps-0"><?php echo !empty($feedbackProc[0]['writer'])? 'By: '.$feedbackProc[0]['writer']:'-'; ?></div>
                            </div>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackProc<?php echo $row['id']?>">Feedback Proc</button>
                            <?php include "../modalFeedbackProc.php"?>
                        </div>
                    </div>
                </td>
                <!-- Column Final Feedback Rnd -->
                <td>
                    <div class="row ps-2 d-flex align-items-end" style="font-size:13px;">
                        <div class="col">
                            <?php
                                $finalFeedbackRnd = $conn->query("SELECT * FROM TB_FinalFeedbackRnd WHERE idSupplier='{$row['id']}'")->fetchAll();
                            ?>
                            <div class="row">
                                <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $finalFeedbackRnd[0]['dateFinalFeedbackRnd']?></div>
                                <div style="font-size:12px" class="ps-0"><?php echo !empty($finalFeedbackRnd[0]['finalFeedbackRnd'])? $finalFeedbackRnd[0]['finalFeedbackRnd']:'-'; ?></div>
                            </div>
                        </div>
                    </div>
                </td>
                <!-- Column Action -->
                <td>
                    <!-- Edit Supplier -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplier<?php echo $row['id']?>">
                        Edit Supplier
                    </button>
                    <?php include "../formUpdateSupplier.php"?>
                    <!-- Feedback Document Requirement -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackDocReq<?php echo $row['id']?>">
                        FeedbackDocReq
                    </button>
                    <?php include "../modalFeedbackDocReq.php"?>
                    <!-- Final Feedback RND -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#finalFeedbackRnd<?php echo $row['id']?>">
                        Final Feedback RnD
                    </button>
                    <?php include "../modalFinalFeedbackRnd.php"?>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<script>
     $(document).ready(function(){
        var supplierTable = $('#table-supplier<?php echo $_GET['idMaterial']?>').DataTable({
            // scrollX: true,
            lengthMenu: [2 , 3 , 5],
            // ordering: false,
            ordering: false,
        })
     })
</script>
<!-- -- -->