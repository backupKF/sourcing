<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
  Tambah Supplier
</button>
<?php include "../formAddSupplier.php"?>
<!-- Tabel Supplier -->
<table id="table-supplier<?php echo $_GET['idMaterial']?>" class="pt-2 table-bordered">
    <thead class="bg-warning">
        <tr>
            <th style="font-size:14px;width:10px" class="text-center">No</th>
            <th style="font-size:14px;width:140px" class="text-center">Supplier</th>
            <th style="font-size:14px;width:160px" class="text-center">Manufacture</th>
            <th style="font-size:14px;width:150px" class="text-center">Origin Country</th>
            <th style="font-size:14px;width:50px" class="text-center">Lead Time</th>
            <th style="font-size:14px;width:100px" class="text-center">
                <div class="container">
                    <div class="row">Information MoQ, UoM, Price</div>
                    <div class="row">
                        <div class="col">MoQ</div>
                        <div class="col">UoM</div>
                        <div class="col">Price</div>
                    </div>
                </div>
            </th>
            <th style="font-size:14px;width:100px" class="text-center">Catalog or CAS Number</th>
            <th style="font-size:14px;width:100px" class="text-center">Grade/Reference Standard</th>
            <th style="font-size:14px;width:100px" class="text-center">Document Info</th>
            <!-- <th style="font-size:14px" class="text-center">Action Document</th>
            <th style="font-size:14px" class="text-center">Feedback R&D</th>
            <th style="font-size:14px" class="text-center">Feedback Proc</th>
            <th style="font-size:14px" class="text-center">Final Feedback R&D</th> -->
            <th style="font-size:14px" class="text-center">Action</th>
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
                <td class="p-0">
                    <button type="button" class="btn btn-default p-0" style="width:30px" data-bs-toggle="modal" data-bs-target="#tambahDetailSupplier<?php echo $row['id']?>">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M17,18V5H7V18L12,15.82L17,18M17,3A2,2 0 0,1 19,5V21L12,18L5,21V5C5,3.89 5.9,3 7,3H17M11,7H13V9H15V11H13V13H11V11H9V9H11V7Z" />
                        </svg>
                    </button>
                    <?php include "../formAddDetailSupplier.php"?>
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                                include "../../dbConfig.php";
                                $detailSupplier = $conn->query("SELECT idDetailSupplier, MoQ, UoM, price FROM TB_DetailSupplier INNER JOIN TB_Supplier ON TB_DetailSupplier.idSupplier = TB_Supplier.id WHERE idSupplier='{$row['id']}'")->fetchAll();
                                foreach($detailSupplier as $detail){
                            ?>
                            <tr>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['MoQ']?></td>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['UoM']?></td>
                                <td class="text-center p-0" style="font-size:12px;width:60px"><?php echo $detail['price']?></td>
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
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSupplier<?php echo $row['id']?>">
                        Edit
                    </button>
                    <?php include "../formUpdateSupplier.php"?>
                </td>
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