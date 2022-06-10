<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 05/02/2020
 * Time: 11:12 AM
 */

$page_size = 10;
$prarams=' ORDER BY name LIMIT ' . ($page_index-1)*$page_size . ','.$page_size;
$projects = query($conn,'*', 'projects', $prarams);
$total = queryCount($conn,'*', 'projects', '');
$base_url = 'index.php?m=project&a=list';
$link = paginate($base_url, $total, $page_index, $page_size);

?>
<div class="col-lg-12 mt-2">
    <?php if ($module == 'project') { ?>
        <?php if ($deleted == 1) { ?>
            <div class="alert alert-primary" role="alert">Xóa user thành công!</div>
        <?php  } else if ($deleted == 0) { ?>
             <div class="alert alert-warning" role="alert">Xóa user không thành công!</div>
        <?php  } ?>
    <?php  } ?>
</div>
<div class="col-lg-12">
    <h3>Danh sách PROJECT</h3>
    <a href="index.php?m=project&a=add">
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
                <th class="text-center">Tên dự án</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Ngày tạo</th>
                <th class="text-center">Ngày cập nhật</th>
                <th class="text-center">Xử lý</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($projects as $key => $project) { ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="chk_project[]" value="<?php echo $project['id'] ?>">
                    </td>
                    <td class="text-center"><?php echo $project['id'] ?></td>
                    <td><?php echo $project['name'] ?></td>
                    <td class="text-center"><?php echo $project['status'] ?></td>
                    <td class="text-center"><?php echo formatDate($project['created_at'], false) ?></td>
                    <td class="text-center"><?php echo formatDate($project['updated_at']) ?></td>
                    <td class="text-center">
                        <a href="index.php?m=project&a=detail&id=<?php echo $project['id'] ?>">
                            <button class="btn btn-info btn-sm" style="margin-bottom:10px">Chi tiết</button>
                        </a>
                        <a href="index.php?m=project&a=edit&id=<?php echo $project['id'] ?>">
                            <button class="btn btn-success btn-sm" style="margin-bottom:10px">Cập nhật</button>
                        </a>
                        <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $project['id'] ?>)">
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
            window.location.href = "index.php?m=project&a=delete&id=" + id;
        } else {
            return false;
        }
    }

    jQuery(document).ready(function () {
        jQuery('#chk_all' ).click( function () {
            jQuery('input[type="checkbox"]' ).prop('checked', this.checked)
        });
    });



</script>
