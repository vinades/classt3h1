<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class='alert alert-warning' role="alert">{Error}</div>
<!-- END: error -->
<form
    action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}"
    method="post" enctype='multipart/form-data'>
    <input type="hidden" class="form-control" name="id" value="{POST.id}">

    <div class="container">
        <div class="form-group">
            <label for=""><strong>Tên Album : </strong> </label>
            <input type="text" class="form-control" name="name" value="{POST.name}">
        </div>
        <div class="form-group">
            <label><strong>Image : </strong></label>
            <input type="file" name="uploadfile" value="{POST.uploadfile}">
        </div>
        <div class="form-group">
            <label for=""><strong>Mô tả : </strong></label>
            <textarea name="description" class="form-control" rows="3">{POST.description}</textarea>
        </div>
        <div class="text-center">
            <input class="btn btn-primary" name="submit" type="submit" value="submit" />
        </div>

    </div>
</form>
<!-- END: main -->