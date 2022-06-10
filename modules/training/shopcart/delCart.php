
<?php 
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id){
    $param = " where id =".$id;
    $delete = queryDelete($conn, 'cart', $param);







    // $_SESSION['total'] = $_SESSION['total'] - $_SESSION['myCart'][$id]['qTy'];
    // $_SESSION['totalPrice'] = $_SESSION['totalPrice'] - $_SESSION['myCart'][$id]['prices'];
    // unset($_SESSION['myCart'][$id]);
    // $_SESSION['qty'] -=1;

    header('Location: index.php?m=shopcart&a=myCart&deleted=1');
}

else {
    $delete = queryDelete($conn, 'cart', '');
    header('Location: index.php?m=shopcart&a=myCart&deleted=1');
}
?>
    