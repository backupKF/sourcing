<?php
    header('Location: ../index.php')
?>

<style>
    /* CSS Tabel Riwayat */
    th{
        font-size:12px;
        font-family:poppinsSemiBold;
    }
    td {
        font-size:12px;
        font-family:poppinsMedium;
    }
    .test{
        color:blue;
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
    table .sticky-column-supplier {
        position: sticky;
        left: 130px;
        background: white;
        z-index: 1;
    }
    table .sticky-column-materialName {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }
</style>

<!-- Card Table -->
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <!-- Tabel View -->
        <table class="table table-striped table-hover" id="table-view">
            <thead>
                <tr>
                    <th style="width:100px">Material Name</th>
                    <th style="width:100px">Material Category</th>
                    <th style="width:100px">Supplier</th>
                    <th style="width:100px">Manufacture</th>
                    <th style="width:100px">Project Name</th>
                    <th style="width:100px">Status</th>
                    <th style="width:180px">Feedback R&D</th>
                    <th style="width:180px">Feedback Proc</th>
                    <th style="width:180px">Final Feedback</th>
                    <th style="width:100px">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width:100px" class="sticky-column-materialName">Material Name</th>
                    <th style="width:100px">Material Category</th>
                    <th style="width:100px" class="sticky-column-supplier">Supplier</th>
                    <th style="width:100px">Manufacture</th>
                    <th style="width:100px">Project Name</th>
                    <th style="width:100px">Status</th>
                    <th style="width:180px">Feedback R&D</th>
                    <th style="width:180px">Feedback Proc</th>
                    <th style="width:180px">Final Feedback</th>
                    <th style="width:100px">Action</th>
                </tr>
            </tfoot>
        </table>
    </div>            
</div>
<!-- -- -->

<script>
    $(document).ready(function() {
        // Datatable table view
        var tableView = $('#table-view').DataTable({
            scrollX : true,
            scrollY: '385px',
            scrollCollapse: true,
            stateSave: true,
            lengthChange: false,
            pageLength: 6,
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataViewSourcing.php',
                type: 'POST',
            },
            columns: [
                {
                    className: 'sticky-column-materialName',
                    data: "materialName"
                },
                {
                    data: "materialCategory"
                },
                {
                    className: 'sticky-column-supplier',
                    data: "supplier"
                },
                {
                    data: "manufacture"
                },
                {
                    data: "projectName"
                },
                {
                    className: "text-center",
                    data: function(data){
                        return '<span class="badge text-dark" style="font-size:12px;font-family:poppinsBlack;width:100px;'+ (data.statusSourcing == "DONE" ? "background-color:#9cff9d":(data.statusSourcing == "OPEN" ? "background-color:#7380fa":(data.statusSourcing == "RE-OPEN" ? "background-color:#a1ecff":(data.statusSourcing == "DROP" ? "background-color:#bd7aff":(data.statusSourcing == "NOT YET" ? "background-color:#ff6040":(data.statusSourcing == "HOLD" ? "background-color:#f72a34":(data.statusSourcing == "NO STATUS" ? "background-color:#a1a1a1":""))))))) +'">'+data.statusSourcing+'</span>'
                    }
                },
                {
                    data: function(data){
                        if(data.dateFeedbackRnd != '-'){
                            return (
                                '<!-- Tanggal Feedback Rnd -->'+
                                '<span class="text-start bg-info badge text-dark" style="width:150px;font-size:11px;font-family:poppinsBold;">Date: '+data.dateFeedbackRnd+'</span>'+
                                '<!-- Isi Detail Feedback Rnd-->'+
                                '<div class="overflow-auto" style="height:60px">'+
                                    '<div class="text-wrap pt-1" style="font-size:11px;font-family:poppinsMedium;">'+data.sampelFeedbackRnd+'</div>'+
                                '</div>'+
                                '<!-- Penulis -->'+
                                '<div style="font-size:10px;font-family:poppinsBold;">By: '+data.writerFeedbackRnd+'</div>'
                            )
                        }else{
                            return '<div class="text-center">-</div>'
                        }
                    }
                },
                {
                    data: function(data){
                        if(data.dateFeedbackProc != '-'){
                            return (
                                '<!-- Tanggal Feedback Proc -->'+
                                '<span class="text-start bg-info badge text-dark" style="width:150px;font-size:11px;font-family:poppinsBold;">Date: '+data.dateFeedbackProc+'</span>'+
                                '<!-- Isi Feedback Proc -->'+
                                '<div class="overflow-auto" style="height:60px">'+
                                    '<div class="text-wrap p-1" style="font-size:11px;font-family:poppinsMedium;">'+data.feedbackProc+'</div>'+
                                '</div>'+
                                '<!-- Penulis -->'+
                                '<div style="font-size:10px;font-family:poppinsBold;">By: '+data.writerFeedbackProc+'</div>'
                            )
                        }else{
                            return '<div class="text-center">-</div>'
                        }
                    }
                },
                {
                    data: function(data){
                        if(data.dateFinalFeedbackRnd != '-'){
                            return(
                                '<!-- Tanggal Final Feedback Rnd -->'+
                                '<span class="text-start bg-info badge text-dark" style="width:150px;font-size:11px;font-family:poppinsBold;">Date: '+data.dateFinalFeedbackRnd+'</span>'+
                                '<!-- Isi Final Feedback Rnd -->'+
                                '<div class="overflow-auto" style="height:60px">'+
                                    '<div class="text-wrap pt-1" style="font-size:11px;font-family:poppinsMedium;">'+data.finalFeedbackRnd+'</div>'+
                                '</div>'+
                                '<!-- Penulis -->'+
                                '<div style="font-size:10px;font-family:poppinsBold;">By: '+data.writerFinalFeedbackRnd+'</div>'
                            )
                        }else{
                            return '<div class="text-center">-</div>'
                        }
                    }
                },
                {
                    data: function(data){
                        return (
                            '<a href="detailSourcing.php?idMaterial='+data.idMaterial+'" class="btn btn-warning btn-sm">'+
                                'Update Sourcing'+
                            '</a>'
                        )
                    }
                },
            ]
        })

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
</script>
