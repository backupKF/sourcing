<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
  Tambah Supplier
</button>
<?php include "../formSupplier.php"?>
<!-- Tabel Supplier -->
<table id="table-supplier<?php echo $_GET['idMaterial']?>" style="width:150%" class="pt-2">
    <thead class="bg-warning">
        <tr>
            <th style="font-size:14px" class="text-center">No</th>
            <th style="font-size:14px" class="text-center">Supplier</th>
            <th style="font-size:14px" class="text-center">Manufacture</th>
            <th style="font-size:14px" class="text-center">Origin Country</th>
            <th style="font-size:14px" class="text-center">Lead Time</th>
            <th style="font-size:14px" class="text-center">Information MoQ, UoM, Price</th>
            <th style="font-size:14px" class="text-center">Catalog or CAS Number</th>
            <th style="font-size:14px" class="text-center">Grade/Reference Standard</th>
            <th style="font-size:14px" class="text-center">Document Info</th>
            <!-- <th style="font-size:14px" class="text-center">Action Document</th>
            <th style="font-size:14px" class="text-center">Feedback R&D</th>
            <th style="font-size:14px" class="text-center">Feedback Proc</th>
            <th style="font-size:14px" class="text-center">Final Feedback R&D</th>
            <th style="font-size:14px" class="text-center">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
            include "../../../dbConfig.php";
            $no = 1;
            $dataSupplier = $conn->query("SELECT * FROM TB_Supplier WHERE idMaterial='{$_GET['idMaterial']}'")->fetchAll();
            foreach($dataSupplier as $row){
        ?>
            <tr>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $no++?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['supplier']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['manufacture']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['originCountry']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['leadTime']?></div></td>
                <td>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">MoQ</th>
                                <th class="text-center">UoM</th>
                                <th class="text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "../../dbConfig.php";
                                $detailSupplier = $conn->query("SELECT idDetailSupplier, MoQ, UoM, price FROM TB_DetailSupplier INNER JOIN TB_Supplier ON TB_DetailSupplier.idSupplier = TB_Supplier.id WHERE idSupplier='{$row['id']}'")->fetchAll();
                                foreach($detailSupplier as $detail){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $detail['MoQ']?></td>
                                <td class="text-center"><?php echo $detail['UoM']?></td>
                                <td class="text-center"><?php echo $detail['price']?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['catalogOrCasNumber']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['gladeOrReferenceStandard']?></div></td>
                <td><div class="text-center text-wrap" style="font-size:13px;"><?php echo $row['documentInfo']?></div></td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<script>
    //  $(document).ready(function(){
    //     var supplierTable = $('#table-supplier').DataTable({
    //         scrollX: true,
    //         pageLength: 2,
    //     })
    //  })
</script>
<!-- -- -->