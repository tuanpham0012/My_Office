<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 12/02/2020
 * Time: 09:26 PM
 */

$id= isset($_GET['id']) ? $_GET['id'] : null;

if ($id){
$delete = queryDelete($conn, 'projects', $id);
    header('Location: index.php?m=project&a=list&deleted=1');
} 
else {
    header('Location: index.php?m=project&a=list&deleted=0');
}
?>