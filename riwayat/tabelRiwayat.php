<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container position-relative" style="margin-left:275px">
         <table class="table" style="width:200%" id="table-riwayat">
            <thead>
                <tr class="bg-danger bg-opacity-75">
                    <th scope="col" style="font-size: 15px;width:1%" class="text-center">No</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Material Deskripsi</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Date Sourcing</th>
                    <th scope="col" style="font-size: 15px;width:10%" class="text-center">Project Code</th>
                    <th scope="col" style="font-size: 15px;width:8%" class="text-center">Project Name</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Team Leader</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Researcher</th>
                    <th scope="col" style="font-size: 15px;width:4%" class="text-center">Feedback TL</th>
                    <th scope="col" style="font-size: 15px;width:4%" class="text-center">Feedback RPIC</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Date Approved TL</th>
                    <th scope="col" style="font-size: 15px;width:5%" class="text-center">Date Accepted RPIC</th>
                    <th scope="col" style="font-size: 15px;width:4%" class="text-center">Status</th>
                    <th scope="col" style="font-size: 15px;width:10%" class="text-center">Edit Material</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var tableRiwayat = $('#table-riwayat').DataTable({
                ajax: "controller/viewRiwayat.php",
                scrollX: true,
                columns: [
                    {
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;}
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.materialDeskripsi+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.dateSourcing+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.projectCode+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.projectName+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.teamLeader+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return ('<p class="text-center">'+d.researcher+'</p>')
                        }
                    },
                    {
                        data: function(d) {
                            return (
                                '<form action="controller/actionRiwayat.php" method="POST">'+
                                    '<input type="hidden" name="setID" value="'+d.id+'">'+
                                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackTL">'+
                                        '<option '+(d.feedbackTL==0?'selected':'')+' value=0>No Action</option>'+
                                        '<option '+(d.feedbackTL == 1?'selected':'')+' value=1>Approved</option>'+
                                    '</select>'+
                                '</form>'
                            )
                        }
                    },
                    {
                        data: function(d) {
                            return (
                                '<form action="controller/actionRiwayat.php" method="POST">'+
                                    '<input type="hidden" name="setID" value="'+d.id+'">'+
                                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="feedbackRPIC">'+
                                        '<option '+(d.feedbackRPIC==0?'selected':'')+' value=0>No Action</option>'+
                                        '<option '+(d.feedbackRPIC == 1?'selected':'')+' value=1>Accepted</option>'+
                                    '</select>'+
                                '</form>'
                            )
                        }
                    },
                    {
                        data: function(d) {
                            return (
                                '<p class="text-center">'+(d.dateApprovedTL==null?"":d.dateApprovedTL)+'</p>'
                            )
                        }
                    },
                    {
                        data: function(d) {
                            return (
                                '<p class="text-center">'+(d.dateAcceptedRPIC==null?"":d.dateAcceptedRPIC)+'</p>'
                            )
                        }
                    },
                    {
                        data: function(d) {
                            return (
                                '<form action="controller/actionRiwayat.php" method="POST">'+
                                    '<input type="hidden" name="setID" value="'+d.id+'">'+
                                    '<select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="this.form.submit();" name="status">'+
                                        '<option '+(d.status=="ON PROSES"?'selected':'')+' value="ON PROSES">ON PROSES</option>'+
                                        '<option '+(d.status=="HOLD"?'selected':'')+' value="HOLD">HOLD</option>'+
                                        '<option '+(d.status=="CANCEL"?'selected':'')+' value="CANCEL">CANCEL</option>'+
                                    '</select>'+
                                '</form>'
                            )
                        }
                    },
                    {
                        data: function(d){
                                return(
                                // Button
                                '<div class="text-center">'+
                                    // Button Edit Material
                                    '<button class="btn btn-warning btn-sm d-inline ms-1" type="button" data-bs-target="#editMaterial'+d.id+'" data-bs-toggle="modal">Edit</button>'+
                                    // Button View Material
                                    '<button class="btn btn-success btn-sm d-inline ms-1" type="button" data-bs-target="#viewMaterial'+d.id+'" data-bs-toggle="modal">View</button>'+ 
                                    // Button Delete
                                    '<a href="controller/actionRiwayat.php?action_type=delete&id='+d.id+'" class="btn btn-danger btn-sm d-inline ms-1" id="delete">Delete</a>'+
                                '</div>'+

                                // Modal Form Edit Material
                                '<div class="modal" id="editMaterial'+d.id+'" data-bs-backdrop="static" name="'+d.id+'">'+
                                    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                        '<div class="modal-content" style="width: 500px;">'+
                                            // Modal Header
                                            '<div class="modal-header">'+
                                                '<h5 class="modal-title">Tambah Material Project</h5>'+
                                            '</div>'+
                                            // Modal Body
                                            '<div class="modal-body">'+
                                            '<form action="controller/actionRiwayat.php" method="post" class="was-validated" id="formMaterial'+d.id+'">'+
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
                                            '</div>'+
                                            '</form>'+
                                            // Modal Footer
                                            '<div class="modal-footer">'+
                                                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                                '<input type="submit" value="Submit" class="btn btn-primary" name="edit" form="formMaterial'+d.id+'">'+   
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+

                                // Modal Form View Material
                                '<div class="modal" id="viewMaterial'+d.id+'" data-bs-backdrop="static" name="'+d.id+'">'+
                                    '<div class="modal-dialog modal-sm modal-dialog-scrollable">'+
                                        '<div class="modal-content" style="width: 500px;">'+
                                            // Modal Header
                                            '<div class="modal-header">'+
                                                '<h5 class="modal-title">Detail Material</h5>'+
                                            '</div>'+
                                            // Modal Body
                                            '<div class="modal-body">'+
                                                '<h5>Material Cartegory : </h5>'+
                                                '<p class="mb-2">'+d.materialCategory+'</p>'+
                                                '<h5>Material Deskripsi: </h5>'+
                                                '<p class="mb-2">'+d.materialDeskripsi+'</p>'+
                                                '<h5>Material Spesification: </h5>'+
                                                '<p class="mb-2">'+d.materialSpesification+'</p>'+
                                                '<h5>Catalog Or Cas Number: </h5>'+
                                                '<p class="mb-2">'+d.catalogOrCasNumber+'</p>'+
                                                '<h5>Company: </h5>'+
                                                '<p class="mb-2">'+d.company+'</p>'+
                                                '<h5>Website: </h5>'+
                                                '<p class="mb-2">'+d.website+'</p>'+
                                                '<h5>Finish Dossage Form: </h5>'+
                                                '<p class="mb-2">'+d.finishDossageForm+'</p>'+
                                                '<h5>Keterangan: </h5>'+
                                                '<p class="mb-2">'+d.keterangan+'</p>'+
                                            '</div>'+
                                            // Modal Footer
                                            '<div class="modal-footer">'+
                                                '<button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Back</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                                )
                            }
                    },
                ]
            })
            $( "#table-riwayat tbody" ).on('click', 'input#api',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#ekstrak',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#excipient',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#napsipre',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#packaging',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#intermediate',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").removeAttr("disabled");
                $("#table-riwayat tbody input#company").attr('disabled', 'disabled');
                $("#table-riwayat tbody input#website").attr('disabled', 'disabled');
            });
            $( "#table-riwayat tbody" ).on('click', 'input#rapidTest',function() {
                $("#table-riwayat tbody input#catalogOrCasNumber").removeAttr("disabled");
                $("#table-riwayat tbody input#company").removeAttr("disabled");
                $("#table-riwayat tbody input#website").removeAttr("disabled");
            });
            $('#table-riwayat').on('click', 'a#delete', function(){
                return confirm("Apakah anda yakin untuk menghapus material ini?")
            })
        });
    </script>
  </body>
</html>