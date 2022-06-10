<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 27/02/2020
 * Time: 09:13 AM
 */

$file = 'list.php';
switch ($action) {
    case 'list':
        $file = 'actions/list.php';
        break;
    case 'delete':
        $file = 'actions/delete.php';
        break;
    case 'detail':
        $file = 'actions/detail.php';
        break;
}

require_once ($file);