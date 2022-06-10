
<?php
$totalQ = countCart($conn, 'cart', 'soluong');
$totalP = countCart($conn, 'cart', 'price');

$user_id = $_SESSION['user_id'];
$param = "where id_user = '$user_id' ";
$myCarts = query($conn, '*', 'cart', $param);

?>

<div class="col-lg-12 mt-2"><h3>Giỏ Hàng</h3></div>
<br>
<div class="col-lg-12 mt-2">
    <?php if ($module == 'shopcart') { ?>
        <?php if ($deleted == 1) { ?>
            <div class="alert alert-primary" role="alert">Xóa Giỏ Hàng thành công!</div>
        <?php } else if ($deleted == 0) { ?>
             <div class="alert alert-warning" role="alert">Xóa Xóa Giỏ Hàng không thành công! Hãy chọn cho mình 1 khóa học !..</div>
        <?php  } ?>
        <?php  } ?>
</div>

<div class="col-lg-12">
        <button class="btn btn-success" style="margin-bottom:10px" onclick="deleted()">Xóa Giỏ Hàng</button>
    <a href="index.php?m=home">
        <button class="btn btn-success" style="margin-bottom:10px">Quay Lại Trang Chủ</button>
    </a>
</div>
<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" name="chk_all" id="chk_all">
            </th>
            <th class="text-center">#ID</th>
            <th class="text-center">Tên Khóa Học</th>
            <th class="text-center">Đơn Giá</th>
            <th class="text-center">Thành Tiền</th>
            <th class="text-center">Số Lượng</th>
            <th class="text-center">Xử lý</th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($myCarts) && count($myCarts) > 0) : ?>
        <?php foreach($myCarts as $key => $myCart) : ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" name="chk_task[]" value="<?php echo "" ?>">
                </td>
                <td class="text-center"><?php echo $myCart['id'] ?></td>
                <td><?php echo $myCart['name'] ?></td>
                <td><?php echo $myCart['price'] ?></td>
                <td><?php echo $myCart['price']*$myCart['soluong'] ?></td>
                <td class="text-center"><?php echo $myCart['soluong'] ?></td>

                <td class="text-center">
                    <a href="javascript:void(0)" onclick="Confirmdeleted(<?php echo $myCart['id'] ?>)">
                        <button class="btn btn-danger btn-sm" style="margin-bottom:10px">Xóa</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
                <td class="text-center"> Tổng</td>
                <td class="text-center"></td>
                <td>   </td>
                <td>   </td>
                <td><?php echo $totalP[0]['tong'] ?></td>
                <td class="text-center"><?php echo $totalQ[0]['tong'] ?></td>

                <td class="text-center">
                    <a href="javascript:void(0)">
                        <button class="btn btn-success btn-sm" style="margin-bottom:10px">Thanh Toán</button>
                    </a>
                </td>
            </tr>
        <?php else: ?>
        <tr>
            <td colspan="7" class="text-center"><span style="color: red">Giỏ Hàng Trống.</span></td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>


<script>
    function deleted() {
        var ask = confirm('Bạn có chắc muốn xóa Giỏ hàng không?');
        if (ask) {
            window.location.href = "index.php?m=shopcart&a=delCart";
        }
        else {
            return false;
        }
    }

    function Confirmdeleted(id) {
        var ask = confirm('Bạn có chắc muốn xóa Giỏ hàng không?');
        if (ask) {
            window.location.href = "index.php?m=shopcart&a=delCart&id=" + id;
        }
        else {
            return false;
        }
    }



</script>