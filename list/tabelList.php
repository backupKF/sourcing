<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <style>
        table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
            padding-right: 0px;
        }
        table.dataTable tbody td div.detail{
            padding: 0px;
        }
        table.dataTable tbody td{
            word-wrap:break-word;
        }
    </style>
    <!-- -- -->
  </head>
  <body>
    <div class="container mt-5 position-absolute p-0" style="left:250px">
        <!-- Card Table -->
        <div class="card" style="width:1100px">
            <div class="card-body">
                <!-- Tabel Project -->
                <table class="display responsive nowrap" id="table-project" style="width:100%">
                    <thead>
                        <tr>
                            <td class="d-none"></td>
                            <td style="width:5%"></td>
                            <td style="width:5%">No</td>
                            <td style="width:80%">Name</td>
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
                                <td><?php echo $no++?></td>
                                <td><?php echo $row['projectCode'], ' | ', $row['projectName']?></td>
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
    </div>

    <script>
    $(document).ready(function(){
        var projectTable = $('#table-project').DataTable()

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
    })

    // Membuat Tabel Material didalam sebuah fungsi
    function tableMaterial(d){
        $.ajax({
            url: 'component/subTabel/tabelMaterial.php',
            type: 'get',
            data: { projectCode: d},
            success: function(data) {
                $('#contentData'+d+'').html(data);
            }
        });
        return (
            '<div class="container-fluid m-0 p-0" style="width:1050px" id="contentData'+d+'"></div>'
        )
    }
    </script>

  </body>
</html>