<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

//------------------------------
// Viết code xử lý chung vào đây


$album =  $db->query("SELECT * FROM nv4_classt3h1_album");

// ========= Xóa dữ liệu ========== //

if ($nv_Request->isset_request("action", "post,get")) {
    $id_delete = $nv_Request->get_int('id', 'post,get', 0);
    $checksess = $nv_Request->get_title('checksess', 'post,get', 0);
    if ($id_delete > 0 and $checksess == md5($id_delete . NV_CHECK_SESSION)) {
        $db->query("DELETE FROM `nv4_classt3h1_album` WHERE id=" . $id_delete);
    }
}
// =============================== //

//------------------------------

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

//-------------------------------
// Viết code xuất ra site vào đây
$i = 1;

foreach ($album as $album) {
    // Sử dụng assign, gán giá trị $array cho DATA
    $album['stt'] = $i;

    $album['url_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .
        '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=create_album&amp;id=' . $album['id'];
    $album['url_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE .
        '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=album&amp;id=' . $album['id'] . '&action=delete&checksess=' . md5($album['id'] . NV_CHECK_SESSION);

    $xtpl->assign('AB', $album);
    $xtpl->parse('main.album');
    $i++;
}

//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';