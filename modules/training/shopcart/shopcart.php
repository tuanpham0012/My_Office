<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 08/02/2020
 * Time: 08:30 AM
 */

$file = '';

switch ($action) {
    case 'cart':
        $file = 'cart.php';
        break;
    case 'myCart':
        $file = 'myCart.php';
        break;
    case 'delCart':
        $file = 'delCart.php';
        break;
    case 'send_mail':
        $file = 'send_mail.php';
        break;
    default:
}

require_once ($file);
die();
