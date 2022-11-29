<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
            padding-right: 0px;
        }
        table.dataTable tbody td div.detail{
            padding: 0px;
        }
    </style>
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
                ajax: "controller/viewProject.php",
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
                ],
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
                        url: "controller/viewMaterial.php",
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
                    '<button class="btn btn-primary mb-2" type="button" data-bs-target="#tambahSupplier'+d+'" data-bs-toggle="modal">Tambah Supplier</button>'+
                     // Modal Form Edit Material
                     '<div class="modal" id="tambahSupplier'+d+'" data-bs-backdrop="static" name="'+d+'">'+
                        '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                            '<div class="modal-content" style="width: 500px;">'+
                                // Modal Header
                                '<div class="modal-header">'+
                                    '<h5 class="modal-title">Tambah Supplier</h5>'+
                                '</div>'+
                                // Modal Body
                                '<div class="modal-body">'+
                                '<form action="controller/actionSupplier.php" method="post" class="was-validated" id="formSupplier">'+
                                    '<input type="hidden" name="id" value="'+d+'">'+
                                    // Input Supplier
                                    '<div class="mb-3">'+
                                        '<label for="supplier" class="form-label fw-bold">Supplier</label>'+
                                        '<input type="text" class="form-control" id="supplier" name="supplier" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    // Input Manufacture
                                    '<div class="mb-3">'+
                                        '<label for="manufacture" class="form-label fw-bold">Manufacture</label>'+
                                        '<input type="text" class="form-control" id="manufacture" name="manufacture" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Manufacture (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    // Input Origin Country
                                    '<div class="mb-3">'+
                                        '<label for="originCountry" class="form-label fw-bold">Origin Country</label>'+
                                        '<input type="text" class="form-control" id="originCountry" name="originCountry" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Origin Country (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    //Input Lead Name
                                    '<div class="mb-3">'+
                                        '<label for="leadName" class="form-label fw-bold">Lead Name</label>'+
                                        '<input type="date" class="form-control" id="leadName" name="leadName" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Lead Name (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    //Input Catalog or CAS Number
                                    '<div class="mb-3">'+
                                        '<label for="catalogOrCasNumber" class="form-label fw-bold">Catalog or CAS Number</label>'+
                                        '<input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Catalog or CAS Number (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    // Grade/Reference Standard
                                    '<div class="mb-3">'+
                                        '<label for="gradeOrReferenceStandard" class="form-label fw-bold">Grade/Reference Standard</label>'+
                                        '<input type="text" class="form-control" id="gradeOrReferenceStandard" name="gradeOrReferenceStandard" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Grade/Reference Standard (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                    // Document Info
                                    '<div class="mb-3">'+
                                        '<label for="documentInfo" class="form-label fw-bold">Document Info</label>'+
                                        '<input type="text" class="form-control" id="documentInfo" name="documentInfo" required>'+
                                        '<div class="invalid-feedback">'+
                                            'Masukan Document Info (*Tandai (-) jika tidak Diisi).'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '</form>'+
                                // Modal Footer
                                '<div class="modal-footer">'+
                                    '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                    '<input type="submit" value="Submit" class="btn btn-primary" name="tambahSupplier" form="formSupplier">'+   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+  

                    '<table id="table-supplier'+d+'" style="width:150%" >'+
                        '<thead class="bg-warning">'+
                            '<tr>'+
                                '<th style="font-size:14px" class="text-center">Supplier</th>'+
                                '<th style="font-size:14px" class="text-center">Manufacture</th>'+
                                '<th style="font-size:14px" class="text-center">Origin Country</th>'+
                                '<th style="font-size:14px" class="text-center">Lead Time</th>'+
                                '<th style="font-size:14px" class="text-center">Information MoQ, UoM, Price</th>'+
                                '<th style="font-size:14px" class="text-center">Catalog or CAS Number</th>'+
                                '<th style="font-size:14px" class="text-center">Grade/Reference Standard</th>'+
                                '<th style="font-size:14px" class="text-center">Document Info</th>'+
                                // '<th style="font-size:14px" class="text-center">Action Document</th>'+
                                // '<th style="font-size:14px" class="text-center">Feedback R&D</th>'+
                                // '<th style="font-size:14px" class="text-center">Feedback Proc</th>'+
                                // '<th style="font-size:14px" class="text-center">Final Feedback R&D</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '</tbody>'+
                    '</table>'+
                '</div">'
            )
        }

        function createChildTableSupplier ( row ) {
            // Display it the child row
            row.child( tableSupplier(row.data().id) ).show();
        
            // Initialise as a DataTable
            $(document).ready(function(){
                var supplierTable = $('#table-supplier'+row.data().id).DataTable( {
                    dom: 'Bfrtip',
                    pageLength: 2,
                    scrollX: true,
                    pagging: false,
                    ajax: {
                        url: "controller/viewSupplier.php",
                        type: "get",
                        data: {
                            materialCode : row.data().id
                        },
                    },
                    columns: [
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.supplier+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.manufacture+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.originCountry+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.leadTime+'</p>')
                            }
                        },
                        {
                            render: function (data, type, row, meta) {
                                $.get("controller/viewDetailSupplier.php",
                                {
                                    idSupplier: row.id,
                                },
                                function(data){
                                    $('#tableDetailSupplier'+row.id).html(data)
                                });
                                return (
                                    '<div class="text-center">'+
                                        '<div id="tableDetailSupplier'+row.id+'" class="d-flex justify-content-center detail"></div>'+
                                        '<button class="btn btn-primary btn-sm" type="button" data-bs-target="#tambahDetailSupplier'+row.id+'" data-bs-toggle="modal">Tambah</button>'+
                                        // Modal Form Edit Material
                                        '<div class="modal" id="tambahDetailSupplier'+row.id+'" data-bs-backdrop="static">'+
                                            '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                                '<div class="modal-content" style="width: 500px;">'+
                                                    // Modal Header
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title">Tambah Informasi MoQ, UoM, Price</h5>'+
                                                    '</div>'+
                                                    // Modal Body
                                                    '<div class="modal-body">'+
                                                    '<form action="controller/actionSupplier.php" method="post" class="was-validated" id="formDetailSupplier'+row.id+'">'+
                                                        '<input type="hidden" name="id" value="'+row.id+'">'+
                                                        // Input Information MoQ, UoM, Price
                                                        '<div class="mb-3">'+
                                                            '<label class="form-label fw-bold mb-1">Informasi MoQ, UoM, Price</label>'+
                                                            '<hr>'+
                                                                '<div class="bg-warning" style="height:320px;overflow-x:hidden">'+
                                                                    '<div class="after-add-more">'+
                                                                        '<span class="ms-2">Informasi 1</span><br>'+
                                                                        // Input MoQ
                                                                        '<label for="MoQ" class="form-label fw-bold ms-2">MoQ</label>'+
                                                                        '<input type="text" class="form-control ms-2" id="MoQ" name="MoQ" style="width:410px" required>'+
                                                                        '<div class="invalid-feedback ms-2">'+
                                                                            'Masukan MoQ (*Tandai (-) jika tidak Diisi).'+
                                                                        '</div>'+
                                                                        // Input UoM
                                                                        '<label for="UoM" class="form-label fw-bold ms-2">UoM</label>'+
                                                                        '<input type="text" class="form-control ms-2" id="UoM" name="UoM" style="width:410px" required>'+
                                                                        '<div class="invalid-feedback ms-2">'+
                                                                            'Masukan UoM (*Tandai (-) jika tidak Diisi).'+
                                                                        '</div>'+
                                                                        // Input Price
                                                                        '<label for="price" class="form-label fw-bold ms-2">Price</label>'+
                                                                        '<input type="text" class="form-control ms-2" id="price" name="price" style="width:410px" required>'+
                                                                        '<div class="invalid-feedback ms-2">'+
                                                                            'Masukan Price (*Tandai (-) jika tidak Diisi).'+
                                                                        '</div>'+
                                                                        // '<a class="btn btn-primary mt-2 ms-2 add-more"> add </a>'+
                                                                        '<hr class="m-0 mt-2">'+
                                                                    '</div>'+
                                                                '</div>'+
                                                            '<hr>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '</form>'+
                                                    // Modal Footer
                                                    '<div class="modal-footer">'+
                                                        '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                                        '<input type="submit" value="Submit" class="btn btn-primary" name="tambahDetailSupplier" form="formDetailSupplier'+row.id+'">'+   
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                )
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.catalogOrCasNumber+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.gladeOrReferenceStandard+'</p>')
                            }
                        },
                        {
                            data: function(d){
                                return('<p class="text-center" style="font-size:13px">'+d.documentInfo+'</p>')
                            }
                        },
                    ]
                });

                $(".add-more").click(function(){
                    var html = '<div class="copy-group">'+
                                    '<span class="ms-2">Informasi 2</span><br>'+
                                    // Input MoQ
                                    '<label for="MoQ" class="form-label fw-bold ms-2">MoQ</label>'+
                                    '<input type="text" class="form-control ms-2" id="MoQ" name="MoQ[]" style="width:410px" required>'+
                                    '<div class="invalid-feedback ms-2">'+
                                        'Masukan MoQ (*Tandai (-) jika tidak Diisi).'+
                                    '</div>'+
                                    // Input UoM
                                    '<label for="UoM" class="form-label fw-bold ms-2">UoM</label>'+
                                    '<input type="text" class="form-control ms-2" id="UoM" name="UoM[]" style="width:410px" required>'+
                                    '<div class="invalid-feedback ms-2">'+
                                        'Masukan UoM (*Tandai (-) jika tidak Diisi).'+
                                    '</div>'+
                                    // Input Price
                                    '<label for="price" class="form-label fw-bold ms-2">Price</label>'+
                                    '<input type="text" class="form-control ms-2" id="price" name="price[]" style="width:410px" required>'+
                                    '<div class="invalid-feedback ms-2">'+
                                        'Masukan Price (*Tandai (-) jika tidak Diisi).'+
                                    '</div>'+
                                    '<button class="btn btn-danger mt-2 ms-2 remove"> remove </button>'+
                                    '<hr class="m-0 mt-2">'+
                                '</div>';
                    $(".after-add-more").after(html);
                });

                $("body").on("click",".remove",function(){ 
                    $(this).parents(".copy-group").remove();
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