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
                <table class="display nowrap" id="table-project" style="width:100%">
                    <thead>
                        <tr>
                            <td style="width:5%"></td>
                            <td style="width:5%">No</td>
                            <td style="width:80%">Name</td>
                        </tr>
                    </thead>
                </table>
                <!-- -- -->
            </div>            
        </div>
        <!-- -- -->
    </div>

    <script>
    $(document).ready(function(){
            // Deklarasi datatable dan isi dari tabel project
            var projectTable = $('#table-project').DataTable({
                order: [ 1, 'asc' ],
                oLanguage: {
                    sSearch: "Search Project"
                },
                lengthMenu: [5 , 15 , 20],
                ajax: "controller/viewProject.php",
                columns: [
                    {   
                        // Icon click, untuk melakukan event click yang menampilkan tabel material
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        // Menampilkan nomer data
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}
                    },
                    { 
                        // Menampilkan projectCode dan ProjectName
                        data: null, render: function ( data, type, row ) {
                        return data.projectCode+' | '+data.projectName;} 
                    },
                ],
            });

            // Menampilkan tabel material, apabila user melakukan event click ditabel project
            $('#table-project tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                // Membuat variabel untuk mengambil data project dibaris yang mengalami event click
                var row = projectTable.row(tr);
        
                if (row.child.isShown()) {
                    // Menghilangkan tabel material jika event click ditutup
                    destroyChildTableMaterial(row)
                    tr.removeClass('shown');
                } else {
                    // Menampilkan tabel material jika event click dilakukan
                    createChildTableMaterial(row);
                    tr.addClass('shown');
                }
            });
            
        });

        // Membuat Tabel Material didalam sebuah fungsi
        function tableMaterial(d){
            return (
                '<div class="container-fluid m-0 p-0" style="width:1050px">'+
                    // Tabel Material
                    '<table id="table-material'+d+'" class="row-border stripe hover p-2">'+
                        '<thead class="bg-primary" >'+
                            '<tr>'+
                                '<th></th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Material Category</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Material Desc</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Spesification</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Catalog Or CAS Number</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Company</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Website</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Finish Dossage Form</th>'+
                                '<th scope="col" style="font-size: 11px" class="text-center">Keterangan</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '</tbody>'+
                    '</table>'+
                    // --
                '</div">'
            )
        }

        // Fungsi untuk menampilkan tabel material ketika event click ditabel project terjadi
        function createChildTableMaterial ( row ) {
            // Memanggil fungsi untuk menampilkan baris anak, yaitu tabel material
            row.child( tableMaterial(row.data().projectCode) ).show();
        
            // Menginisialisasi datatable dan mengisi nilai dari setiap colums data body ditabel material melalui datatable
            $(document).ready(function(){
                var materialTable = $('#table-material'+row.data().projectCode).DataTable( {
                    dom: 'Bfrtip',
                    oLanguage: {
                        sSearch: "Search Material"
                    },
                    autoWidth: false,
                    pageLength: 2,
                    scrollX: true,
                    // Melakukan passing data menggunakan ajax
                    ajax: {
                        url: "controller/viewMaterial.php",
                        type: "get",
                        data: {
                            // Mengirim data projectCode melalui method get ke URL
                            projectCode : row.data().projectCode
                        },
                    },
                    columns: [
                        {
                            // Icon click, untuk melakukan event click yang menampilkan tabel supplier
                            className: 'dt-control ',
                            orderable: false,
                            data: null,
                            defaultContent: '',
                        },
                        {
                            // Menampilkan data material category dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.materialCategory+'</div>')
                            }
                        },
                        {
                            // Menampilkan data material deskripsi dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.materialDeskripsi+'</div>')
                            }
                        },
                        {
                            // Menampilkan data material spesification dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.materialSpesification+'</div>')
                            }
                        },
                        {
                            // Menampilkan data catalog or cas number dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.catalogOrCasNumber+'</div>')
                            }
                        },
                        {
                            // Menampilkan data company dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.company+'</div>')
                            }
                        },
                        {
                            // Menampilkan data website dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.website+'</div>')
                            }
                        },
                        {
                            // Menampilkan data finish dossage form dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.finishDossageForm+'</div>')
                            }
                        },
                        {
                            // Menampilkan data keterangan dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.keterangan+'</div>')
                            }
                        },
                    ],
                });

                // Menampilkan tabel supplier, apabila user melakukan event click ditabel material
                $('#table-material'+row.data().projectCode).on('click', 'td.dt-control', function () {
                            var tr = $(this).closest('tr');
                            // Membuat variabel untuk mengambil data material dibaris yang mengalami event click
                            var row = materialTable.row(tr);
                    
                            if (row.child.isShown()) {
                                // Menghilangkan tabel supplier jika event click ditutup
                                destroyChildTableMaterial(row)
                                tr.removeClass('shown');
                            } else {
                                // Menampilkan tabel supplier jika event click dilakukan
                                createChildTableSupplier(row);
                                tr.addClass('shown');
                            }
                });
            });
        }

        // Fungsi untuk menghilangkan tabel material ketika event click ditabel project ditutup
        function destroyChildTableMaterial(row) {
            var table = $("#table-material"+row.data().projectCode, row.child());
            table.DataTable().clear().destroy();
        
            // Fungsi untuk menyembunyikan baris
            row.child.hide();
        }

        // Membuat Tabel Supplier dan form tambah supplier didalam sebuah fungsi
        function tableSupplier(d){
            return (
                '<div class="container-fluid" style="width:1080px">'+
                    // Button Tambah Supplier
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
                                    '<input type="hidden" name="idMaterial" value="'+d+'">'+
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
                                        '<input type="date" class="form-control" id="leadName" name="leadName" placeholder="dd-mm-yyyy" required>'+
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

                    // Tabel Supplier
                    '<table id="table-supplier'+d+'" style="width:150%" class="pt-2">'+
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
                                '<th style="font-size:14px" class="text-center">Action</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '</tbody>'+
                    '</table>'+
                '</div">'
            )
        }

        // Fungsi untuk menampilkan tabel supplier ketika event click ditabel material terjadi
        function createChildTableSupplier ( row ) {
            // Memanggil fungsi untuk menampilkan baris anak, yaitu tabel supplier
            row.child( tableSupplier(row.data().id) ).show();
        
            // Menginisialisasi datatable dan mengisi nilai dari setiap colums data body ditabel supplier melalui datatable
            $(document).ready(function(){
                var supplierTable = $('#table-supplier'+row.data().id).DataTable( {
                    dom: 'Bfrtip',
                    oLanguage: {
                        sSearch: "Search Supplier"
                    },
                    lengthMenu: [3 , 5 , 10],
                    pageLength: 2,
                    scrollX: true,
                    // paging: true,
                    // aaSorting: [[0,'desc'], [1,'desc']],
                    // bJQueryUI: true,
                    // bProcessing: true,
                    // bServerSide: true,
                    // Melakukan passing data menggunakan ajax
                    ajax: {
                        url: "controller/viewSupplier.php",
                        type: "get",
                        data: {
                            // Mengirim data idMaterial melalui method get ke URL
                            idMaterial : row.data().id
                        },
                    },
                    columns: [
                        {
                            // Menampilkan data supplier dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.supplier+'</div>')
                            }
                        },
                        {
                            // Menampilkan data manufacture dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.manufacture+'</div>')
                            }
                        },
                        {
                            // Menampilkan data originCounty dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.originCountry+'</div>')
                            }
                        },
                        {
                            // Menampilkan data lead time dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.leadTime+'</div>')
                            }
                        },
                        {
                            // Menampilkan data MoQ, UoM, Price dan Formulir untuk menambah data MoQ, UoM, dan Price dari hasil passing data ajax
                            render: function (data, type, row, meta) { 
                                
                                    $.get("controller/viewDetailSupplier.php",{ idSupplier: row.id,},
                                    function(data){
                                        $(document).ready(function(){
                                            $('#tableDetailSupplier'+row.id).html(data)
                                        })
                                    });
                               
                                return (
                                    '<div style="width:300px">'+
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
                            // Menampilkan data catalog or cas number dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.catalogOrCasNumber+'</div>')
                            }
                        },
                        {
                            // Menampilkan data glade or reference standard dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.gladeOrReferenceStandard+'</div>')
                            }
                        },
                        {
                            // Menampilkan data document info dari hasil passing data ajax
                            data: function(d){
                                return('<div class="text-center text-wrap" style="font-size:13px;width:250px">'+d.documentInfo+'</div>')
                            }
                        },
                        {
                            // Menampilkan action supplier
                            data: function(d){
                                return(
                                     // Button
                                    '<div class="text-center">'+
                                        // Button Edit Supplier
                                        '<button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editSupplier'+d.id+'" data-bs-toggle="modal">Edit</button>'+
                                        // Button Delete
                                        '<a href="controller/actionSupplier.php?action_type=delete&idSupplier='+d.id+'" class="btn btn-danger btn-sm d-inline ms-1" id="delete">Delete</a>'+
                                    '</div>'+

                                    // Modal Form Edit Supplier
                                    '<div class="modal" id="editSupplier'+d.id+'" data-bs-backdrop="static" name="'+d.id+'">'+
                                        '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                            '<div class="modal-content" style="width: 500px;">'+
                                                // Modal Header
                                                '<div class="modal-header">'+
                                                    '<h5 class="modal-title">Tambah Material Project</h5>'+
                                                '</div>'+
                                                // Modal Body
                                                '<div class="modal-body">'+
                                                '<form action="controller/actionSupplier.php" method="post" class="was-validated" id="formSupplierEdit'+d.id+'">'+
                                                    '<input type="hidden" name="idSupplier" value="'+d.id+'">'+
                                                    // Input Supplier
                                                    '<div class="mb-3">'+
                                                        '<label for="supplier" class="form-label fw-bold">Supplier</label>'+
                                                        '<input type="text" class="form-control" id="supplier" name="supplier" value="'+(d.supplier !== ""?d.supplier:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Manufakture
                                                    '<div class="mb-3">'+
                                                        '<label for="manufacture" class="form-label fw-bold">Manufacture</label>'+
                                                        '<input type="text" class="form-control" id="manufacture" name="manufacture" value="'+(d.manufacture !== ""?d.manufacture:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Origin Country
                                                    '<div class="mb-3">'+
                                                        '<label for="originCountry" class="form-label fw-bold">Origin Country</label>'+
                                                        '<input type="text" class="form-control" id="originCountry" name="originCountry" value="'+(d.originCountry !== ""?d.originCountry:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Lead Name
                                                    '<div class="mb-3">'+
                                                        '<label for="leadName" class="form-label fw-bold">Lead Name</label>'+
                                                        '<input type="date" class="form-control" id="leadName" name="leadName" value="'+(d.leadTime !== ""?d.leadTime:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Catalog or CAS Number
                                                    '<div class="mb-3">'+
                                                        '<label for="catalogOrCasNumber" class="form-label fw-bold">Catalog or CAS Number</label>'+
                                                        '<input type="text" class="form-control" id="catalogOrCasNumber" name="catalogOrCasNumber" value="'+(d.catalogOrCasNumber !== ""?d.catalogOrCasNumber:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Grade/Reference Standard
                                                    '<div class="mb-3">'+
                                                        '<label for="gladeOrReferenceStandard" class="form-label fw-bold">Glade/Reference Standard</label>'+
                                                        '<input type="text" class="form-control" id="gladeOrReferenceStandard" name="gladeOrReferenceStandard" value="'+(d.gladeOrReferenceStandard !== ""?d.gladeOrReferenceStandard:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                    // Input Document Info
                                                    '<div class="mb-3">'+
                                                        '<label for="documentInfo" class="form-label fw-bold">Document Info</label>'+
                                                        '<input type="text" class="form-control" id="documentInfo" name="documentInfo" value="'+(d.documentInfo !== ""?d.documentInfo:'')+'" required>'+
                                                        '<div class="invalid-feedback">'+
                                                            'Masukan Supplier (*Tandai (-) jika tidak Diisi).'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '</form>'+
                                                // Modal Footer
                                                '<div class="modal-footer">'+
                                                    '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                                    '<input type="submit" value="Submit" class="btn btn-primary" name="editSupplier" form="formSupplierEdit'+d.id+'">'+   
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                )
                            }
                        },
                    ]
                });

                // Event click untuk menambah form tambah MoQ, UoM, dan price
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

                // Event Click untuk menghapus form tambah MoQ, UoM dan Price
                $("body").on("click",".remove",function(){ 
                    $(this).parents(".copy-group").remove();
                });
            })
        }

        // Fungsi untuk menghilangkan tabel supplier ketika event click ditabel project ditutup
        function destroyChildTableSupplier(row) {
            var table = $("#table-supplier"+row.data().id, row.child());
            table.DataTable().clear().destroy();
        
            // Fungsi untuk menyembunyikan baris
            row.child.hide();
        }
    </script>

  </body>
</html>