<?php
    header('Location: ../index.php')
?>
<!-- CSS -->
<style>
    div.dataTables_filter, div.dataTables_length {
        padding-bottom: 10px;
    }
</style>

<!-- Card Table -->
<div class="card shadow bg-body rounded">
    <div class="card-body">
        <!-- Tabel Project -->
        <table id="table-project" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td class="d-none"></td>
                    <td style="width:5%"></td>
                    <td style="font-size:14px;font-family:poppinsSemiBold;width:80%">Project</td>
                </tr>
            </thead>
        </table>
        <!-- -- -->
    </div>            
</div>
<!-- -- -->

<script>
$(document).ready(function(){
    var projectTable = $('#table-project').DataTable({
        stateSave: true,
        scrollY: '430px',
        scrollCollapse: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '../controller/loadData/loadDataProject.php',
        },
        columns: [
            {
                className: 'd-none',
                data: function(data){
                    return (
                        '<div>'+ data.projectCode +'</div>'
                    )
                }
            },
            {
                className: 'dt-control',
                data: function(data){
                    return ""
                }
            },
            {
                data: function(data){
                    return (
                        '<td style="font-size:14px;font-family:poppinsMedium;">'+ data.projectCode +' | '+ data.projectName +'</td>'
                    )
                }
            },
        ]
    })

    // Menampilkan tabel material, apabila user melakukan event click ditabel project
    $('#table-project tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            // Membuat variabel untuk mengambil data project dibaris yang mengalami event click
            var row = projectTable.row(tr);
            if (row.child.isShown()) {
                // Menghilangkan tabel material jika event click ditutup
                var table = $("#table-material"+row.data()[1], row.child());
                table.DataTable().clear().destroy();
                    
                // Fungsi untuk menyembunyikan baris
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Menampilkan tabel material jika event click dilakukan
                row.child( tableMaterial(row.data()[1])).show();
                tr.addClass('shown');
            }
    });

    // CSS 
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

// Membuat Tabel Material didalam sebuah fungsi
function tableMaterial(d){
    loadDataMaterial(d)
    return (
        '<div class="container-fluid m-0 p-0 contentMaterial" id="contentTableMaterial'+d+'"></div>'
    )
}

// Load Data Material
function loadDataMaterial(d){
    $.ajax({
        url: 'layout/tabelMaterial.php',
        type: 'get',
        data: { projectCode: d},
        success: function(data) {
            $('#contentTableMaterial'+d+'').html(data);
        }
    });
}
</script>