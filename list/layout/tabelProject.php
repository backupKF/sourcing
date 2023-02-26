<!-- CSS -->
<style>
    .projectColumn {
        font-size:15px;
        font-family:poppinsSemiBold;
    }

    td {
        border-color:#999999;
    }

    div.dataTables_filter, div.dataTables_length {
        padding-bottom: 10px;
    }
</style>

<!-- Title -->
<div class="text-center mb-2" style="font-family:poppinsBlack;font-size:25px">Tabel List Sourcing</div>

<!-- Tabel Project -->
<table id="table-project" class="table" style="width:100%">
    <thead>
        <tr>
            <td style="width:5%"></td>
            <td></td>
        </tr>
    </thead>
</table>

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
            dataType: 'json'
        },
        columns: [
            {
                className: 'dt-control projectColumn',
                data: function(data){
                    return ""
                }
            },
            {
                className: 'projectColumn',
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
                var table = $("#table-material"+row.data()[0], row.child());
                table.DataTable().clear().destroy();
                    
                // Fungsi untuk menyembunyikan baris
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Menampilkan tabel material jika event click dilakukan
                row.child( tableMaterial(row.data()[0], row.data()[2])).show();
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
function tableMaterial(idProject, projectName){
    loadDataMaterial(idProject, projectName)
    return (
        '<div class="container-fluid m-0 p-0 contentMaterial" id="contentTableMaterial'+idProject+'"></div>'
    )
}

// Load Data Material
function loadDataMaterial(idProject, projectName){
    $.ajax({
        url: 'layout/tabelMaterial.php',
        type: 'get',
        data: { 
            idProject: idProject,
            projectName: projectName
        },
        success: function(data) {
            $('#contentTableMaterial'+idProject).html(data);
        }
    });
}
</script>