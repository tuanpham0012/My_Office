<?php 
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if ($name && $email && $password) {
    // Lưu vào DB
    $addData = addData($conn, 'users', 'name', 'email', 'password', $name, $email, $password);
}

?>

<div class="col-lg-4 pms-mt-10">
    <h3>Thêm mới USER</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" class="form-control-file" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary">Lưu lại</button>
    </form>
</div>
