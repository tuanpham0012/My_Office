<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 09:02 AM
 * https://dantri.com.vn/trangchu.rss
 * https://vnexpress.net/rss/tin-moi-nhat.rss
 */

 $file = '';
switch ($action) {
    case 'dantri.com.vn':
        $file = 'actions/dantri.php';
        break;
    case 'vnexpress.net':
        $file = 'actions/vnexpress.php';
        break;
    default: die('<div class="col-lg-12 mt-2"><h3>Không tìm thấy trang</h3></div>');
}

require_once ($file);