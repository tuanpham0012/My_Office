<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 27/02/2020
 * Time: 09:17 AM
 */


$page_size = 3;
$prarams=' LEFT JOIN users ON users.id=bookings.user_id ORDER BY bookings.id DESC LIMIT ' . ($page_index-1)*$page_size . ','.$page_size;
$bookings = query($conn,'bookings.*, users.name AS user_name', 'bookings', $prarams);
$users = query($conn, '*', 'users', '');
$total = queryCount($conn,'*', 'bookings', '');
$base_url = 'index.php?m=booking&a=list';
$link = paginate($base_url, $total, $page_index, $page_size);


?>
<div class="col-lg-12 mt-2"  id="content1">
<div class="col-lg-12 mt-2">
    <?php if ($module == 'booking') { ?>
        <?php if ($deleted == 1) { ?>
            <div class="alert alert-primary" role="alert">Xóa thành công!</div>
        <?php  } else if ($deleted == 0) { ?>
             <div class="alert alert-warning" role="alert">Xóa không thành công!</div>
        <?php  } ?>
    <?php  } ?>
</div>
<div class="col-lg-12 mt-2" >
    <h3>Danh sách đăng ký phòng họp</h3>


    <button class="btn btn-success" style="margin-bottom:10px" id="hide-btn">Đăng Kí Phòng Họp</button>
    <button class="btn btn-danger" style="margin-bottom:10px" id="btn-add-booking">Xóa nhiều</button>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" name="chk_all" id="chk_all">
                </th>
                <th class="text-center">#ID</th>
                <th class="text-center">Tên nhân viên</th>
                <th class="text-center">Nội dung họp</th>
                <th class="text-center">Time Start</th>
                <th class="text-center">Time End</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Xử lý</th>
            </tr>
            </thead>
            <tbody id="booking-table">
            <?php if (is_array($bookings) && count($bookings) > 0) : ?>
            <?php foreach($bookings as $key => $booking) : ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="chk_booking[]" value="<?php echo $booking['id'] ?>">
                    </td>
                    <td class="text-center"><?php echo $booking['id'] ?></td>
                    <td>
                        <?php echo $booking['user_name'] ?>
                    </td>
                    <td><?php echo $booking['content'] ?></td>
                    <td class="text-center"><?php echo $booking['time_from'] ?></td>
                    <td class="text-center"><?php echo $booking['time_to'] ?></td>
                    <td class="text-center"><?php echo $booking['status'] ?></td>
                    <td class="text-center">
                        <a href="index.php?m=booking&a=detail&id=<?php echo $booking['id'] ?>">
                            <button class="btn btn-info btn-sm" style="margin-bottom:10px">Chi tiết</button>
                        </a>
                        <a href="index.php?m=booking&a=edit&id=<?php echo $booking['id'] ?>">
                            <button class="btn btn-success btn-sm" style="margin-bottom:10px">Cập nhật</button>
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $booking['id'] ?>)">
                            <button class="btn btn-danger btn-sm" style="margin-bottom:10px">Xóa</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-lg-12 text-center">
    <div><?php echo $link; ?></div>
</div>
</div>



<div id="dangki" class="col-lg-4 pms-mt-10" style="margin:auto;">
    <div style="float:right;">
        <button style="background-color:#C0C0C0;border: 1px solid;border-radius:4px;" id="out" value="x">x</button>
    </div> 
    <div>
        <h3>Đăng Kí Phòng Họp</h3>      
    </div>
    <div class="col-lg-12">
        <label for="content" style="padding-top:25px;">Tên Người Đăng Kí</label>
        <select name="user_id" id="user_id" class="form-control">
            <option value="-1">Tên Nhân Viên</option>
            <?php if ($users) : foreach ($users as $key => $user) : ?>
            <option value="<?php echo $user['id'] ?>"><span id="user_name"><?php echo $user['name']; ?></span></option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group" style="padding:15px 0px 5px 15px;">
        <label for="content">Nội Dung Họp</label>
        <input type="text" class="form-control" id="content">
        <small id="emailHelp" class="form-text text-muted">Không để trống.</small>
    </div>
    <div class="form-group" style="padding:5px 0px 5px 15px;">
        <label for="content">Thời Gian Bắt Đầu</label>
        <input type="datetime-local" class="form-control" id="time_start">
    </div>
    <div class="form-group" style="padding:5px 0px 10px 15px;">
        <label for="content">Thời Gian Kết Thúc</label>
        <input type="datetime-local" class="form-control" id="time_end">

    </div>
    <button class="btn btn-success" style="margin-bottom:10px" id="registration-room">Đăng kí</button>
</div>





<!-- <script>
    var socket = io.connect('http://localhost:9000');
    if (socket.connected) {
        console.log('socket connected successfull');
    } else {
        console.log('socket connected failed');
    }

    function confirmDelete(id) {
        var ask = confirm('Bạn có chắc chắn muốn xóa không?');
        if (ask) {
            window.location.href = "index.php?m=booking&a=delete&id=" + id;
        } else {
            return false;
        }
    }

    jQuery(document).ready(function () {
        jQuery('#chk_all' ).click( function () {
            jQuery('input[type="checkbox"]' ).prop('checked', this.checked)
        });

    });

    $(document).ready(function() {
        $('#content1').show();
        $('#dangki').hide();    

        $('#hide-btn').click(function() {
            $('#content1').hide(1500);
            $('#dangki').show(1000);
        });
        // $('#registration-room').click(function() {
        //     $('#content1').show(1500);
        //     $('#dangki').hide(1000);
        // });
        $('#out').click(function() {
            $('#content1').show(1500);
            $('#dangki').hide(1000);
        });
    });


    $('#registration-room').click(function () {

        if ( ($('#user_id').val() != (-1) ) && ($('#content').val() != '') ){
            var data = {
                user_id: $('#user_id').val(),
                user_name: 'Đang Cập Nhật',
                time_from: $('#time_start').val(),
                time_to: $('#time_end').val(),
                content: $('#content').val(),
                notes: '',
                status: 1
            };
            if (socket.connected) {
                socket.emit("send-booking-room", data);

                // var tr = '<tr>'+
                //     '<td></td>'+
                //     '<td></td>'+
                //     '<td>' + data.user_name + '</td>'+
                //     '<td>' + data.content + '</td>'+
                //     '<td class="text-center">' + data.status + '</td>'+
                //     '<td></td>'+
                //     '<td></td>'+'</tr>';
                // $('#booking-table').prepend(tr);
            } else {
                console.log('socket connected failed');
            }
        } else {
            socket.emit("send-room-error");
        }

    });

    socket.on('response-booking-room', function(){
        alert("đăng kí thành công");
        $('#content1').show(1500);
        $('#dangki').hide(1000);

    });
    
    socket.on('response-room-error', function(){
        alert("đăng kí không thành công thành công! Vui lòng điền đầy đủ thông tin!!!");
        $('#content1').hide();
        $('#dangki').show();
    });

    // $('#btn-add-booking').click(function () {
    //     var data = {
    //         user_id: 4,
    //         user_name: 'Phạm Văn Đoan',
    //         time_from: '2020-02-27 10:00:00',
    //         time_to: '2020-02-27 11:00:00',
    //         content: 'Họp triển khai dự án mới',
    //         notes: '',
    //         status: 0
    //     };

    //     if (socket.connected) {
    //         socket.emit("send-booking", data);

    //         var tr = '<tr>'+
    //             '<td></td>'+
    //             '<td></td>'+
    //             '<td>' + data.user_name + '</td>'+
    //             '<td>' + data.content + '</td>'+
    //             '<td class="text-center">' + data.status + '</td>'+
    //             '<td></td>'+
    //             '<td></td>'+'</tr>';
    //         $('#booking-table').prepend(tr);
    //     } else {
    //         console.log('socket connected failed');
    //     }
    // });

    socket.on('response-booking', function(data) {
        console.log(data);
        var tr = '<tr>'+
            '<td></td>'+
            '<td></td>'+
            '<td>' + data.user_name + '</td>'+
            '<td>' + data.content + '</td>'+
            '<td>' + data.time_from + '</td>'+
            '<td>' + data.time_to + '</td>'+
            '<td class="text-center">' + data.status + '</td>'+
            '<td></td>'+
            '<td></td>'+'</tr>';
        $('#booking-table').prepend(tr);
    });

    // socket.on("server-sent-user", function (data) {
    //         $('#user').html("");
    //         $('#user').append('Số người đang truy cập: ' + data);
    //     });

</script> -->
