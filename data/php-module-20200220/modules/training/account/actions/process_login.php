<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 12:03 AM
 */

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if ($email === 'admin@dcv.vn' && $password === '5e3e6d42f7') {
    $_SESSION["username"] = $email;
    $_SESSION["email"] = $email;

    header('Location: index.php');
}