<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 12/02/2020
 * Time: 02:58 PM
 */

$name = isset($_GET['name']) ? $_GET['name'] : '';
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$page_index = isset($_GET['page_index']) ? $_GET['page_index'] : 1;
$page_size = 5;

$option = ' LEFT JOIN projects p ON p.id = tasks.project_id ';
$option .= ' WHERE tasks.id > 0 ';

if ($name) {
    $option .= " AND tasks.name LIKE '%" . $name . "%'";
}

if ($project_id > 0) {
    $option .= ' AND tasks.project_id = ' . $project_id;
}

if ($user_id > 0) {
    $option .= ' AND tasks.user_id = ' . $user_id;
}

if ($status >= 0) {
    $option .= ' AND tasks.status = ' . $status;
}

$sql = $option . ' ORDER BY tasks.name LIMIT ' . ($page_index - 1)*$page_size . ','.$page_size;

$tasks = query($conn,'tasks.*, p.name AS project_name', 'tasks', $sql);
$total = queryCount($conn,'tasks.*', 'tasks', $option);
$base_url = 'index.php?m=task&a=list';
$link = paginateAjax($base_url, $total, $page_index, $page_size);

?>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" name="chk_all" id="chk_all">
            </th>
            <th class="text-center">#ID</th>
            <th class="text-center">Tên công việc</th>
            <!--<th class="text-center">Dự án</th>-->
            <th class="text-center">Người thực hiện</th>
            <th class="text-center">Trạng thái</th>
            <!--<th class="text-center">Ngày tạo</th>-->
            <th class="text-center">Ngày cập nhật</th>
            <th class="text-center">Xử lý</th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($tasks) && count($tasks) > 0) : ?>
        <?php foreach($tasks as $key => $task) : ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" name="chk_task[]" value="<?php echo $task['id'] ?>">
                </td>
                <td class="text-center"><?php echo $task['id'] ?></td>
                <td>
                    <?php echo $task['name'] ?>
                    <br>
                    <p style="font-size: 13px; color: #adadad; margin-bottom: 0px">
                        DA: <?php echo $task['project_name'] ?>
                    </p>
                </td>
                <!--<td><?php /*echo $task['project_name'] */?></td>-->
                <td><?php echo '?' ?></td>
                <td class="text-center"><?php echo $task['status'] ?></td>
                <!--<td class="text-center"><?php /*echo formatDate($task['created_at'], false) */?></td>-->
                <td class="text-center"><?php echo formatDate($task['updated_at']) ?></td>
                <td class="text-center">
                    <a href="index.php?m=task&a=detail&id=<?php echo $task['id'] ?>">
                        <button class="btn btn-info btn-sm" style="margin-bottom:10px">Chi tiết</button>
                    </a>
                    <a href="index.php?m=task&a=edit&id=<?php echo $task['id'] ?>">
                        <button class="btn btn-success btn-sm" style="margin-bottom:10px">Cập nhật</button>
                    </a>
                    <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $task['id'] ?>)">
                        <button class="btn btn-danger btn-sm" style="margin-bottom:10px">Xóa</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="7"><span style="color: red">Không có dữ liệu.</span></td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<div class="col-lg-12 text-center">
    <div><?php echo $link; ?></div>
</div>

<script>
    $(document).ready(function () {
        $('#chk_all' ).click( function () {
            $('input[type="checkbox"]' ).prop('checked', this.checked);
        });
    });
</script>