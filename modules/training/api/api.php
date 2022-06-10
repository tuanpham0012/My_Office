<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 07/02/2020
 * Time: 10:31 PM
 */

switch ($action) {
    case 'get_list_user':
        /* URL: http://localhost/php-module/index.php?m=api&a=get_list_user&page_index=1&page_size=10 */
        $prarams=' ORDER BY name LIMIT ' . ($page_index-1)*$page_size . ','.$page_size;
        $users = query($conn,'*', 'users', $prarams);
        responseApi(200, 'Lấy danh sách USER thành công.', $users);
        break;
    case 'get_user_detail':
        /* URL: http://localhost/php-module/index.php?m=api&a=get_user_detail&id=1 */
        $user = query($conn, '*', 'users', ' WHERE id=' . $id);
        if (isset($user[0])) {
            responseApi(200, 'Thông tin chi tiết USER.', $user[0]);
        } else {
            responseApi(400, 'Không tìm thấy thông tin USER.', null);
        }
        break;
    default:
        /* Gọi sai đường dẫn API */
        responseApi(404, 'Không tìm thấy thông tin API.', null);
}