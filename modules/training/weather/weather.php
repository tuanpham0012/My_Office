<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 16/02/2020
 * Time: 11:38 AM
 */

$file = '';
switch ($action) {
    case 'edupham':
        $file = 'actions/edupham.php';
        break;
    default:
}

require_once ($file);