<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../../dashboard/index.php');
        exit();
    };
?>

<!-- CSS Table -->
<style>
    table.vendor tbody td {
        padding-top:0;
        padding-bottom:0;
    }
    .column-project-value{
        font-size:12px;
        font-family:'poppinsMedium';
    }
    .column-project-head{
        font-size:13px;
        font-family:'poppinsSemiBold';
    }
    .labelVendor{
        font-size:14px;
        font-family:'poppinsSemiBold';
    }
</style>

<!-- Modal Select Vendor -->
<div class="modal" id="modalSetVendorAddSupplier<?php echo $_GET['idMaterial']?>">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content" style="width: 500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Select Vendor</div>
            </div>
                        
            <!-- Modal Body -->
            <div class="modal-body position-relative">
                <!-- Button Tambah data master supplier -->
                <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>">Tambah Data Master Supplier</button>
                <div class="text-success mb-1" id="successMsgAddMasterVendor-supplierAdd<?php echo $_GET['idMaterial']?>" style="font-size:10px;font-family:poppinsSemiBold"></div>
                <!-- Select Project -->
                <table class="table vendor" id="tabel-vendorAddSupplier<?php echo $_GET['idMaterial']?>" style="width:100%">
                    <thead style="background-color:#00b0aa">
                        <tr>
                            <td class="column-project-head" style="width:100px">Vendor Name</td>
                            <td class="column-project-head" style="width:20px"></td>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#tambahSupplier<?php echo $_GET['idMaterial']?>">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Master Vendor -->
<?php include "addMasterVendor.php"?>

<script>
    $(document).ready(function(){
        $('#tabel-vendorAddSupplier<?php echo $_GET['idMaterial']?>').DataTable({
            lengthChange:false,
            pageLength:5,
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataMasterVendor.php',
            },
            columns: [
                {
                    className: 'column-project-value',
                    data: function(data){
                        return (
                            '<div class="py-0 column-project-value" style="width:350px">'+
                                '<!-- Column Project Name -->'+
                                    data.vendorName +
                            '</div>'
                        )
                            
                    }
                },
                {
                    className: 'column-project-value',
                    data: function(data){
                        return (
                            '<!-- Action Button -->'+
                            '<div class="py-0" style="width:50px">'+
                                '<form id="formSetVendorAddSupplier<?php echo $_GET['idMaterial']?>">'+
                                    '<button type="button" class="btn btn-success btn-sm p-0 px-1 my-1" style="height:22px" name="setValue" value="'+data.vendorName+'" onclick="funcSetVendor(<?php echo $_GET['idMaterial']?>,`'+data.vendorName+'`,`formSetVendorAddSupplier`)">'+
                                        '<span style="font-size:11px;font-family:poppinsBold">Pilih</span>'+
                                    '</button>'+
                                '</form>'+
                            '</div>'
                        )
                    }
                }
            ]
        })
    })
</script>
