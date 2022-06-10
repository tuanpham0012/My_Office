<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 05/02/2020
 * Time: 09:58 AM
 */

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pms_trainee';
$port = '3306';

$conn = mysqli_connect($host,$user,$password, $database, $port);
$conn->set_charset('utf8');

if(!$conn) die('Khong ket noi duoc DB. Vui long, thu lai sau');
