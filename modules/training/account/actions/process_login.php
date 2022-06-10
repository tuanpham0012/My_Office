<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 13/02/2020
 * Time: 12:03 AM
 */

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;


if ( $email && $password) {
    $param = " where email like '$email' and password like '$password' ";
    $login = query($conn, '*', 'users',$param);
}
if (is_array($login) && count($login) > 0 ) {
    $_SESSION['username'] = $login[0]['name'];
    $_SESSION['email'] = $login[0]['email'];
    $_SESSION['user_id'] = $login[0]['id'];


    header('Location: index.php');
}
else {
    header('Location: index.php?m=account&a=login');
}