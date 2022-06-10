<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 12/02/2020
 * Time: 11:18 PM
 */

?>

<div class=" col-lg-4 offset-lg-4 mt-4">
    <form class="form-signin text-center" method="post" action="index.php?m=account&a=process_login">
        <img class="mb-4" src="public/images/logo_dcv_71x35.png" alt="Logo DCV">
        <h1 class="h3 mb-3 font-weight-normal">PMS Online</h1>
        <div class="form-group text-left">
            <label for="email" class="">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="email đăng nhập">
        </div>
        <div class="form-group text-left">
            <label for="password" class="">Mật khẩu:</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
        </div>

    </form>
</div>

