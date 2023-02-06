<?php
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
<?php include "../../component/modal/addSupplier.php"?>  
                
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
                    data: null
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
                    data: null
                },
                {
                    data: null
                },
                {
                    data: "doc-MoA"
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