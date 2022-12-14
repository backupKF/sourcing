<?php
    header('Location: ../index.php')
?>
<style>
    div.dataTables_filter, div.dataTables_length {
        padding-bottom: 10px;
    }
</style>

<!-- Card Table -->
<div class="card" style="width:1100px">
    <div class="card-body">
        <!-- Tabel Project -->
        <table class="display responsive nowrap" id="table-project" style="width:100%">
            <thead>
                <tr>
                    <td class="d-none"></td>
                    <td style="width:5%"></td>
                    <td style="font-size:14px;font-family:poppinsSemiBold;width:5%">No</td>
                    <td style="font-size:14px;font-family:poppinsSemiBold;width:80%">Name</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../dbConfig.php";
                    $no = 1;
                    $dataProject = $conn->query("SELECT DISTINCT TB_Project.projectCode, TB_Project.projectName FROM TB_PengajuanSourcing INNER JOIN TB_Project ON TB_PengajuanSourcing.projectCode = TB_Project.projectCode WHERE feedbackRPIC=1")->fetchAll();
                    foreach($dataProject as $row){
                ?>
                    <tr>
                        <td class="d-none"><?php echo $row['projectCode']?></td>
                        <td class="dt-control"></td>
                        <td style="font-size:14px;font-family:poppinsMedium;"><?php echo $no++?></td>
                        <td style="font-size:14px;font-family:poppinsMedium;"><?php echo $row['projectCode'], ' | ', $row['projectName']?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <!-- -- -->
    </div>            
</div>
<!-- -- -->

<script>
$(document).ready(function(){
    var projectTable = $('#table-project').DataTable({
        stateSave: true,
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
                row.child( tableMaterial(row.data()[0])).show();
                tr.addClass('shown');
            }
    });

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
    $(document).ready(function(){
        loadDataMaterial(d)
    })
    return (
        '<div class="container-fluid m-0 p-0" style="width:1050px" id="contentTableMaterial'+d+'"></div>'
    )
}

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