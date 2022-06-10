<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 23/02/2020
 * Time: 11:39 PM
 */

 $email = isset($_GET['email']) ? $_GET['email'] : null;
 $id = isset($_GET['id']) ? $_GET['id'] : '';
 $name = isset($_GET['name']) ? $_GET['name'] : null;

 if ($email && $id) {

     //sendEmailByYandex($email);
     sendEmailByGoogle($email, $name);

     header('Location: index.php?m=user&a=list&sent_email=1');
 } else {
     header('Location: index.php?m=user&a=list&sent_email=0');
 }