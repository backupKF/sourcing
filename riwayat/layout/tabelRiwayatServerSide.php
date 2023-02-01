<?php
    session_start();

    // Jika tidak ada data GET maka akan me-redirect ke halaman index
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>

<style>
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
        <table id="table-riwayat1" class="table">
            <thead>
                <tr>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:150px" class="text-center">Sourcing Number</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:150px" class="text-center">Material Name</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Date Sourcing</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Project Code</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:120px" class="text-center">Project Name</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Team Leader</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Researcher</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Feedback TL</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:100px" class="text-center">Feedback RPIC</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:120px" class="text-center">Date Approved TL</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:125px" class="text-center">Date Accepted RPIC</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:90px" class="text-center">Status</th>
                    <th scope="col" style="font-size:14px;font-family:poppinsSemiBold;width:180px" class="text-center">Action Material</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Datatable tabel riwayat
        var tableRiwayat = $('#table-riwayat1').DataTable({
            scrollX: true,
            scrollY: '420px',
            scrollCollapse: true,
            stateSave: true,
            lengthMenu: [5 , 10, 15],
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataSourcingRiwayat.php',
                type: 'POST',
            },
            columns: [
                {
                    data: 'sourcingNumber'
                },
                {
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
                            return '<div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>'
                        }else{
                            return '<div class="text-center bg-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">APPROVED</div>'
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
                            return '<div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>'
                        }else if(<?php echo $_SESSION['user']['level']?> != 1  && data.feedbackRPIC == 0){
                            return '<div class="text-center bg-danger bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">NO STATUS</div>'
                        }else{
                            return '<div class="text-center bg-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">APPROVED</div>'
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
                                        '<option '+ (data.statusRiwayat == "NO STATUS" ? "selected":"") +' >NO STATUS</option>'+
                                        '<option '+ (data.statusRiwayat == "ON PROCESS" ? "selected":"") +' value="ON PROCESS">ON PROCESS</option>'+
                                        '<option '+ (data.statusRiwayat == "HOLD" ? "selected":"") +' value="HOLD">HOLD</option>'+
                                        '<option '+ (data.statusRiwayat == "CANCEL" ? "selected":"") +' value="CANCEL">CANCEL</option>'+
                                   ' </select>'+
                               ' </form>'
                            )
                        }else{
                            return '<div class="text-center text-success bg-opacity-75 m-0" style="font-family:poppinsSemiBold;width:70px">'+data.statusRiwayat+'</div>'
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
                                    <?php include "../../component/modal/updateMaterialRiwayat.php"; ?>

                                    '<!-- Modal View Material -->'+
                                    <?php include "../../component/modal/viewMaterial.php"; ?>
                                '</div>'
                            ) 
                        }else{
                            return (
                                // Button
                                '<div>'+
                                    '<div class="text-center">'+
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
                                    <?php include "../../component/modal/viewMaterial.php"; ?>
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
        // Check Submit
        $("form#formEditMaterial"+idMaterial).submit(function(e){
            e.preventDefault();

            // actual logic, e.g. validate the form
            $.ajax({
                type: "POST",
                url: "../controller/actionUpdateMaterial.php",
                data: $('form#formEditMaterial'+idMaterial).serialize()+'&editMaterial=true&idMaterial='+idMaterial+'&sourcingNumber='+sourcingNumber,
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
        });
    }
</script>