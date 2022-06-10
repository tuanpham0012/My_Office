<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 12/02/2020
 * Time: 11:21 PM
 */

if (isset($_SESSION["username"])) unset($_SESSION["username"]);
if (isset($_SESSION["email"])) unset($_SESSION["email"]);

header('Location: index.php');