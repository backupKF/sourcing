<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container mt-3" style="margin-left:275px">
        <div class="card" style="width:105%">
            <div class="card-body">
                <table class="stripe row-border" id="table-project" style="width:100%">
                    <thead>
                        <tr>
                            <td style="width:5%"></td>
                            <td style="width:5%">No</td>
                            <td style="width:80%">Name</td>
                            <td style="width:10%">Action</td>
                        </tr>
                    </thead>	
                </table>
            </div>            
        </div>
    </div>

    <script>
    $(document).ready(function(){
            var projectTable = $('#table-project').DataTable({
                order: [ 1, 'asc' ],
                ajax: "controller/project.php",
                columns: [
                    {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}
                    },
                    { 
                        data: null, render: function ( data, type, row ) {
                        return data.projectCode+' | '+data.projectName;} 
                    },
                    {
                        data: function(d) {
                            return (
                                // Button Tambah Material
                                '<button class="btn btn-warning mt-1 mb-3 ms-1" type="button" data-bs-target="#tambahMaterial'+d.projectCode+'" data-bs-toggle="modal">Tambah Material</button>'+
                                // Modal Form Tambah Material
                                '<div class="modal" id="tambahMaterial'+d.projectCode+'" data-bs-backdrop="static" name="'+d.projectCode+'">'+
                                    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                        '<div class="modal-content" style="width: 500px;">'+
                                            // Modal Header
                                            '<div class="modal-header">'+
                                                '<h5 class="modal-title">Tambah Material Project</h5>'+
                                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
                                            '</div>'+
                                            // Modal Body
                                            '<div class="modal-body">'+
                                            '<form action="controller/actionMaterial.php" method="post" class="was-validated" id="formMaterial'+d.projectCode+'">'+
                                                //Input Material Category
                                                '<label class="form-label fw-bold">Material Category</label>'+
                                                '<div class="row">'+
                                                    '<div class="col">'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" required>'+
                                                            '<label class="form-check-label" for="api">API</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak" required>'+
                                                            '<label class="form-check-label" for="ekstrak">Ekstrak</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient" required>'+
                                                            '<label class="form-check-label" for="excipient">Excipient</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor" required>'+
                                                            '<label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging" required>'+
                                                            '<label class="form-check-label" for="packaging">Packaging</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate" required>'+
                                                            '<label class="form-check-label" for="intermediate">Intermediate</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test" required>'+
                                                            '<label class="form-check-label" for="rapidTest">Rapid Test</label>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Material Deskripsi
                                                '<div class="mb-3">'+
                                                    '<label for="materialDeskripsi" class="form-label fw-bold">Material Deskripsi</label>'+
                                                    '<textarea class="form-control" id="materialDeskripsi" rows="3" name="materialDeskripsi" required></textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Material Deskripsi (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Material Spesification
                                                '<div class="mb-3">'+
                                                    '<label for="materialSpesification" class="form-label fw-bold">Material Spesification</label>'+
                                                    '<textarea class="form-control" id="materialSpesification" rows="3" name="materialSpesification" required></textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Material Spesification (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Catalog Or Cas Number
                                                '<div class="mb-3">'+
                                                    '<label for="catalogOrCasNumber" class="form-label fw-bold">Catalog Or CAS Number</label>'+
                                                    '<input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" required disabled>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Company
                                                '<div class="mb-3">'+
                                                    '<label for="company" class="form-label fw-bold">Company</label>'+
                                                    '<input type="text" class="form-control" id="company" name="company" required disabled>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Company (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Website
                                                '<div class="mb-3">'+
                                                    '<label for="website" class="form-label fw-bold">Website</label>'+
                                                    '<input type="text" class="form-control" id="website" name="website" required disabled>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Website (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Finish Dossage Form
                                                '<div class="mb-3">'+
                                                    '<label for="finishDossageForm" class="form-label fw-bold">Finish Dossage Form</label>'+
                                                    '<input type="text" class="form-control" id="finishDossageForm" name="finishDossageForm" required>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Keterangan
                                                '<div class="mb-3">'+
                                                    '<label for="keterangan" class="form-label fw-bold">Keterangan</label>'+
                                                    '<textarea class="form-control" id="keterangan" rows="3" name="keterangan" required></textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Keterangan (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                '<input type="hidden" name="setProject" value="'+d.projectCode+'">'+
                                                // '<input type="submit" value="submit" class="btn btn-primary" name="submit">'+  
                                            '</div>'+
                                            '</form>'+
                                            // Modal Footer
                                            '<div class="modal-footer">'+
                                                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                                '<input type="submit" value="Submit" class="btn btn-primary" name="submit" form="formMaterial'+d.projectCode+'">'+   
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            )
                        },
                    },
                ],
            });

            $( "#table-project tbody" ).on('click', 'input#api',function() {
                $("#table-project tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#ekstrak',function() {
                $("#table-project tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#excipient',function() {
                $("#table-project tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#napsipre',function() {
                $("#table-project tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#packaging',function() {
                $("#table-project tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#intermediate',function() {
                $("#table-project tbody input#catalogOrCasNumber").removeAttr("disabled");
                $("#table-project tbody input#company").attr('disabled', 'disabled');
                $("#table-project tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-project tbody" ).on('click', 'input#rapidTest',function() {
                $("#table-project tbody input#catalogOrCasNumber").removeAttr("disabled");
                $("#table-project tbody input#company").removeAttr("disabled");
                $("#table-project tbody input#website").removeAttr("disabled");
            });

            $('#table-project tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = projectTable.row(tr);
        
                if (row.child.isShown()) {
                    // This row is already open - close it
                    destroyChildTableMaterial(row)
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    createChildTableMaterial(row);
                    tr.addClass('shown');
                }
            });
            
        });

        function tableMaterial(d){
            return (
                '<div class="container" style="width:100%">'+
                    '<table id="table-material'+d+'" style="width:150%" >'+
                        '<thead class="bg-primary" >'+
                            '<tr>'+
                                '<th></th>'+
                                '<th style="font-size:14px" class="text-center">Material Category</th>'+
                                '<th style="font-size:14px" class="text-center">Material Deskripsi</th>'+
                                '<th style="font-size:14px" class="text-center">Material Spesification</th>'+
                                '<th style="font-size:14px" class="text-center">Catalog Or Cas Number</th>'+
                                '<th style="font-size:14px" class="text-center">Company</th>'+
                                '<th style="font-size:14px" class="text-center">Website</th>'+
                                '<th style="font-size:14px" class="text-center">Finish Dossage Form</th>'+
                                '<th style="font-size:14px" class="text-center">Keterangan</th>'+
                                '<th style="font-size:14px" class="text-center">Action</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '</tbody>'+
                    '</table>'+
                '</div">'
            )
        }

        function createChildTableMaterial ( row ) {
            // Display it the child row
            row.child( tableMaterial(row.data().projectCode) ).show();
        
            // Initialise as a DataTable
            $(document).ready(function(){
                var materialTable = $('#table-material'+row.data().projectCode).DataTable( {
                    dom: 'Bfrtip',
                    pageLength: 2,
                    scrollX: true,
                    ajax: {
                        url: "controller/material.php",
                        type: "get",
                        data: {
                            projectCode : row.data().projectCode
                        },
                    },
                    columns: [
                        {
                            className: 'dt-control ',
                            orderable: false,
                            data: null,
                            defaultContent: '',
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.materialCategory+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.materialDeskripsi+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.materialSpesification+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.catalogOrCasNumber+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.company+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.website+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.finishDossageForm+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.keterangan+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return(
                                // Button Tambah Material
                                '<button class="btn btn-warning ms-5" type="button" data-bs-target="#tambahMaterial'+d.id+'" data-bs-toggle="modal">Edit</button>'+
                                // Modal Form Tambah Material
                                '<div class="modal" id="tambahMaterial'+d.id+'" data-bs-backdrop="static" name="'+d.id+'">'+
                                    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                        '<div class="modal-content" style="width: 500px;">'+
                                            // Modal Header
                                            '<div class="modal-header">'+
                                                '<h5 class="modal-title">Tambah Material Project</h5>'+
                                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
                                            '</div>'+
                                            // Modal Body
                                            '<div class="modal-body">'+
                                            '<form action="controller/actionMaterial.php" method="post" class="was-validated" id="formMaterial'+d.id+'">'+
                                                '<input type="hidden" name="id" value="'+d.id+'">'+
                                                //Input Material Category
                                                '<label class="form-label fw-bold">Material Category</label>'+
                                                '<div class="row">'+
                                                    '<div class="col">'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="api" value="API" required '+(d.materialCategory=="API"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="api">API</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="ekstrak" value="Ekstrak" required '+(d.materialCategory=="Ekstrak"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="ekstrak">Ekstrak</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="excipient" value="Excipient" required '+(d.materialCategory=="Excipient"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="excipient">Excipient</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="napsipre" value="Narkotik, Psikotropik & Prekursor" required '+(d.materialCategory=="Narkotik, Psikotropik & Prekursor"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="napsipre">Narkotik, Psikotropik & Prekursor</label>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="packaging" value="Packaging" required '+(d.materialCategory=="Packaging"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="packaging">Packaging</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="intermediate" value="Intermediate" required '+(d.materialCategory=="Intermediate"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="intermediate">Intermediate</label>'+
                                                        '</div>'+
                                                        '<div class="form-check">'+
                                                            '<input class="form-check-input" type="radio" name="materialCategory" id="rapidTest" value="Rapid Test" required '+(d.materialCategory=="Rapid Test"?'checked':'')+'>'+
                                                            '<label class="form-check-label" for="rapidTest">Rapid Test</label>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Material Deskripsi
                                                '<div class="mb-3">'+
                                                    '<label for="materialDeskripsi" class="form-label fw-bold">Material Deskripsi</label>'+
                                                    '<textarea class="form-control" id="materialDeskripsi" rows="3" name="materialDeskripsi" required>'+(d.materialDeskripsi !== ""?d.materialDeskripsi:'')+'</textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Material Deskripsi (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Material Spesification
                                                '<div class="mb-3">'+
                                                    '<label for="materialSpesification" class="form-label fw-bold">Material Spesification</label>'+
                                                    '<textarea class="form-control" id="materialSpesification" rows="3" name="materialSpesification" required>'+(d.materialSpesification !== ""?d.materialSpesification:'')+'</textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Material Spesification (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Catalog Or Cas Number
                                                '<div class="mb-3">'+
                                                    '<label for="catalogOrCasNumber" class="form-label fw-bold">Catalog Or CAS Number</label>'+
                                                    '<input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" value="'+(d.catalogOrCasNumber !== ""?d.catalogOrCasNumber:'')+'" '+(d.materialCategory=="Rapid Test" || d.materialCategory=="Intermediate"?'':'disabled')+' required>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Catalog Or CAS Number (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Company
                                                '<div class="mb-3">'+
                                                    '<label for="company" class="form-label fw-bold">Company</label>'+
                                                    '<input type="text" class="form-control" id="company" name="company" value="'+(d.company !== ""?d.company:'')+'" '+(d.materialCategory=="Rapid Test"?'':'disabled')+' required>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Company (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Website
                                                '<div class="mb-3">'+
                                                    '<label for="website" class="form-label fw-bold">Website</label>'+
                                                    '<input type="text" class="form-control" id="website" name="website" value="'+(d.website !== ""?d.website:'')+'" '+(d.materialCategory=="Rapid Test"?'':'disabled')+' required>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Website (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Finish Dossage Form
                                                '<div class="mb-3">'+
                                                    '<label for="finishDossageForm" class="form-label fw-bold">Finish Dossage Form</label>'+
                                                    '<input type="text" class="form-control" id="finishDossageForm" name="finishDossageForm" value="'+(d.finishDossageForm !== ""?d.finishDossageForm:'')+'" required>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Finish Dossage Form (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                // Input Keterangan
                                                '<div class="mb-3">'+
                                                    '<label for="keterangan" class="form-label fw-bold">Keterangan</label>'+
                                                    '<textarea class="form-control" id="keterangan" rows="3" name="keterangan" required>'+(d.keterangan !== ""?d.keterangan:'')+'</textarea>'+
                                                    '<div class="invalid-feedback">'+
                                                        'Masukan Keterangan (*Tandai (-) jika tidak Diisi).'+
                                                    '</div>'+
                                                '</div>'+
                                                '<input type="hidden" name="setProject" value="'+d.projectCode+'">'+ 
                                            '</div>'+
                                            '</form>'+
                                            // Modal Footer
                                            '<div class="modal-footer">'+
                                                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                                '<input type="submit" value="Submit" class="btn btn-primary" name="submit" form="formMaterial'+d.id+'">'+   
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                                )
                            }
                        },
                    ],
                });
                $('#table-material'+row.data().projectCode).on('click', 'td.dt-control', function () {
                            var tr = $(this).closest('tr');
                            var row = materialTable.row(tr);
                    
                            if (row.child.isShown()) {
                                // This row is already open - close it
                                destroyChildTableMaterial(row)
                                tr.removeClass('shown');
                            } else {
                                // Open this row
                                createChildTableSupplier(row);
                                tr.addClass('shown');
                            }
                });
            });
        }

        function destroyChildTableMaterial(row) {
            var table = $("#table-material"+row.data().projectCode, row.child());
            table.DataTable().clear().destroy();
        
            // And then hide the row
            row.child.hide();
        }

        function tableSupplier(d){
            return (
                '<div class="container-fluid" style="width:60%">'+
                    '<table id="table-supplier'+d+'" style="width:150%" >'+
                        '<thead class="bg-warning">'+
                            '<tr>'+
                                '<th></th>'+
                                '<th style="font-size:14px" class="text-center">Supplier</th>'+
                                '<th style="font-size:14px" class="text-center">Manufacture</th>'+
                                '<th style="font-size:14px" class="text-center">Origin Country</th>'+
                                '<th style="font-size:14px" class="text-center">MoQ</th>'+
                                '<th style="font-size:14px" class="text-center">UoM</th>'+
                                '<th style="font-size:14px" class="text-center">Price</th>'+
                                '<th style="font-size:14px" class="text-center">Lead Time</th>'+
                                '<th style="font-size:14px" class="text-center">Catalog or CAS Number</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '</tbody>'+
                    '</table>'+
                '</div">'
            )
        }

        function createChildTableSupplier ( row ) {
            console.log(row.data().id)
            // Display it the child row
            row.child( tableSupplier(row.data().id) ).show();
        
            // Initialise as a DataTable
            $(document).ready(function(){
                var supplierTable = $('#table-supplier'+row.data().id).DataTable( {
                    dom: 'Bfrtip',
                    pageLength: 2,
                    scrollX: true,
                });
            })
        }

        function destroyChildTableSupplier(row) {
            var table = $("#table-supplier"+row.data().id, row.child());
            table.DataTable().clear().destroy();
        
            // And then hide the row
            row.child.hide();
        }
        
    </script>

  </body>
</html>