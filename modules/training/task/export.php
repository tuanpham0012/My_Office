<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 18/02/2020
 * Time: 10:54 AM
 */

require_once ('libs/php_excel/PHPExcel.php');

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

if (is_array($tasks) && count($tasks) > 0) {
    //Khởi tạo đối tượng
    $excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
    $excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
    $excel->getActiveSheet()->setTitle('Task_List');

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

//Xét in đậm cho khoảng cột
    $excel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
    /**
     * |A1|B1|C1|..|n1|
     * |A2|B2|C2|..|n1|
     * |..|..|..|..|..|
     * |An|Bn|Cn|..|nn|
     */
    $excel->getActiveSheet()->setCellValue('A1', '#ID');
    $excel->getActiveSheet()->setCellValue('B1', 'Tên công việc');
    $excel->getActiveSheet()->setCellValue('C1', 'Người thực hiện');
    $excel->getActiveSheet()->setCellValue('D1', 'Trạng thái');
    $excel->getActiveSheet()->setCellValue('E1', 'Ngày cập nhật');
// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2
    $numRow = 2;
    foreach($tasks as $row){
        $excel->getActiveSheet()->setCellValue('A'.$numRow, $row['id']);
        $excel->getActiveSheet()->setCellValue('B'.$numRow, $row['name']);
        $excel->getActiveSheet()->setCellValue('C'.$numRow, $row['user_id']);
        $excel->getActiveSheet()->setCellValue('D'.$numRow, $row['status']);
        $excel->getActiveSheet()->setCellValue('E'.$numRow, $row['updated_at']);
        $numRow++;
    }
// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007 và cho người dùng download luôn
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="Task_List.xlsx"');
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
} else {
    header('Location: index.php?m=task&a=list&exported=0');
}
