<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 08/02/2020
 * Time: 08:31 AM
 */

$projects = query($conn,' id,name ', 'projects', ' ORDER BY name');
$users = query($conn,' id,email,name ', 'users', ' ORDER BY email');

?>

<div class="col-lg-12 mt-2"><h3>Danh sách TASK</h3></div>
<div class="col-lg-3">
    <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Nhập tên công việc ...">
</div>
<div class="col-lg-3">
    <select name="project_id" id="project_id" class="form-control">
        <option value="-1">Tất cả dự án</option>
        <?php if ($projects) : foreach ($projects as $key => $project) : ?>
        <option value="<?php echo $project['id'] ?>"><?php echo $project['name'] ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>
<div class="col-lg-3">
    <select name="user_id" id="user_id" class="form-control">
        <option value="-1">Tất cả user</option>
        <?php if ($users) : foreach ($users as $key => $user) : ?>
        <option value="<?php echo $user['id'] ?>"><?php echo $user['email'] . ' (' . $user['name'] . ')' ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>
<div class="col-lg-3">
    <select name="status" id="status" class="form-control">
        <option value="-1">Tất cả trạng thái</option>
        <option value="0">Tạo mới (0)</option>
        <option value="1">Đã duyệt (1)</option>
        <option value="2">Đã giao (2)</option>
        <option value="3">Đang thực hiện (3)</option>
        <option value="4">Hoàn thành (4)</option>
        <option value="5">Tạm dừng (5)</option>
        <option value="6">Chuyển cho người khác (6)</option>
    </select>
</div>
<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 10px;">
    <div class="spinner-border" id="data-loading" style="display: none"></div>
</div>
<div class="col-lg-12 mt-2" id="ajax_list"></div>
<div class="col-lg-12 pms-mt-2 mb-2">
    <a href="index.php?m=task&a=add">
        <button class="btn btn-success" style="margin-bottom:10px">Thêm mới</button>
        <button class="btn btn-danger" style="margin-bottom:10px">Xóa nhiều</button>
    </a>
    <a href="index.php?m=task&a=export" id="a-export">
        <button class="btn btn-warning" style="margin-bottom:10px">
            <i class="fa fa-file-excel-o"></i> Xuất excel
        </button>
    </a>
</div>
<script>
    $(document).ready(function () {
        $('#data-loading').hide();
        $('#project_id').select2();
        $('#user_id').select2();
        $('#status').select2();

        var url_ajax = 'index.php?m=ajax&a=get_task_list';

        var oldTimeout = '';
        $('#name').keyup(function(){
            $('#data-loading').show();

            clearTimeout(oldTimeout);
            oldTimeout = setTimeout(function(){
                getDataByAjax(url_ajax, 1);
            }, 250);
        });

        filterBySelectBox('project_id', url_ajax);
        filterBySelectBox('user_id', url_ajax);
        filterBySelectBox('status', url_ajax);

        changePage(1);
    });

    function changePage(page_index) {
        var url_ajax = 'index.php?m=ajax&a=get_task_list';
        getDataByAjax(url_ajax, page_index);
    }

    function filterBySelectBox(id, url_ajax){
        $('#'+id).change(function(){
            getDataByAjax(url_ajax, 1);
        });
    }

    function getDataByAjax(url_ajax, page_index) {
        $('#data-loading').show();

        var name = $('#name').val();
        var project_id = $('#project_id').val();
        var user_id = $('#user_id').val();
        var status = $('#status').val();

        var export_url = "index.php?m=task&a=export&name="+name+"&project_id="+project_id+"&user_id="+user_id+"&status="+status+"&page_index="+page_index;
        $('a#a-export').attr("href", export_url);

        var data = {
            name: name,
            project_id: project_id,
            user_id: user_id,
            status: status,
            page_index: page_index
        };

        $.ajax({
            url: url_ajax,
            type: 'GET',
            dataType: 'HTML',
            data: data,
            success: function(result) {
                $('#data-loading').hide();
                $('#ajax_list').html(result);
            },
            error: function (jqXhr, textStatus, errorMessage) {}
        });
    }

</script>
