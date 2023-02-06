<?php
    session_start();

    include "../../dbConfig.php";

    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
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
        font-size:14px;
        font-family:'poppinsMedium';
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
                
                <label class="mb-1 labelVendor" >Tambah Supplier Baru : </label>
                <div class="row mb-2">
                    <div class="col">
                        <form id="formSetNewVendorAddSupplier<?php echo $_GET['idMaterial']?>" autocomplete="off">
                            <input class="form-control form-control-sm" type="text" placeholder="Masukan Vendor Baru" name="setNewVendor" style="height:5px">
                        </form>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm p-0 px-1" style="height:22px" form="formSetNewVendorAddSupplier<?php echo $_GET['idMaterial']?>">
                            <span style="font-size:11px;font-family:poppinsBold">Pilih</span>
                        </button>
                    </div>
                </div>

                <label class="labelVendor mb-1">Cari Supplier :</label>

                <!-- Select Project -->
                <table class="table vendor" id="tabel-vendorAddSupplier<?php $_GET['idMaterial']?>" style="width:100%">
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
                <button type="button" style="width:150px" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="<?php echo !empty($row['id']) && !empty($_GET['idMaterial'])? '#editSupplier'.$row['id']:'#tambahSupplier'.$_GET['idMaterial']?>">
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Select Project -->

<script>
    $(document).ready(function(){
        $('#tabel-vendorAddSupplier<?php $_GET['idMaterial']?>').DataTable({
            lengthChange:false,
            pageLength:5,
            processing: true,
            serverSide: true,
            ajax: {
                url: '../controller/loadData/loadDataMasterVendor.php',
            },
            columns: [
                {
                    data: function(data){
                        return (
                            '<div class="py-0 column-project-value" style="width:250px">'+
                                '<!-- Column Project Name -->'+
                                '<div class="d-flex align-items-center"style="height:30px">'+
                                    data.vendorName +
                                '</div>'+
                            '</div>'
                        )
                            
                    }
                },
                {
                    data: function(data){
                        return (
                            '<!-- Action Button -->'+
                            '<div class="py-0" style="width:50px">'+
                                '<form id="formSetVendorAddSupplier<?php echo $_GET['idMaterial']?>">'+
                                    '<button type="button" class="btn btn-success btn-sm p-0 px-1" style="height:22px" name="setValue" value="'+data.vendorName+'" onclick="funcSetVendor(<?php echo $_GET['idMaterial']?>,`'+data.vendorName+'`,`formSetVendorAddSupplier`)">'+
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

    // Listen Event Submit
    document.getElementById("formSetNewVendorAddSupplier<?php echo $_GET['idMaterial']?>").addEventListener('submit', event => {
        event.preventDefault();
        // actual logic, e.g. validate the form
        funcSetNewVendor(<?php echo $_GET['idMaterial']?>, 'formSetNewVendorAddSupplier')
    });
</script>
