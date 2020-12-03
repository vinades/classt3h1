<!-- BEGIN: main -->
<form
    action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}"
    method="post">
    <div style="color: red;">
        <h1><strong>Danh sách Album</strong></h1>
    </div>
    <table style="margin-top: 30px;" class="table table-striped table-bordered table-hover">
        <tr class="text-center">
            <th class="text-nowrap text-center" style="width: 100px;">Thứ tự</th>
            <th class="text-nowrap text-center">Tên Album</th>
            <th class="text-nowrap text-center">Ảnh</th>
            <th class="text-nowrap text-center">Mô tả</th>
            <th class="text-nowrap text-center">Trạng thái</th>
            <th class="text-nowrap text-center">Ngày tạo</th>
            <th class="text-center text-nowrap">Chức năng</th>
        </tr>
        </thead>
        <tbody>
            <!-- BEGIN: album -->
            <tr>
                <td class="text-center">{AB.stt}</td>
                <td class="text-center">{AB.name}</td>
                <td class="text-center">
                    <img src="{AB.image}" width="100px" height="100px">
                </td>
                <td class="text-center">{AB.description}</td>
                <td style="text-align: center;">
                    <input name="status" type="checkbox">
                </td>
                <td class="text-center">{AB.date}</td>
                <td class="text-center text-nowrap">
                    <a href="{AB.url_edit}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="{AB.url_delete}" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i>
                        Xóa</a>
                </td>
            </tr>
            <!-- END: album -->
        </tbody>
    </table>
</form>

<script>
// ==== Xóa dữ liệu  ===== //
$(document).ready(function() {
    $('.delete').click(function() {
        if (confirm("Bạn có chắc chắn muốn xóa?")) {
            return true;
        } else {
            return false;
        }
    });

});
// ================================ //
</script>
<!-- END: main -->