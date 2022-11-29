<table class="table">
    <thead>
        <tr>
            <th>MoQ</th>
            <th>UoM</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include "../../dbConfig.php";
            $detailSupplier = $conn->query("SELECT idDetailSupplier, MoQ, UoM, price FROM TB_DetailSupplier INNER JOIN TB_Supplier ON TB_DetailSupplier.idSupplier = TB_Supplier.id WHERE idSupplier=13")->fetchAll();
            foreach($detailSupplier as $row){
        ?>
        <tr>
            <td><?php echo $row['MoQ']?></td>
            <td><?php echo $row['UoM']?></td>
            <td><?php echo $row['price']?></td>
            <td>
                <a href="controller/actionSupplier.php?action_type=delete&id=<?php echo $row['idDetailSupplier']?>" class="btn btn-danger btn-sm d-inline ms-1" id="delete">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
        <script>
            $('.table').on('click', 'a#delete', function(){
                return confirm("Apakah anda yakin menghapus informasi ini?")
            })
        </script>
    </tbody>
</table>