<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 08/02/2020
 * Time: 08:30 AM
 */

$file = '';

switch ($action) {
    case 'get_task_list':
        $file = 'get_task_list.php';
        break;
    default:
}

require_once ($file);
die();
