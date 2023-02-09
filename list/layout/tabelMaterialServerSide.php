<?php
    session_start();

    // Kondisi dimana apabila tidak ada data get maka akan meredirect ke halaman index.php
    if(empty($_GET)){
        header('Location: ../index.php');
    }
?>
<style>
    /* CSS Table */
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
    table .sticky-column-material {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }
    .headerColumn {
        font-size:13px;
        font-family:poppinsSemiBold;
    }
    .dataColumn {
        font-size:12px;
        font-family:poppinsRegular;
    }
</style>

<!-- Tabel Material -->
    <table id="table-material<?php echo $_GET['projectCode']?>" class="table table-striped">
        <thead class="bg-primary" >
            <tr>
                <th></th>
                <th scope="col" style="width:50px" class="headerColumn">Material Category</th>
                <th scope="col" style="width:150px" class="headerColumn sticky-column-material bg-primary">Material Name</th>
                <th scope="col" style="width:20px" class="headerColumn">Priority</th>
                <th scope="col" style="width:20px" class="headerColumn">Target Launching</th>
                <th scope="col" style="width:270px" class="headerColumn">Spesification</th>
                <th scope="col" style="width:100px" class="headerColumn">Catalog Or CAS Number</th>
                <th scope="col" style="width:250px" class="headerColumn">Company</th>
                <th scope="col" style="width:250px" class="headerColumn">Website</th>
                <th scope="col" style="width:100px" class="headerColumn">Finish Dossage Form</th>
                <th scope="col" style="width:250px" class="headerColumn">Keterangan</th>
                <th scope="col" style="width:100px" class="headerColumn">PIC</th>
                <th scope="col" style="width:280px" class="headerColumn">Vendor Terdaftar AERO</th>
                <th scope="col" style="width:250px" class="headerColumn">Document Requirement</th>
                <th scope="col" style="width:100px" class="headerColumn text-center">Status</th>
                <th scope="col" style="width:280px" class="headerColumn text-center">Summary Report</th>
                <?php if($_SESSION['user']['level'] == 1){?>
                    <th scope="col" style="width:100px" class="headerColumn text-center">Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tfoot class="bg-primary" >
            <tr>
                <th></th>
                <th scope="col" style="width:50px" class="headerColumn">Material Category</th>
                <th scope="col" style="width:150px" class="headerColumn sticky-column-material bg-primary">Material Name</th>
                <th scope="col" style="width:20px" class="headerColumn">Priority</th>
                <th scope="col" style="width:20px" class="headerColumn">Target Launching</th>
                <th scope="col" style="width:270px" class="headerColumn">Spesification</th>
                <th scope="col" style="width:100px" class="headerColumn">Catalog Or CAS Number</th>
                <th scope="col" style="width:250px" class="headerColumn">Company</th>
                <th scope="col" style="width:250px" class="headerColumn">Website</th>
                <th scope="col" style="width:100px" class="headerColumn">Finish Dossage Form</th>
                <th scope="col" style="width:250px" class="headerColumn">Keterangan</th>
                <th scope="col" style="width:100px" class="headerColumn">PIC</th>
                <th scope="col" style="width:280px" class="headerColumn">Vendor Terdaftar AERO</th>
                <th scope="col" style="width:250px" class="headerColumn">Document Requirement</th>
                <th scope="col" style="width:100px" class="headerColumn text-center">Status</th>
                <th scope="col" style="width:280px" class="headerColumn text-center">Summary Report</th>
                <?php if($_SESSION['user']['level'] == 1){?>
                    <th scope="col" style="width:100px" class="headerColumn text-center">Action</th>
                <?php } ?>
            </tr>
        </tfoot>
    </table>
    <script>
        $(document).ready(function(){
            var materialTable = $('#table-material<?php echo $_GET['projectCode']?>').DataTable({
                scrollX: true,
                lengthMenu: [3 , 5],
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '../controller/loadData/loadDataMaterial.php',
                    type: 'GET',
                    data: {
                        projectCode: '<?php echo $_GET['projectCode'] ?>',
                    }
                },
                columns: [
                    {
                        className: 'dt-control dataColumn',
                        data: function(){
                            return ""
                        }
                    },
                    {
                        className: 'dataColumn',
                        data: 'materialCategory'
                    },
                    {
                        className: 'dataColumn sticky-column-material',
                        data: 'materialName'
                    },

                    {
                        className: 'dataColumn',
                        data: 'priority'
                    },
                    {
                        className: 'dataColumn',
                        data: function(){
                            return "-"
                        }
                    },

                    {
                        className: 'dataColumn',
                        data: 'materialSpesification'
                    },
                    {
                        className: 'dataColumn',
                        data: 'catalogOrCasNumber'
                    },

                    {
                        className: 'dataColumn',
                        data: 'company'
                    },
                    {
                        className: 'dataColumn',
                        data: 'website'
                    },
                    {
                        className: 'dataColumn',
                        data: 'finishDossageForm'
                    },
                    {
                        className: 'dataColumn',
                        data: 'keterangan'
                    },
                    {
                        className: 'dataColumn',
                        data: 'teamLeader'
                    },
                    {
                        className: 'dataColumn',
                        data: 'vendorAERO'
                    },
                    {
                        className: 'dataColumn',
                        data: 'documentReq'
                    },
                    {
                        className: 'dataColumn',
                        data: function(dataMaterial){
                            // jika user level 1
                            if(<?php echo $_SESSION['user']['level'] ?> == 1){
                                return (
                                    '<form id="formSetStatusSourcing_'+dataMaterial.id+'">'+
                                    '<input type="hidden" value="'+dataMaterial.id+'" name="idMaterial">'+
                                        '<select class="form-select form-select-sm" style="height:25px;font-size:12px;font-family:poppinsRegular;" aria-label=".form-select-sm example" onchange="funcUpdateStatusSourcing('+dataMaterial.id+',`'+dataMaterial.materialName+'`)" id="statusSourcing">'+
                                            '<option '+ (dataMaterial.statusSourcing == "NO STATUS" ? "selected":"") +' value="">NO STATUS</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "OPEN" ? "selected":"") +' value="OPEN">OPEN</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "RE-OPEN" ? "selected":"") +' value="RE-OPEN">RE-OPEN</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "DONE" ? "selected":"") +' value="DONE">DONE</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "DROP" ? "selected":"") +' value="DROP">DROP</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "NOT YET" ? "selected":"") +' value="NOT YET">NOT YET</option>'+
                                            '<option '+ (dataMaterial.statusSourcing == "HOLD" ? "selected":"") +' value="HOLD">HOLD</option>'+
                                        '</select>'+
                                    '</form>'
                                )
                            }else{
                                // Jika user bukan level 1
                                return (
                                    '<div class="text-center bg-success bg-opacity-75 m-0" style="font-size:12px;font-family:poppinsBold;">'+dataMaterial.statusSourcing+'</div>'
                                )
                            }
                        }
                    },
                    {
                        className: 'dataColumn',
                        data: function(dataMaterial){
                            if(<?php echo $_SESSION['user']['level']?> == 1){
                                return (
                                    '<!-- Tanggal Sumary Report-->'+
                                    '<div class="ps-0" style="width:100px;font-size:11px;font-family:poppinsBold;">Date: '+ (dataMaterial.dateSumaryReport != null ? dataMaterial.dateSumaryReport:'')+'</div>'+
                                    '<!-- Isi Sumary Report -->'+
                                    '<div class="overflow-auto" style="height:65px">'+
                                        '<div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;">'+ (dataMaterial.sumaryReport != null ? dataMaterial.sumaryReport:'-') +'</div>'+
                                    '</div>'+

                                    '<!-- Action Final Feedback Rnd -->'+
                                    '<div>'+
                                        '<button type="button" class="btn btn-sm btn-primary p-0" data-bs-toggle="modal" style="width:100%;height:20px" data-bs-target="#sumaryReport'+dataMaterial.id+'">'+
                                            '<div style="font-size:12px">Sumary Report</div>'+
                                        '</button>'+
                                        // Modal Sumary Report
                                        <?php include "../../component/modal/server-side/sumaryReport.php"?>
                                    '</div>'
                                )
                            }else{
                                return (
                                    '<!-- Tanggal Sumary Report-->'+
                                    '<div class="ps-0" style="width:100px;font-size:11px;font-family:poppinsBold;">Date: '+ (dataMaterial.dateSumaryReport != null ? dataMaterial.dateSumaryReport:'')+'</div>'+
                                    '<!-- Isi Sumary Report -->'+
                                    '<div class="overflow-auto" style="height:65px">'+
                                        '<div class="text-wrap" style="font-size:12px;font-family:poppinsRegular;">'+ (dataMaterial.sumaryReport != null ? dataMaterial.sumaryReport:'-') +'</div>'+
                                    '</div>'
                                )
                            }
                        }
                    },
                    <?php if($_SESSION['user']['level'] == 1){?>
                        {
                            className: 'dataColumn',
                            data: function(data){
                                return (
                                    '<!-- Column Action Material -->'+
                                    '<td>'+
                                        '<!-- Edit Material -->'+
                                        '<button type="button" class="btn btn-sm btn-warning p-0" data-bs-toggle="modal" style="width:100%;height:30px" data-bs-target="#editMaterial'+data.id+'">'+
                                            '<div style="font-size:13px">Edit Material</div>'+
                                        '</button>'+
                                        <?php include "../../component/modal/server-side/updateMaterialList.php"?>
                                    '</td>'
                                )
                            }
                        },
                    <?php } ?>
                ]
            })

            // Menampilkan tabel material, apabila user melakukan event click ditabel project
            $('#table-material<?php echo $_GET['projectCode']?> tbody').on('click', 'td.dt-control', function () {
                    var tr = $(this).closest('tr');
                    // Membuat variabel untuk mengambil data project dibaris yang mengalami event click
                    var row = materialTable.row(tr);
                    if (row.child.isShown()) {
                        // Menghilangkan tabel material jika event click ditutup
                        var table = $("#table-supplier"+row.data()[0], row.child());
                        table.DataTable().clear().destroy();
                        
                        // Fungsi untuk menyembunyikan baris
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Menampilkan tabel material jika event click dilakukan
                        row.child( tableSupplier(row.data()[0], row.data()[2])).show();
                        tr.addClass('shown');
                    }
            });

            // CSS Tabel
            $('.dataTables_filter input[type="search"]').css(
                {
                    'height':'25px',
                    'font-family':'poppinsRegular',
                    'display':'inline-block',
                    'margin-button':'2px',
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
            $('.dataTables_scroll').css(
                {
                    'margin-button':'2px',
                }
            );
        })

    // Membuat Tabel Supplier didalam sebuah fungsi
    function tableSupplier(d, materialName){
        loadDataSupplier(d, materialName)
        return (
            '<div class="container-fluid m-0 p-0" style="background-color:#fffedb" id="contentDataSupplier'+d+'"></div>'
        )
    }

    // Load Data Supplier
    function loadDataSupplier(d, materialName){
        $.ajax({
            url: 'layout/tabelSupplierServerSide.php',
            type: 'get',
            data: { idMaterial: d, materialName: materialName},
            success: function(data) {
                $('#contentDataSupplier'+d+'').html(data);
            }
        });
    }

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

        // Send data to Action Update Material for update status sourcing
        function funcUpdateStatusSourcing(idMaterial, materialName){
            let statusSourcing = $('form#formSetStatusSourcing_'+idMaterial+' select#statusSourcing').val();
            $.ajax({
                url: '../controller/actionUpdateMaterial.php',
                type: 'POST',
                data: {
                    "idMaterial": idMaterial,
                    "materialName": materialName,
                    "statusSourcing": statusSourcing,
                },
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
                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                }
            })
        }

        // Send data to Action Update Material for update sumary report
        function funcUpdateSumaryReport(idMaterial, materialName){
            $.ajax({
                url: '../controller/actionUpdateMaterial.php',
                type: 'POST',
                data: $('form#formSumaryReport'+idMaterial).serialize()+'&materialName='+materialName,
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
                    loadDataMaterial('<?php echo $_GET['projectCode']?>')
                }
            })
            $('#sumaryReport'+idMaterial).modal('hide');
        }

        // Send data to Action Update Material for update material
        function funcUpdateMaterial(idMaterial){
            $.ajax({
                type: "POST",
                url: "../controller/actionUpdateMaterial.php",
                data: $('form#formEditMaterial'+idMaterial).serialize()+'&editMaterial=true&idMaterial='+idMaterial,
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

                        loadDataMaterial('<?php echo $_GET['projectCode']?>')
                    }
                })

                $('#editMaterial'+idMaterial).modal('hide');
            }
    </script>
<!-- -- -->