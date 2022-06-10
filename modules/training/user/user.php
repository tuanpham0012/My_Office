<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 05/02/2020
 * Time: 11:12 AM
 */
$file = 'list.php';
switch ($action) {
    case 'list':
        $file = 'actions/list.php';
        break;
    case 'detail':
        $file = 'actions/detail.php';
        break;
    case 'add':
        $file = 'actions/add.php';
        break;
    case 'edit':
        $file = 'actions/edit.php';
        break;
    case 'delete':
        $file = 'actions/delete.php';
        break;
    case 'send_mail':
        $file = 'actions/send_mail.php';
        break;
}

require_once ($file);
