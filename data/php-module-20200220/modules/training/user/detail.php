<?php
if (isset($id) && $id > 0) {
    $user = query($conn, '*', 'users', ' WHERE id=' . $id);
}
?>
<?php if(isset($user[0])){ ?>
    <div class="col-lg-6" style="margin-top: 10px">
        <h3>Chi tiết USER</h3>
        <a href="index.php?m=user&a=list">
            <button class="btn btn-info btn-sm" style="margin-bottom:10px">< Quay lại</button>
        </a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Thông tin cá nhân</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Ảnh đại diện</td>
                <th><img src="public/images/user_icon.png" style="width:100px"></th>
            </tr>
            <tr>
                <td>ID</td>
                <th><?php echo $user[0]['id'] ?></th>
            </tr>
            <tr>
                <td>Tên</td>
                <th><?php echo $user[0]['name'] ?></th>
            </tr>
            <tr>
                <td>Email</td>
                <th><?php echo $user[0]['email'] ?></th>
            </tr>
            <tr>
                <td>Ngày tạo</td>
                <th><?php echo formatDate($user[0]['created_at']) ?></th>
            </tr>
            <tr>
                <td>Ngày cập nhật</td>
                <th><?php echo formatDate($user[0]['updated_at']) ?></th>
            </tr>
            </tbody>
        </table>
    </div>
<?php } ?>
