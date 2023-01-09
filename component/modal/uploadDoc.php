<?php
    // me-redirect saat user masuk kehalaman ini
    if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
        header('Location: ../../dashboard/index.php');
        exit();
    };
?>


<!-- Modal Upload Document -->
<div class="modal" id="uploadDoc<?php echo $row['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 1500px;">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">File Upload</h1>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadFile<?php echo $row['id']?>">
                    <input type="hidden" name="idSupplier" value="<?php echo $row['id']?>">
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input type="file" class="form-control" id="file" name="file" required />
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info submitBtn mt-3" onclick="funcUploadDoc(<?php echo $row['id']?>)">Submit</button>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // File type validation
        $('#file').change(function(){
            var file = this.files[0];
            var fileType = file.type;
            var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                $("#file").val('');
                return false;
            }
        })
    })
</script>