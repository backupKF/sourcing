<?php
    session_start();

    // Jika tidak ada data GET maka akan me-redirect ke halaman index
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>

<style>
    /* CSS Tabel Riwayat */
    th{
        font-size:12px;
        font-family:poppinsBold;
    }
    td {
        font-size:12px;
        font-family:poppinsMedium;
    }
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
    table .sticky-column-materialName {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }

    /* CSS Modal View Material */
    h5{
        font-size:18px;
        font-family:'poppinsSemiBold';
    }
    p{
        font-size:14px;
        font-family:'poppinsRegular';
    }
</style>

<div class="card shadow bg-body rounded">
    <div class="card-body">
        <div class="text-center mb-2" style="font-family:poppinsBlack;font-size:25px">Tabel Riwayat</div>
        <table id="table-riwayat" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width:150px">Sourcing Number</th>
                    <th scope="col" style="width:150px">Material Name</th>
                    <th scope="col" style="width:90px">Date Sourcing</th>
                    <th scope="col" style="width:100px">Project Code</th>
                    <th scope="col" style="width:120px">Project Name</th>
                    <th scope="col" style="width:90px">Team Leader</th>
                    <th scope="col" style="width:90px">Researcher</th>
                    <th scope="col" style="width:100px">Feedback TL</th>
                    <th scope="col" style="width:100px">Feedback RPIC</th>
                    <th scope="col" style="width:120px">Date Approved TL</th>
                    <th scope="col" style="width:125px">Date Accepted RPIC</th>
                    <th scope="col" style="width:90px">Status</th>
                    <th scope="col" style="width:180px">Action Material</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col" style="width:150px">Sourcing Number</th>
                    <th scope="col" style="width:150px">Material Name</th>
                    <th scope="col" style="width:90px">Date Sourcing</th>
                    <th scope="col" style="width:100px">Project Code</th>
                    <th scope="col" style="width:120px">Project Name</th>
                    <th scope="col" style="width:90px">Team Leader</th>
                    <th scope="col" style="width:90px">Researcher</th>
                    <th scope="col" style="width:100px">Feedback TL</th>
                    <th scope="col" style="width:100px">Feedback RPIC</th>
                    <th scope="col" style="width:120px">Date Approved TL</th>
                    <th scope="col" style="width:125px">Date Accepted RPIC</th>
                    <th scope="col" style="width:90px">Status</th>
                    <th scope="col" style="width:180px">Action Material</th>
                </tr>
            </tfoot>
        </table>
        <?php
            if(isset($_GET['rs'])){
        ?>
                <a class="btn btn-danger" href="index.php">Back</a>
        <?php
            }
        ?>
    
    </div>
</div>

<script>
    $(document).ready(function() {
        // Datatable tabel riwayat
        var tableRiwayat = $('#table-riwayat').DataTable({
            paging: true,
            scrollX: true,
            scrollY: '410px',
            scrollCollapse: true,
            stateSave: true,
        <?php
            if(empty($_GET['sn']) && empty($_GET['idMaterial'])){
        ?>
            stateSave: true,
        <?php
            }
            if(!empty($_GET['sn']) && empty($_GET['idMaterial'])){
        ?>
            stateSave: false,
        <?php
            }
            if(!empty($_GET['sn']) && !empty($_GET['idMaterial'])){
        ?>
            stateSave: false,
        <?php
            }
        ?>
            lengthMenu: [5 , 10, 15],
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataSourcingRiwayat.php',
                type: 'GET',
                dataType: 'json'
        <?php
            if(!empty($_GET['sn']) && empty($_GET['idMaterial'])){
        ?>
                data: {sn: <?php echo $_GET['sn']?>},
        <?php
            }

            if(!empty($_GET['sn']) && !empty($_GET['idMaterial'])){
        ?>
                data: {sn: <?php echo $_GET['sn']?>, idMaterial: <?php echo $_GET['idMaterial']?>},
        <?php 
            }
        ?>
            },
            columns: [
                {
                    data: 'sourcingNumber'
                },
                {
                    class: 'sticky-column-materialName',
                    data: 'materialName'
                },
                {
                    data: 'dateSourcing'
                },
                {
                    data: 'projectCode'
                },
                {
                    data: 'projectName'
                },
                {
                    data: 'teamLeader'
                },
                {
                    data: 'researcher'
                },
                {
                    data: function(data){
                        if(<?php echo $_SESSION['user']['level']?> == 2 && data.feedbackTL == 0){
                            return (
                                '<form onclick="funcFeedbackTL('+data.id+', `'+data.materialName+'`, '+data.sourcingNumber+')" id="formFeedbackTL_'+data.id+'">'+
                                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackTL">'+
                                        '<option selected>NO STATUS</option>'+
                                        '<option value=1>APPROVED</option>'+
                                    '</select>'+
                                '</form>'
                            )
                        }else if(<?php echo $_SESSION['user']['level']?> != 2  && data.feedbackTL == 0){
                            return '<span class="badge text-dark text-center bg-danger bg-opacity-75" style="font-size:12px;font-family:poppinsBlack;width:90px">NO STATUS</span>'
                        }else{
                            return '<span class="badge text-dark text-center bg-success bg-opacity-75" style="font-size:12px;font-family:poppinsBlack;width:90px">APPROVED</span>'
                        }
                    }
                },
                {
                    data: function(data){
                        if(<?php echo $_SESSION['user']['level']?> == 1 && data.feedbackRPIC == 0 && data.feedbackTL == 1){
                            return (
                               ' <form onclick="funcFeedbackRPIC('+data.id+', `'+data.materialName+'`, '+data.sourcingNumber+')" id="formFeedbackRPIC_'+data.id+'">'+
                                 '   <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="feedbackRPIC">'+
                                        '<option selected>NO STATUS</option>'+
                                        '<option value=1>ACCEPTED</option>'+
                                    '</select>'+
                                '</form>'
                            )
                        }else if(<?php echo $_SESSION['user']['level']?> == 1  && data.feedbackRPIC == 0 && data.feedbackTL == 0){
                            return '<span class="badge text-dark text-center bg-danger bg-opacity-75" style="font-size:12px;font-family:poppinsBlack;width:90px">NO STATUS</span>'
                        }else if(<?php echo $_SESSION['user']['level']?> != 1  && data.feedbackRPIC == 0){
                            return '<span class="badge text-dark text-center bg-danger bg-opacity-75" style="font-size:12px;font-family:poppinsBlack;width:90px">NO STATUS</span>'
                        }else{
                            return '<span class="badge text-dark text-center bg-success bg-opacity-75" style="font-size:12px;font-family:poppinsBlack;width:90px">ACCEPTED</span>'
                        }
                    }
                },
                {
                    data: 'dateApprovedTL'
                },
                {
                    data: 'dateAcceptedRPIC'
                },
                {
                    data: function(data){
                        if(<?php echo $_SESSION['user']['level']?> == 1){
                            return (
                                '<form onclick="funcStatusRiwayat('+data.id+', `'+data.materialName+'`, '+data.sourcingNumber+')" id="formStatusRiwayat_'+data.id+'">'+
                                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" id="statusRiwayat">'+
                                        '<option '+ (data.statusRiwayat == "NO STATUS" ? "selected":"") +' value="">NO STATUS</option>'+
                                        '<option '+ (data.statusRiwayat == "ON PROCESS" ? "selected":"") +' value="ON PROCESS">ON PROCESS</option>'+
                                        '<option '+ (data.statusRiwayat == "HOLD" ? "selected":"") +' value="HOLD">HOLD</option>'+
                                        '<option '+ (data.statusRiwayat == "CANCEL" ? "selected":"") +' value="CANCEL">CANCEL</option>'+
                                   ' </select>'+
                               ' </form>'
                            )
                        }else{
                            return '<span class="badge text-dark '+ (data.statusRiwayat == "ON PROCESS" ? "bg-success": (data.statusRiwayat == "HOLD" ? "bg-warning":(data.statusRiwayat == "CANCEL" ? "bg-danger":""))) +'" style="font-size:12px;font-family:poppinsBlack;width:120px;'+ ( data.statusRiwayat == "NO STATUS" ? "background-color:#a1a1a1":"") +'">'+data.statusRiwayat+'</span>'
                        }
                    }
                },
                {
                    data: function(data){

                        if(data.feedbackTL != 1){
                            return (
                                // Button
                                '<div>'+
                                    '<div class="text-center">'+
                                        // Button Edit Material 
                                        '<button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial'+data.id+'" data-bs-toggle="modal">Edit</button>'+
                                        // Button View Material
                                        '<button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial'+data.id+'" data-bs-toggle="modal">View</button>'+
                                        // Jika user level == 1 
                                        <?php 
                                            if($_SESSION['user']['level'] == 1){ ?>  
                                            // Button Delete
                                            '<button class="btn btn-danger btn-sm d-inline ms-1" type="button" onclick="funcDeleteMaterial('+data.id+', `'+data.materialName+'`, '+data.sourcingNumber+')">Delete</a>'+
                                        <?php } ?>
                                    '</div>'+

                                    '<!-- Modal Update Material -->'+
                                    <?php include "../../component/modal/server-side/updateMaterialRiwayat.php"; ?>

                                    '<!-- Modal View Material -->'+
                                    <?php include "../../component/modal/server-side/viewMaterial.php"; ?>
                                '</div>'
                            ) 
                        }else{
                            return (
                                // Button
                                '<div>'+
                                    '<div class="text-center">'+
                                        // Button Edit Material 
                                        '<button class="btn btn-warning btn-sm d-inline ms-1" type="button" disabled>Edit</button>'+
                                        // Button View Material
                                        '<button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial'+data.id+'" data-bs-toggle="modal">View</button>'+
                                        // Jika user level == 1 
                                        <?php 
                                            if($_SESSION['user']['level'] == 1){ ?>  
                                            // Button Delete
                                            '<button class="btn btn-danger btn-sm d-inline ms-1" type="button" onclick="funcDeleteMaterial('+data.id+', `'+data.materialName+'`, '+data.sourcingNumber+')">Delete</a>'+
                                        <?php } ?>
                                    '</div>'+

                                    '<!-- Modal View Material -->'+
                                    <?php include "../../component/modal/server-side/viewMaterial.php"; ?>
                                '</div>'
                            )
                        }
                    }
                },
            ]
        })
        
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

    });

    // Set Format Form Update Material, if Material Category API
    function formatFormAPI(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Ekstrak
    function formatFormEkstrak(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Excipient
    function formatFormExcipient(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Nasipre
    function formatFormNasipre(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Packaging
    function formatFormPackaging(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Intermediate
    function formatFormIntermediate(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).removeAttr("disabled");
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).attr('disabled', 'disabled');
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).attr('disabled', 'disabled');
    }

    // Set Format Form Update Material, if Material Category Rapid Test
    function formatFormRapidTest(idMaterial){
        $("form#formEditMaterial"+idMaterial+" input#catalogOrCasNumber"+idMaterial).removeAttr("disabled");
        $("form#formEditMaterial"+idMaterial+" input#company"+idMaterial).removeAttr("disabled");
        $("form#formEditMaterial"+idMaterial+" input#website"+idMaterial).removeAttr("disabled");
    }

    // Send data to Action Update Material for feedback tl
    function funcFeedbackTL(idMaterial, materialName, sourcingNumber){
            let feedbackTL = $('form#formFeedbackTL_'+idMaterial+' select#feedbackTL').val();
            $.ajax({
                type: 'POST',
                url: '../controller/actionUpdateMaterial.php',
                data:{idMaterial: idMaterial, feedbackTL: feedbackTL, materialName: materialName, sourcingNumber: sourcingNumber},
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

                    loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
                }
            })
        }

    // Send data to Action Update Material for feedback rpic
    function funcFeedbackRPIC(idMaterial, materialName, sourcingNumber){
        let feedbackRPIC = $('form#formFeedbackRPIC_'+idMaterial+' select#feedbackRPIC').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, feedbackRPIC: feedbackRPIC, materialName: materialName, sourcingNumber: sourcingNumber},
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

                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
            }
        })
    }

    // Send data to Action Update Material for status riwayat
    function funcStatusRiwayat(idMaterial, materialName, sourcingNumber){
        let statusRiwayat = $('form#formStatusRiwayat_'+idMaterial+' select#statusRiwayat').val();
        $.ajax({
            type: 'POST',
            url: '../controller/actionUpdateMaterial.php',
            data:{idMaterial: idMaterial, statusRiwayat: statusRiwayat, materialName: materialName, sourcingNumber: sourcingNumber},
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

                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>);
            }
        })
    }

    // Send data to Action Update Material for delete material
    function funcDeleteMaterial(idMaterial, materialName){
        Swal.fire({
            title: 'Apakah anda yakin untuk menghapus material ini?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Tidak`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '../controller/actionUpdateMaterial.php',
                    data:{ idMaterial: idMaterial, actionType: "delete", materialName: materialName },
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
                        loadDataRiwayat(<?php echo $_SESSION['user']['level']?>)
                    }
                })
            }
        })
    }

    // Send data to Action Update Material for update material
    function funcUpdateMaterial(idMaterial, sourcingNumber){
        // actual logic, e.g. validate the form
        $.ajax({
            type: "POST",
            url: "../controller/actionUpdateMaterial.php",
            data: $('form#formEditMaterialRiwayat'+idMaterial).serialize()+'&editMaterial=true&idMaterial='+idMaterial+'&sourcingNumber='+sourcingNumber,
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
                        
                loadDataRiwayat(<?php echo $_SESSION['user']['level']?>)
            }
        })
        $('#editMaterial'+idMaterial).modal('hide');
    }
</script>