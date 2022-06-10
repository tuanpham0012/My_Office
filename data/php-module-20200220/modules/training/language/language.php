<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 01:12 AM
 */

if (in_array($action, ['vi', 'en'])) {
    $_SESSION['lang'] = $action;
} else {
    $_SESSION['lang'] = 'vi';
}

header('Location: index.php');