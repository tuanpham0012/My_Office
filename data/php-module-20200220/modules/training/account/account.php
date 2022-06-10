<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 12/02/2020
 * Time: 11:19 PM
 */

$file = '';
switch ($action) {
    case 'login':
        $file = 'actions/login.php';
        break;
    case 'process_login':
        $file = 'actions/process_login.php';
        break;
    case 'logout':
        $file = 'actions/logout.php';
        break;
    case 'register':
        $file = 'actions/register.php';
        break;
    default:
}

require_once ($file);