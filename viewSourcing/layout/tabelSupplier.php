<?php
    header('Location: ../index.php');
?>

<!-- Button tambah supplier -->
<div class="text-center">
    <button type="button" style="width:150px" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
        Tambah Supplier
    </button>
</div>
<?php include "../../component/modal/addSupplier.php"?>  
                
<table id="table-supplier" class="pt-2 table table-striped">
    <thead>
        <tr>
            <th style="font-size:13px;width:10px" class="text-center">No</th>
            <th style="font-size:13px;width:180px" class="text-center">Supplier</th>
            <th style="font-size:13px;width:180px" class="text-center">Manufacture</th>
            <th style="font-size:13px;width:180px" class="text-center">Origin Country</th>
            <th style="font-size:13px;width:180px" class="text-center">Lead Time</th>
            <th style="font-size:13px;width:250px" class="text-center">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        Information MoQ, UoM, Price
                    </div>
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
            <th style="font-size:13px;width:180px" class="text-center">Document</th>
            <th style="font-size:13px;width:250px" class="text-center">Feedback Doc Req</th>
            <th style="font-size:13px;width:250px" class="text-center">Feedback R&D</th>
            <th style="font-size:13px;width:250px" class="text-center">Feedback Proc</th>
            <th style="font-size:13px;width:250px" class="text-center">Final Feedback R&D</th>
            <th style="font-size:13px;width:90px" class="text-center">Action Supplier</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include "../../dbConfig.php";
            ${'no'. $_GET['idMaterial']} = 1;
            if(!empty($_GET['idMaterial'])&&!empty($_GET['idSupplier'])){
                $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE id=".$_GET['idSupplier'])->fetchAll();
            }else {
                $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial=".$_GET['idMaterial']."ORDER BY id DESC")->fetchAll();
            }
            foreach($dataSupplier as $row){
        ?>
        <tr>
            <!-- Column Nomer -->
            <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo ${'no'. $_GET['idMaterial']}++?></div></td>
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
                <?php include "../../component/modal/addDetailSupplier.php"?>
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
                                <button type="button" class="btn btn-danger btn-sm d-inline ms-1" onclick="funcDeleteDetailInfo(<?php echo $detail['idDetailSupplier']?>, <?php echo $row['id']?>)">Delete</a>
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
            <!-- Column Document -->
            <td>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" style="width:80px" data-bs-target="#uploadDoc<?php echo $row['id']?>">
                            <div style="font-size:11px">Upload Doc</div>
                        </button>
                        <?php include "../../component/modal/uploadDoc.php"?>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" style="width:80px" data-bs-target="#viewDoc<?php echo $row['id']?>">
                            <div style="font-size:11px">View Doc</div>
                        </button>
                        <?php include "../../component/modal/viewDoc.php"?>
                    </div>
                </div>
            </td>
            <!-- Column Feedback Requirement Document -->
            <td>
                <?php 
                    $feedbackDocReq = $conn->query("SELECT * FROM TB_FeedbackDocReq WHERE idSupplier='{$row['id']}'")->fetchAll();
                ?>
                <div style="height:114px;font-size:12px">
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
                    <?php include "../../component/modal/feedbackDocReq.php"?>
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
                    <?php include "../../component/modal/feedbackRnd.php"?>
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
                    <?php 
                        include "../../component/modal/feedbackProc.php" ?>
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
                    <?php include "../../component/modal/finalFeedbackRnd.php"?>
                </div>
            </td>
            <!-- Column Action -->
            <td>
                <!-- Edit Supplier -->
                <button type="button" class="btn btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editSupplier<?php echo $row['id']?>">
                    <div style="font-size:13px">Edit Supplier</div>
                </button>
                <?php include "../../component/modal/updateSupplier.php"?>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var table = $('#table-supplier').DataTable({
            scrollX: true,
            paging:true,
            stateSave: true,
            deferRender: true,
            lengthMenu: [2],
        });
    })

    function funcAddSupplier(idMaterial){
            $.ajax({
                type: "POST",
                url: "../controller/actionAddSupplier.php",
                data: $('form#formAddSupplier'+idMaterial).serialize()+'&idMaterial='+idMaterial,
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#tambahSupplier<?php echo $_GET['idMaterial']?>').modal('hide');
    }

    function funcAddDetailSupplier(idSupplier){
            $.ajax({
                type: "POST",
                url: "../controller/actionUpdateSupplier.php",
                data: $('form#formAddDetail'+idSupplier).serialize()+'&id='+idSupplier+'&addDetail=true',
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#tambahDetailSupplier'+idSupplier).modal('hide');
    }

    function funcDeleteDetailInfo(idDetailSupplier, idSupplier){
        $.ajax({
            type: 'GET',
            url: '../controller/actionUpdateSupplier.php',
            data:{id: idDetailSupplier, actionType: "delete", idSupplier: idSupplier},
            dataType: 'json',
            success: function(response){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                loadDataSupplier(<?php echo $_GET['idMaterial']?>)
            }
        })
    }

    function funcUploadDoc(idSupplier){
            $.ajax({
                type:'POST',
                url: '../controller/actionHandlerFile.php',
                data: new FormData(document.getElementById("uploadFile"+idSupplier)),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#uploadDoc'+idSupplier).modal('hide');
    }

    function deleteFile(idFile, idSupplier){
        $.ajax({
            type: 'GET',
            url: '../controller/actionHandlerFile.php',
            data:{idFile: idFile, idSupplier: idSupplier, actionType: "delete"},
            dataType: 'json',
            success: function(response){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
            }
        })
        $('#viewDoc'+idSupplier).modal('hide');
    }

    function funcFeedbackDocReq(idSupplier){
            $.ajax({
                type: "POST",
                url: "../controller/actionFeedback.php",
                data: $('form#formFeedbackDocReq'+idSupplier).serialize()+'&feedbackDocReq=true&idSupplier='+idSupplier,
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#feedbackDocReq'+idSupplier).modal('hide');
    }

    function funcFeedbackRnd(idSupplier){
        $.ajax({
                type: "POST",
                url: "../controller/actionFeedback.php",
                data: $('form#formFeedbackRnd'+idSupplier).serialize()+'&feedbackRnd=true&idSupplier='+idSupplier,
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })


                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#feedbackRnd'+idSupplier).modal('hide');
    }

    function funcFeedbackProc(idSupplier){
        $.ajax({
                type: "POST",
                url: "../controller/actionFeedback.php",
                data: $('form#formFeedbackProc'+idSupplier).serialize()+'&feedbackProc=true&idSupplier='+idSupplier,
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#feedbackProc'+idSupplier).modal('hide');
    }

    function funcFinalFeedbackRnd(idSupplier){
        $.ajax({
                type: "POST",
                url: "../controller/actionFeedback.php",
                data: $('form#formFinalFeedbackRnd'+idSupplier).serialize()+'&formFinalFeedbackRnd=true&idSupplier='+idSupplier,
                dataType: 'json',
                success: function(response){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                    loadDataSupplier(<?php echo $_GET['idMaterial']?>)
                }
            })
            $('#finalFeedbackRnd'+idSupplier).modal('hide');
    }

    function funcUpdateSupplier(idSupplier){
        $.ajax({
            url: '../controller/actionUpdateSupplier.php',
            method: 'POST',
            data: $('form#formUpdateSupplier'+idSupplier).serialize(),
            dataType: 'json',
            success: function(response){
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: response.status == 0?'success':'warning',
                        title: response.message
                    })

                loadDataSupplier(<?php echo $_GET['idMaterial']?>)
            }
        })
        $('#editSupplier'+idSupplier).modal('hide');
    }
</script>