<?php
    $currentPage = 'view'; 
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../bootstrap-5.2.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css'>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <title>Sourcing | View</title>
    <style>
        .poppins {
            font-family: 'Poppins';
        }
    </style>
    </head>
    <body class="bg-dark bg-opacity-10 position-relative">
    <!-- Sidebar -->
    <?php require "../sidebar.php" ?>
    
    <br>

    <!-- Detail Sourcing -->
    <div class="container mt-0 position-absolute p-0" style="left:250px">
        <!-- Card Table -->
        <div class="card" style="width:1050px">
            <div class="card-body">
                <?php
                    include "../dbConfig.php";
                    $dataMaterial = $conn->query("SELECT * FROM TB_PengajuanSourcing WHERE id='{$_GET['id']}' AND feedbackRPIC=1")->fetchAll();
                ?>
                <form action="controller/actionUpdateMaterial.php" method="POST" class="was-validated" id="formEditMaterial<?php echo $row['id']?>">
                    <!-- Get ID -->
                    <input type="hidden" name="id" value="<?php echo !empty($dataMaterial[0]['id'])? $dataMaterial[0]['id']:'';?>">
                    <!-- Material Category -->
                    <label class="form-label fw-bold">Material Category</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" <?php echo $dataMaterial[0]['materialCategory']=="API"? 'checked' :''; ?> required>
                                <label class="form-check-label" for="api">API</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak" <?php echo $dataMaterial[0]['materialCategory']=="Ekstrak"? 'checked' :''; ?> >
                                <label class="form-check-label" for="ekstrak">Ekstrak</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient" <?php echo $dataMaterial[0]['materialCategory']=="Excipient"? 'checked' :''; ?> >
                                <label class="form-check-label" for="excipient">Excipient</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor" <?php echo $dataMaterial[0]['materialCategory']=="Narkotik, Psikotropik & Prekursor"? 'checked' :''; ?> >
                                <label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging" <?php echo $dataMaterial[0]['materialCategory']=="Packaging"? 'checked' :''; ?> >
                                <label class="form-check-label" for="packaging">Packaging</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate" <?php echo $dataMaterial[0]['materialCategory']=="Intermediate"? 'checked' :''; ?> >
                                <label class="form-check-label" for="intermediate">Intermediate</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? 'checked' :''; ?> >
                                <label class="form-check-label" for="rapidTest">Rapid Test</label>
                            </div>
                        </div>
                    </div>

                    <hr class="m-0">

                    <div class="row">
                        <div class="col m-0 mt-1">
                            <!-- Material Deskripsi -->
                            <div class="mb-3">
                                <label for="materialName" class="form-label fw-bold">Material Deskripsi</label>
                                <textarea class="form-control form-control-sm" id="materialName" rows="3" name="materialName" required><?php echo !empty($dataMaterial[0]['materialName'])? $dataMaterial[0]['materialName']:''; ?></textarea>
                                <div class="invalid-feedback">
                                    Masukan Material Deskripsi (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">   
                            <!-- Material Spesification -->
                            <div class="mb-3">
                            <label for="materialSpesification" class="form-label fw-bold">Material Spesification</label>
                            <textarea class="form-control form-control-sm" id="materialSpesification" rows="3" name="materialSpesification" required><?php echo !empty($dataMaterial[0]['materialSpesification'])? $dataMaterial[0]['materialSpesification']:''; ?></textarea>
                            <div class="invalid-feedback">
                                Masukan Material Spesification (*Tandai (-) jika tidak Diisi).
                            </div>
                        </div>
                    </div>
                    
                    <hr class="m-0">

                    <div class="row">
                        <div class="col m-0 mt-1">
                            <!-- Priority -->
                            <div class="mb-3">
                                <label for="priority" class="form-label fw-bold">Priority</label>
                                <input type="number" class="form-control form-control-sm" id="priority" name="priority" required value="<?php echo !empty($dataMaterial[0]['priority'])? $dataMaterial[0]['priority']:'';?>">
                                <div class="invalid-feedback">
                                    Masukan Priority (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">
                            <!-- Finish Dossage Form -->
                            <div class="mb-3">
                                <label for="finishDossageForm" class="form-label fw-bold">Finish Dossage Form</label>
                                <input type="text" class="form-control form-control-sm" id="finishDossageForm" name="finishDossageForm" required value="<?php echo !empty($dataMaterial[0]['finishDossageForm'])? $dataMaterial[0]['finishDossageForm']:''; ?>">
                                <div class="invalid-feedback">
                                    Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">
                            <!-- Vendor Terdaftar AERO -->
                            <div class="mb-3">
                                <label for="vendor" class="form-label fw-bold">Vendor Terdaftar AERO</label>
                                <input type="text" class="form-control form-control-sm" id="vendor" name="vendor" required value="<?php echo !empty($dataMaterial[0]['vendor'])? $dataMaterial[0]['vendor']:'';?>">
                                <div class="invalid-feedback">
                                    Masukan Vendor Terdaftar AERO (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">
                            <!-- Document Requirement -->
                            <div class="mb-3">
                                <label for="documentReq" class="form-label fw-bold">Document Requirement</label>
                                <input type="text" class="form-control form-control-sm" id="documentReq" name="documentReq" required value="<?php echo !empty($dataMaterial[0]['documentReq'])? $dataMaterial[0]['documentReq']:'';?>">
                                <div class="invalid-feedback">
                                    Masukan Document Requirement (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="m-0">

                    <div class="row">
                        <div class="col m-0 mt-1">
                            <!-- Catalog Or CAS Number -->
                            <div class="mb-3">
                                <label for="catalogOrCasNumber" class="form-label fw-bold">Catalog Or CAS Number</label>
                                <input type="text" class="form-control form-control-sm" id="catalogOrCasNumber" name="catalogOrCasNumber" required value="<?php echo !empty($dataMaterial[0]['catalogOrCasNumber'])? $dataMaterial[0]['catalogOrCasNumber']:'';?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test" || $dataMaterial[0]['materialCategory']=="Intermediate" ? '' :'disabled'; ?>>
                                <div class="invalid-feedback">
                                    Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">
                            <!-- Company< -->
                            <div class="mb-3">
                                <label for="company" class="form-label fw-bold">Company</label>
                                <input type="text" class="form-control form-control-sm" id="company" name="company" required value="<?php echo !empty($dataMaterial[0]['company'])? $dataMaterial[0]['company']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                                <div class="invalid-feedback">
                                    Masukan Company Produk (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                        <div class="col m-0 mt-1">
                            <!-- Website -->
                            <div class="mb-3">
                                <label for="website" class="form-label fw-bold">Website</label>
                                <input type="text" class="form-control form-control-sm" id="website" name="website" required value="<?php echo !empty($dataMaterial[0]['website'])? $dataMaterial[0]['website']:''; ?>" <?php echo $dataMaterial[0]['materialCategory']=="Rapid Test"? '' :'disabled'; ?>>
                                <div class="invalid-feedback">
                                    Masukan Website Produk (*Tandai (-) jika tidak Diisi).
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="m-0">

                    <!-- Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                        <textarea class="form-control form-control-sm" id="keterangan" rows="3" name="keterangan" required><?php echo !empty($dataMaterial[0]['keterangan'])? $dataMaterial[0]['keterangan']:''; ?></textarea>
                        <div class="invalid-feedback">
                            Masukan Keterangan Material (*Tandai (-) jika tidak Diisi).
                        </div>
                    </div>
                    <button class="btn btn-warning btn-sm">
                        Edit Material
                    </button>
                </form>

                <hr>
                <hr>

                <!-- Button trigger modal -->
                <div class="text-center">
                    <button type="button" style="width:150px" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
                    Tambah Supplier
                    </button>
                </div>
                <?php include "../formAddSupplier.php"?>
                <!-- Tabel Supplier -->
                <table id="table-supplier" class="pt-2 table table-striped">
                    <thead class="bg-warning">
                        <tr>
                            <th style="font-size:13px;width:10px" class="text-center">No</th>
                            <th style="font-size:13px;width:180px" class="text-center">Supplier</th>
                            <th style="font-size:13px;width:180px" class="text-center">Manufacture</th>
                            <th style="font-size:13px;width:180px" class="text-center">Origin Country</th>
                            <th style="font-size:13px;width:180px" class="text-center">Lead Time</th>
                            <th style="font-size:13px;width:250px" class="text-center">
                                <div class="container">
                                    <div class="row d-flex justify-content-center">Information MoQ, UoM, Price</div>
                                    <div class="row">
                                        <div class="col">MoQ</div>
                                        <div class="col">UoM</div>
                                        <div class="col">Price</div>
                                        <div class="col">Action</div>
                                    </div>
                                </div>
                            </th>
                            <th style="font-size:13px;width:180px" class="text-center">Catalog or CAS Number</th>
                            <th style="font-size:13px;width:180px" class="text-center">Grade/Reference</th>
                            <th style="font-size:13px;width:180px" class="text-center">Document Info</th>
                            <th style="font-size:13px;width:250px" class="text-center">Feedback Doc Req</th>
                            <th style="font-size:13px;width:250px" class="text-center">Feedback R&D</th>
                            <th style="font-size:13px;width:250px" class="text-center">Feedback Proc</th>
                            <th style="font-size:13px;width:250px" class="text-center">Final Feedback R&D</th>
                            <th style="font-size:13px;width:90px" class="text-center">Action Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial='{$dataMaterial[0]['id']}'")->fetchAll();
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
                                    <div class="overflow-auto" style="height:110px">
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
                                                    <td class="text-center p-0" style="font-size:12px;width:60px">
                                                        <a class="btn btn-danger btn-sm d-inline ms-1" style="width:100%" id="delete" onclick="deleteDetail(<?php echo $detail['id']?>)">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- -- -->
                                </td>
                                <!-- Column Catalog Or Cas Number -->
                                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                                <!-- Column Grade Or Reference -->
                                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['gradeOrReference']?></div></td>
                                <!-- Column Document Info -->
                                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['documentInfo']?></div></td>
                                <!-- Column Feedback Requirement Document -->
                                <td style="font-size:12px">
                                    <?php 
                                        $feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll();
                                    ?>
                                    <div style="height:114px">
                                        <div class="row" style="padding-top:30px">
                                            <div class="col">
                                                <!-- Feedback Doc Req CoA -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        CoA
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['CoA']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['CoA']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                                <!-- Feedback Doc Req MSDS -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        MSDS
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['MSDS']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['MSDS']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                                <!-- Feedback Doc Req MoA -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        MoA
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['MoA']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['MoA']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <!-- Feedback Doc Req Halal -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        Halal
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['Halal']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['Halal']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                                <!-- Feedback Doc Req DMF -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        DMF
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['DMF']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['DMF']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                                <!-- Feedback Doc Req GMP -->
                                                <div class="row">
                                                    <div class="col fw-bold">
                                                        GMP
                                                    </div>
                                                    <div class="col">
                                                        <div class="bg-success m-0 text-center text-white <?php echo $feedbackDocReq[0]['GMP']=="ok"? '' :'d-none'; ?> border" style="width:55px">OK</div>
                                                        <div class="bg-danger m-0 text-center text-white <?php echo $feedbackDocReq[0]['GMP']=="notOk"? '' :'d-none'; ?> border" style="width:55px">NOT OK</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Action Feedback Doc Req -->
                                    <div>
                                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackDocReq<?php echo $row['id']?>">
                                            <div style="font-size:11px">FeedbackDocReq</div>
                                        </button>
                                        <?php include "component/modalFeedbackDocReq.php"?>
                                    </div>
                                    <!-- -- -->
                                </td>
                                <!-- Column Feedback Rnd -->
                                <td>
                                    <div class="overflow-auto" style="height:110px">
                                        <!-- Title Review Harga-->
                                        <div class="fw-bold" style="font-size:13px;">
                                            Review Harga:
                                        </div>
                                        <!-- Isi Feedback Rnd Review Harga -->
                                        <div style="font-size:13px;">
                                            <?php echo !empty($row['feedbackRndPriceReview'])?$row['feedbackRndPriceReview']:'-'?>
                                        </div> 
                                        <!-- Title Sampel dan Lainnya-->
                                        <div class="fw-bold" style="font-size:13px;">
                                                Sampel dan lainnya:
                                        </div>
                                        <!-- Isi Detail Feedback Rnd-->
                                        <?php
                                            $feedbackRnd = $conn->query("SELECT TOP 1 * FROM TB_DetailFeedbackRnd WHERE idSupplier='{$row['id']}' ORDER BY ID DESC")->fetchAll();
                                        ?>
                                        <div>
                                            <div class="text-success p-0" style="width:85px;font-size:11px"><?php echo $feedbackRnd[0]['dateFeedback']?></div>
                                            <div class="text-wrap p-0" style="font-size:12px;"><?php echo $feedbackRnd[0]['sampel']?></div>
                                            <div class="fw-bold p-0" style="font-size:9px"><?php echo !empty($feedbackRnd[0]['writer'])? 'By: '.$feedbackRnd[0]['writer']:'-'; ?></div>
                                        </div>
                                    </div>
                                    <!-- Action Feedback Rnd -->
                                    <div>
                                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackRnd<?php echo $row['id']?>">
                                            <div style="font-size:11px">Sampel dan lainnya</div>
                                        </button>
                                        <?php include "component/modalFeedbackRnd.php"?>
                                    </div>
                                </td>
                                <!-- Column Feedback Proc -->
                                <td>
                                    <?php
                                        $feedbackProc = $conn->query("SELECT TOP 1 * FROM TB_FeedbackProc WHERE idSupplier='{$row['id']}' ORDER BY ID DESC")->fetchAll();
                                    ?>
                                    <div class="overflow-auto" style="height:110px">
                                        <!-- Isi Feedback Proc -->
                                        <div style="height:70px">
                                            <div class="p-0">
                                                <div class="text-success" style="width:85px;font-size:11px"><?php echo $feedbackProc[0]['dateFeedbackProc']?></div>
                                                <div class="text-wrap" style="font-size:12px"><?php echo $feedbackProc[0]['feedback']?></div>
                                                <div class="fw-bold" style="font-size:9px"><?php echo !empty($feedbackProc[0]['writer'])? 'By: '.$feedbackProc[0]['writer']:'-'; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Action Feedback Proc -->
                                    <div>
                                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackProc<?php echo $row['id']?>">
                                            <div style="font-size:11px">Feedback Proc</div>
                                        </button>
                                        <?php include "component/modalFeedbackProc.php"?>
                                    </div>
                                </td>
                                <!-- Column Final Feedback Rnd -->
                                <td>
                                    <div class="overflow-auto" style="height:110px">
                                        <!-- Isi Final Feedback Rnd -->
                                        <div style="height:70px">
                                            <div class="p-0">
                                                <div class="text-success ps-0" style="width:85px;font-size:11px"><?php echo $row['dateFinalFeedbackRnd']?></div>
                                                <div class="text-wrap" style="font-size:12px"><?php echo !empty($row['finalFeedbackRnd'])? $row['finalFeedbackRnd']:'-'; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Action Final Feedback Rnd -->
                                    <div>
                                        <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#finalFeedbackRnd<?php echo $row['id']?>">
                                            <div style="font-size:12px">Final Feedback Rnd</div>
                                        </button>
                                        <?php include "component/modalFinalFeedbackRnd.php"?>
                                    </div>
                                </td>
                                <!-- Column Action -->
                                <td>
                                    <!-- Edit Supplier -->
                                    <button type="button" class="btn btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editSupplier<?php echo $row['id']?>">
                                        <div style="font-size:13px">Edit Supplier</div>
                                    </button>
                                    <?php include "component/formUpdateSupplier.php"?>
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
        $(document).ready(function(){
            var materialTable = $('#table-supplier').DataTable({
                scrollX: true,
                paging: true,
                ordering: false,
                info: false,
            })
        })
    </script>
    </body>
</html>