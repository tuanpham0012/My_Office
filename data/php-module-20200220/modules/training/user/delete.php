<?php
$delete = queryDelete($conn, 'users', $id);

if ($delete) {
    header('Location: index.php?m=user&a=list&deleted=1');
} else {
    header('Location: index.php?m=user&a=list&deleted=0');
}
?>