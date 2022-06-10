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
        $file = 'list.php';
        break;
    case 'detail':
        $file = 'detail.php';
        break;
    case 'add':
        $file = 'add.php';
        break;
    case 'edit':
        $file = 'edit.php';
        break;
    case 'delete':
        $file = 'delete.php';
        break;
}

require_once ($file);
