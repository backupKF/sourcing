<div class="card" style="width:1020px;margin-top:10px;background-color:#f5fcde">
    <div class="card-body">
        <h3 class="text-center border-bottom pb-2 text-decoration-underline" style="font-size:20px">Not Yet Sourcing</h3>
        <table class="display responsive nowrap m-1" id="table-project" style="width:100%">
            <thead>
                <tr>
                    <th style="font-size:13px">No</th>
                    <th style="font-size:13px">Nama Material</th>
                    <th style="font-size:13px">Spesifikasi</th>
                    <th style="font-size:13px">Target Launching</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dataStatusSourcingNotYet= $conn->query("SELECT materialName, materialSpesification FROM TB_PengajuanSourcing WHERE statusPengajuan='NOT YET'")->fetchAll();
                    $no=1;
                    foreach($dataStatusSourcingNotYet as $data){
                ?>
                <tr>
                    <td style="font-size:12px"><?php echo $no++?></td>
                    <td style="font-size:12px"><?php echo $data['materialName']?></td>
                    <td style="font-size:12px"><?php echo $data['materialSpesification']?></td>
                    <td style="font-size:12px">Januari 2020</td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- -- -->

<script>
    $(document).ready(function(){
        var projectInfo = $('#table-project').DataTable({
            lengthMenu: [2, 3],
        })
        $('.dataTables_filter input[type="search"]').css(
            {'height':'25px','display':'inline-block'}
        );
        $('.dataTables_filter label').css(
            {'font-size':'15px','display':'inline-block'}
        );
        $('.dataTables_length label').css(
            {'font-size':'15px','display':'inline-block'}
        );
        $('.dataTables_length select option').css(
            {'font-size':'2px'}
        );
        $('.dataTables_info').css(
            {'font-size':'15px'}
        );
        $('.dataTables_paginate').css(
            {'font-size':'15px'}
        );
    })
</script>