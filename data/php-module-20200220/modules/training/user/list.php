<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 05/02/2020
 * Time: 11:12 AM
 */
$page_size = 10;
$prarams=' ORDER BY name LIMIT ' . ($page_index-1)*$page_size . ','.$page_size;
$users = query($conn,'*', 'users', $prarams);
$total = queryCount($conn,'*', 'users', '');
$base_url = 'index.php?m=user&a=list';
$link = paginate($base_url, $total, $page_index, $page_size);

?>
<div class="col-lg-12 mt-2">
    <?php if ($module == 'user') { ?>
        <?php if ($deleted == 1) { ?>
            <div class="alert alert-primary" role="alert">Xóa user thành công!</div>
        <?php  } else if ($deleted == 0) { ?>
             <div class="alert alert-warning" role="alert">Xóa user không thành công!</div>
        <?php  } ?>
    <?php  } ?>
</div>
<div class="col-lg-12">
    <h3>Danh sách USER</h3>
    <a href="index.php?m=user&a=add">
        <button class="btn btn-success" style="margin-bottom:10px">Thêm mới</button>
        <button class="btn btn-danger" style="margin-bottom:10px">Xóa nhiều</button>
    </a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" name="chk_all" id="chk_all">
                </th>
                <th class="text-center">#ID</th>
                <th class="text-center">Tên nhân viên</th>
                <th class="text-center">Email</th>
                <th class="text-center">Mobile</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Ngày tạo</th>
                <th class="text-center">Ngày cập nhật</th>
                <th class="text-center">Xử lý</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $key => $user) { ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="chk_user[]" value="<?php echo $user['id'] ?>">
                    </td>
                    <td class="text-center"><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['mobile'] ?></td>
                    <td class="text-center"><?php echo $user['status'] ?></td>
                    <td class="text-center"><?php echo formatDate($user['created_at'], false) ?></td>
                    <td class="text-center"><?php echo formatDate($user['updated_at']) ?></td>
                    <td class="text-center">
                        <a href="index.php?m=user&a=detail&id=<?php echo $user['id'] ?>">
                            <button class="btn btn-info btn-sm" style="margin-bottom:10px">Chi tiết</button>
                        </a>
                        <a href="index.php?m=user&a=edit&id=<?php echo $user['id'] ?>">
                            <button class="btn btn-success btn-sm" style="margin-bottom:10px">Cập nhật</button>
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $user['id'] ?>)">
                            <button class="btn btn-danger btn-sm" style="margin-bottom:10px">Xóa</button>
                        </a>
                    </td>
                    </tr>  
                <?php } ?>  
                </tbody>
        </table>
    </div>
</div>
<div class="col-lg-12 text-center">
    <div><?php echo $link; ?></div>
</div>
<script>
    function confirmDelete(id) {
        var ask = confirm('Bạn có chắc chắn muốn xóa không?');
        if (ask) {
            window.location.href = "index.php?m=user&a=delete&id=" + id;
        } else {
            return false;
        }
    }

    jQuery(document).ready(function () {
        jQuery('#chk_all' ).click( function () {
            jQuery('input[type="checkbox"]' ).prop('checked', this.checked)
        })

    });



</script>
