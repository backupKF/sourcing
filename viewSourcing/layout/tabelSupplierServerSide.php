<?php
    include "../../dbConfig.php";

    // Ketika tidak ada data get yang masuk maka akan me-redirect kehalaman index
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>

<style>
    table.dataTable thead>tr>th.sorting, 
    table.dataTable thead>tr>th.sorting_asc, 
    table.dataTable thead>tr>th.sorting_desc, 
    table.dataTable thead>tr>th.sorting_asc_disabled, 
    table.dataTable thead>tr>th.sorting_desc_disabled, 
    table.dataTable thead>tr>td.sorting, 
    table.dataTable thead>tr>td.sorting_asc, 
    table.dataTable thead>tr>td.sorting_desc, 
    table.dataTable thead>tr>td.sorting_asc_disabled, 
    table.dataTable thead>tr>td.sorting_desc_disabled {
        cursor: pointer;
        position: sticky;
        padding-right: 26px;
    }
    table .sticky-column-supplier {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }
    table  {

    }
</style>

<!-- Button tambah supplier -->
<div>
    <button type="button" style="width:150px" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
        Tambah Supplier
    </button>
</div>
<?php include "../../component/modal/client-side/addSupplier.php"?>  
                
<!-- Tabel Supplier -->
<table id="table-supplier" class="pt-2 table table-striped">
    <thead class="bg-warning">
        <tr>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px" class="sticky-column-supplier bg-warning">Supplier</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Manufacture</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Origin Country</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Lead Time</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:250px" class="text-center">
                <div class="row d-flex justify-content-center">
                    Information MoQ, UoM, Price
                </div>
                <div class="row text-center">
                    <div class="col">MoQ</div>
                    <div class="col">UoM</div>
                    <div class="col">Price</div>
                    <div class="col">Action</div>
                </div>
            </th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Catalog or CAS Number</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Grade/Reference</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Document Info</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:180px">Document</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:250px">Feedback Doc Req</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:250px">Feedback R&D</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:250px">Feedback Proc</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:250px">Final Feedback R&D</th>
            <th style="font-size:13px;font-family:poppinsSemiBold;width:90px">Action Supplier</th>
        </tr>
    </thead>
</table>

<script>
    $(document).ready(function() {
        var table = $('#table-supplier').DataTable({
            scrollX: true,
            paging:true,
            stateSave: true,
            lengthMenu: [2 , 3],
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataSupplier.php',
                type: 'GET',
                data:{
                    idMaterial: <?php echo $_GET['idMaterial']?>
                }
            },
            columns: [
                {
                    data: 'supplier'
                },
                {
                    data: 'manufacture'
                },
                {
                    data: 'originCountry'
                },
                {
                    data: 'leadTime'
                },
                {
                    data: function(dataSupplier){
                        return (
                            '<!-- Button Modal Tambah Informasi MoQ, UoM, dan Price -->'+
                            '<button type="button" class="btn btn-default p-0" style="width:30px" data-bs-toggle="modal" data-bs-target="#tambahDetailSupplier'+dataSupplier.id+'">'+
                                '<svg style="width:24px;height:24px" viewBox="0 0 24 24">'+
                                    '<path fill="currentColor" d="M17,18V5H7V18L12,15.82L17,18M17,3A2,2 0 0,1 19,5V21L12,18L5,21V5C5,3.89 5.9,3 7,3H17M11,7H13V9H15V11H13V13H11V11H9V9H11V7Z" />'+
                                '</svg>'+   
                            '</button>'+
                            '<!-- -- -->'+

                            '<!-- Modal Tambah Informasi MoQ, UoM, dan Price -->'+
                            <?php include "../../component/modal/server-side/addDetailSupplier.php"?>
                            '<!-- -- -->'+


                            '<!-- Tabel Informasi MoQ, UoM, dan Price -->'+
                            '<div class="overflow-auto" style="height:110px">'+
                                '<!-- Tabel MoQ UoM Price -->'+
                                '<table class="table table-bordered">'+
                                    '<tbody class="content-DetailSupplier">'+
                                        dataSupplier.outputDetailSupplier +
                                    '</tbody>'+
                                '</table>'+
                           '</div>'+
                            '<!-- -- -->'
                        )
                    }
                },
                {
                    data: 'catalogOrCasNumber'
                },
                {
                    data: 'gradeOrReference'
                },
                {
                    data: 'documentInfo'
                },
                {
                    data: null
                },
                {
                    data: function(dataSupplier){
                        return (
                            '<!-- Content Layout -->'+
                            '<div style="height:114px;font-size:12px;font-family:poppinsSemiBold">'+
                                '<div class="row" style="padding-top:30px">'+
                                    '<div class="col">'+
                                        '<!-- Feedback Doc Req CoA -->'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'CoA'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docCoA == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docCoA == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<!-- Feedback Doc Req MSDS -->'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'MSDS'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docMSDS == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docMSDS == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<!-- Feedback Doc Req MoA -->'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'MoA'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docMoA == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docMoA == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<!-- Feedback Doc Req Halal -->'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'Halal'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docHalal == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docHalal == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<!-- Feedback Doc Req DMF -->'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'DMF'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docDMF == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docDMF == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                'GMP'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="bg-success m-0 text-center text-white '+ (dataSupplier.docGMP == "ok" ? "":"d-none") +' border" style="width:55px">OK</div>'+
                                                '<div class="bg-danger m-0 text-center text-white '+ (dataSupplier.docGMP == "notOk" ? "":"d-none") +' border" style="width:55px">NOT OK</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+

                            '<!-- Action Feedback Doc Req -->'+
                            '<div>'+
                                '<button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackDocReq'+dataSupplier.id+'">'+
                                    '<div style="font-size:11px">FeedbackDocReq</div>'+
                                '</button>'+
                                <?php include "../../component/modal/server-side/feedbackDocReq.php"?>
                            '</div>'+
                            '<!-- -- -->'
                        )
                    }
                },
                {
                    data: function(dataSupplier){
                        return (
                            '<!-- Tanggal Feedback -->'+
                            '<div class="bg-success bg-opacity-75 y p-0" style="width:110px;font-size:11px;font-family:poppinsBold;">Date: '+dataSupplier.dateFeedbackRnd+'</div>'+
                            '<!-- Layout Content -->'+
                            '<div class="overflow-auto" style="height:82px;font-size:12px;font-family:poppinsSemiBold;">'+
                                '<!-- Title Review Harga-->'+
                                '<div>'+
                                    '> Review Harga:'+
                                '</div>'+
                                '<!-- Isi Feedback Rnd Review Harga -->'+
                                '<div style="font-family:poppinsMedium;font-size:11px">'+
                                    (dataSupplier.feedbackRndPriceReview != "" ? dataSupplier.feedbackRndPriceReview : "-") +
                                '</div>'+
                                '<!-- Title Sampel dan Lainnya-->'+
                                '<div>'+
                                    '> Sampel dan lainnya:'+
                                '</div>'+
                                '<!-- Isi Sampel/Feedback-->'+
                                '<div class="text-wrap pt-1" style="font-size:11px;font-family:poppinsMedium;">'+(dataSupplier.sampelFeedbackRnd != "" ? dataSupplier.sampelFeedbackRnd : "-")+'</div>'+
                            '</div>'+
                            '<!-- Penulis -->'+
                            '<div style="font-size:10px;font-family:poppinsBold;">'+(dataSupplier.writerFeedbackRnd != "" ? "By: "+dataSupplier.writerFeedbackRnd : "")+'</div>'+

                            '<!-- Action Feedback Rnd -->'+
                            '<div>'+
                                '<button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackRnd'+dataSupplier.id+'">'+
                                    '<div style="font-size:11px">Sampel dan lainnya</div>'+
                                '</button>'+
                                <?php include "../../component/modal/server-side/feedbackRnd.php"?>
                            '</div>'
                        )
                    }
                },
                {
                    data: function(dataSupplier){
                        return (
                            '<!-- Tanggal Feedback Proc -->'+
                            '<div class="bg-success bg-opacity-75" style="width:110px;font-size:11px;font-family:poppinsBold;">Date: '+dataSupplier.dateFeedbackProc+'</div>'+
                            '<!-- Isi Feedback Proc -->'+
                            '<div class="overflow-auto" style="height:80px">'+
                                '<div class="text-wrap p-1" style="font-size:11px;font-family:poppinsMedium;">'+dataSupplier.feedbackProc+'</div>'+
                            '</div>'+
                            '<!-- Penulis -->'+
                            '<div style="font-size:10px;font-family:poppinsBold;">'+(dataSupplier.writerFeedbackProc != "" ? "By: "+dataSupplier.writerFeedbackProc : "")+'</div>'+
                            '<!-- Action Feedback Proc -->'+

                            '<!-- Action Feedback Proc -->'+
                            '<div>'+
                                '<button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#feedbackProc'+dataSupplier.id+'">'+
                                    '<div style="font-size:11px">Feedback Proc</div>'+
                                '</button>'+
                                <?php include "../../component/modal/server-side/feedbackProc.php"?>
                            '</div>'
                        )
                    }
                },
                {
                    data: null
                },
                {
                    data: null
                },
            ]

        });

        // CSS Tabel
        $('.dataTables_filter input[type="search"]').css(
            {
                'height':'25px',
                'font-family':'poppinsRegular',
                'display':'inline-block'
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
    })

    // Send data to Action Add Supplier for Add Supplier
    function funcAddSupplier(idMaterial){
        $.ajax({
            type: "POST",
            url: "../controller/actionAddSupplier.php",
            data: $('form#formAddSupplier'+idMaterial).serialize()+'&idMaterial='+idMaterial+'&addSupplier=true',
            dataType: 'json',
            success: function(response){
                if(response.status == 1){
                    $("#errorSupplier").text("");
                    $("#errorSupplier").append(response.message);

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

                }else{
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
                    $('#tambahSupplier<?php echo $_GET['idMaterial']?>').modal('hide');
                }
            }
        })
    }

    function funcSetNewVendor(idForm, formName){
        if(formName == "formSetNewVendorAddSupplier"){
            $.ajax({
                type: "POST",
                url: "../controller/actionAddSupplier.php",
                data: $('form#formSetNewVendorAddSupplier'+idForm).serialize(),
                dataType: 'json',
                success: function(response){
                    $("#errorSupplier").text("");

                    $('#modalSetVendorAddSupplier'+idForm).modal('hide');

                    $("#tambahSupplier"+idForm+" input#vendorInputAddSupplier").attr("value", response);

                    $('#tambahSupplier'+idForm).modal('show');
                }
            })
        }
        if(formName == "formSetNewVendorUpdateSupplier"){
            $.ajax({
                type: "POST",
                url: "../controller/actionAddSupplier.php",
                data: $('form#formSetNewVendorUpdateSupplier'+idForm).serialize(),
                dataType: 'json',
                success: function(response){
                    $("#errorSupplier").text("");

                    $('#modalSetVendorUpdateSupplier'+idForm).modal('hide');

                    $("#editSupplier"+idForm+" input#vendorInputUpdateSupplier").attr("value", response);

                    $('#editSupplier'+idForm).modal('show');
                }
            })
        }
    }

    function funcSetVendor(idForm, vendorName, formName){
        if(formName == "formSetVendorAddSupplier"){
            $.ajax({
                type: "POST",
                url: "../controller/actionAddSupplier.php",
                data: {setVendor: vendorName},
                dataType: 'json',
                success: function(response){
                    $("#errorSupplier").text("");

                    $('#modalSetVendorAddSupplier'+idForm).modal('hide');

                    $("#tambahSupplier"+idForm+" input#vendorInputAddSupplier").attr("value", response);

                    $('#tambahSupplier'+idForm).modal('show');
                }
            })
        }

        if(formName == "formSetVendorUpdateSupplier"){
            $.ajax({
                type: "POST",
                url: "../controller/actionAddSupplier.php",
                data: {setVendor: vendorName},
                dataType: 'json',
                success: function(response){
                    $("#errorSupplier").text("");

                    $('#modalSetVendorUpdateSupplier'+idForm).modal('hide');

                    $("#editSupplier"+idForm+" input#vendorInputUpdateSupplier").attr("value", response);

                    $('#editSupplier'+idForm).modal('show');
                }
            })
        }
    }
    
    // Send data to Action Update Supplier for Add Detail Supplier
    function funcAddDetailSupplier(idSupplier){
        // Check Submit
        $("form#formAddDetail"+idSupplier).submit(function(e){
            e.preventDefault();
            // actual logic, e.g. validate the form
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
        })
    }

    // Send data to Action Update Supplier for Delete Detail Supplier
    function funcDeleteDetailInfo(idDetailSupplier, idSupplier){
        Swal.fire({
            title: 'Apakah anda yakin untuk detail MoU, UoM, Price?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '../controller/actionUpdateSupplier.php',
                    data:{idDetailSupplier: idDetailSupplier, actionType: "delete", idSupplier: idSupplier},
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
        })
    }

    // Send data to Action Update Supplier for Upload Document
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

    // Send data to Action Update Supplier for Delete File
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

    // Send data to Action Update Supplier for feedback doc req
    function funcFeedbackDocReq(idSupplier){
        // Check Submit
        $("form#formFeedbackDocReq"+idSupplier).submit(function(e){
            e.preventDefault();
            // actual logic, e.g. validate the form
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
        })
    }

    // Send data to Action Update Supplier for feedback rnd
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

    // Send data to Action Update Supplier for feedback proc
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

    // Send data to Action Update Supplier for final feedback rnd
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

    // Send data to Action Update Supplier for update Supplier
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