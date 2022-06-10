<?php

if (isset($_SESSION['username']) && $_SESSION['username']) {

$url='http://edupham.com/api/v1/education/get-course-list'; // tạo biến url cần lấy

$url2 = file_get_contents($url);

$array_json = json_decode($url2, true);


if ($id){
    $product_name = $array_json['data'][$id-1]['name'];
    $product_user_id = $_SESSION['user_id'];
    $product_price = $array_json['data'][$id-1]['price'];
    $param = " where name like '$product_name' and id_user = '$product_user_id'";
    $product = query($conn, '*', 'cart', $param);
    if ( is_array($product) && count($product) > 0){
        $product_qty = $product[0]['soluong'] + 1;
        $upCart = updateCart($conn, 'cart', $product_qty, $param);
    }
    else {
        $product_qty = 1;
        $addCart = addCart($conn, 'cart', $product_user_id, $product_name, $product_qty, $product_price);
        header('Location: index.php?m=home');
    }
}

}
?>
















// if ( ! isset($_SESSION['myCart'])){
//     $_SESSION['myCart'] = array();
// }
// if (!isset($_SESSION['total'])){
//     $_SESSION['total'] = 0;
// }
// if (!isset($_SESSION['totalPrice'])){
//     $_SESSION['totalPrice'] = 0;
// }


// $id = isset($_GET['id']) ? $_GET['id'] : null; 

// if($id){
//     if (isset($_SESSION['myCart'][$id]['qTy'])){
//         $_SESSION['myCart'][$id]['qTy'] +=1;
//         $_SESSION['myCart'][$id]['prices'] = $_SESSION['myCart'][$id]['price'] * $_SESSION['myCart'][$id]['qTy'];
//     }

//     else{
//         $_SESSION['myCart'][$id]['id'] = $array_json['data'][$id-1]['id'];
//         $_SESSION['myCart'][$id]['name'] = $array_json['data'][$id-1]['name'];
//         $_SESSION['myCart'][$id]['price'] = $array_json['data'][$id-1]['price'];
//         $_SESSION['myCart'][$id]['prices'] = $_SESSION['myCart'][$id]['price'];
//         $_SESSION['myCart'][$id]['qTy'] = 1;
//     }
//     $_SESSION['total'] +=1;
//     $_SESSION['totalPrice'] = $_SESSION['totalPrice'] + $_SESSION['myCart'][$id]['prices'];
        
// }

// if (isset($_SESSION['myCart'])){
//     $_SESSION['qty'] = count($_SESSION['myCart']);

// }
// else {
//     $_SESSION['qty'] = 0;
// }

// header('Location: index.php?m=home');

// }
// else {
//     header('Location: index.php?m=account&a=login');
// }
    
