<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_ALBUM')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];

$error=[];

/* Kiểm tra album_name */

//bắt biến album_name

if ($nv_Request->isset_request('submit', 'post') && !empty($nv_Request->get_title('album_name', 'post', '')))
{
    $album_name = $nv_Request->get_title('album_name', 'post', '');
} else {$error[] = 'Bạn chưa nhập tên album';}
//------------------
// Kiểm tra file ảnh gửi lên
//------------------
if ($nv_Request->isset_request('submit', 'post') and isset($_FILES, $_FILES['album_thumbnail'], $_FILES['album_thumbnail']['tmp_name']) and is_uploaded_file($_FILES['album_thumbnail']['tmp_name'])) {

    // Khởi tạo Class upload
    $upload = new NukeViet\Files\Upload($admin_info['allow_files_type'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
    
    // Thiết lập ngôn ngữ, nếu không có dòng này thì ngôn ngữ trả về toàn tiếng Anh
    $upload->setLanguage($lang_global);
    
    // Tải file lên server
    $upload_info = $upload->save_file($_FILES['album_thumbnail'], NV_UPLOADS_REAL_DIR , false, $global_config['nv_auto_resize']);
    
    if ($upload_info['error'] == '') {
        $image = new NukeViet\Files\Image(NV_UPLOADS_REAL_DIR . '/' . $upload_info['basename'], NV_MAX_WIDTH, NV_MAX_HEIGHT);

        $image->resizeXY(100, 100);
        $newname = NV_CURRENTTIME . '_' . $album_name . '_thumbnail_' . $upload_info['basename'];
        $quality = 100;
        $image->save(NV_UPLOADS_REAL_DIR . '/', $newname, $quality);
        $image->close();
        $info = $image->create_Image_info;
        //lấy biến
        $album_thumbnail = $newname;
    } else {
        $error[] = $upload_info['error'];
    }
} else {$error[] = 'upload lỗi';}
//------------------
// END Kiểm tra file ảnh
//------------------

//------------------
// Lưu thông tin album vào Database
//------------------
if (empty($error))
{
    try {
        $sql = "INSERT INTO `nv4_vi_album` (`album_name`, `album_thumbnail`, `create_time`, `update_time`) VALUES (:album_name,:album_thumbnail, :create_time, :update_time)";
        $s = $db->prepare($sql);
        $s->bindParam('album_name', $album_name);
        $s->bindParam('album_thumbnail', $album_thumbnail);
        $s->bindValue('create_time', NV_CURRENTTIME);
        $s->bindValue('update_time', 0);
        $s->execute();

        $alert = 'Tạo album mới thành công';
    } catch (PDOException $e) {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
        die();
    }
    
}
//------------------
// END 
//------------------


$contents = nv_theme_album_main($array_data, $error, $alert);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
