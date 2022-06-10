<?php

$id= isset($_GET['id']) ? $_GET['id'] : null;

if ($id){
$delete = queryDelete($conn, 'users', $id);
    header('Location: http://localhost/php-module-20200228/index.php?m=user&a=list&deleted=1');
} 
else {
    header('Location: http://localhost/php-module-20200228/index.php?m=user&a=list&deleted=0');
}
?>