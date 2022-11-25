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
                    '<table id="table-supplier'+d+'" style="width:200%" >'+
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
                                '<th style="font-size:14px" class="text-center">Grade/Reference Standard</th>'+
                                '<th style="font-size:14px" class="text-center">Document Info</th>'+
                                '<th style="font-size:14px" class="text-center">Action Document</th>'+
                                '<th style="font-size:14px" class="text-center">Feedback R&D</th>'+
                                '<th style="font-size:14px" class="text-center">Feedback Proc</th>'+
                                '<th style="font-size:14px" class="text-center">Final Feedback R&D</th>'+
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