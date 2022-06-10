/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.37-MariaDB : Database - pms_trainee
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pms_trainee` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `pms_trainee`;

/*Table structure for table `bookings` */

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'ID người đăng ký họp',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên nhân viên',
  `time_from` datetime DEFAULT NULL COMMENT 'Thời gian bắt đầu',
  `time_to` datetime DEFAULT NULL COMMENT 'Thời gian kết thúc dự kiến',
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung cuộc họp',
  `quantity` int(11) DEFAULT 1 COMMENT 'Số lượng người tham gia họp',
  `room_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên phòng họp',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ghi chú nếu có',
  `status` tinyint(1) DEFAULT 0 COMMENT 'Trạng thái đăng ký',
  `created_at` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID của công ty/doanh nghiệp cha',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên công ty/doanh nghiệp',
  `trading_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên viết tắt, tên giao dịch',
  `left` int(11) DEFAULT NULL COMMENT 'Chỉ số bên trái',
  `right` int(11) DEFAULT NULL COMMENT 'Chỉ số bên phải',
  `depth` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Độ sâu của công ty/doanh nghiệp: 1 ứng với cấp cha',
  `representative_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên người đại diện',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email liên hệ',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ',
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số di động, định dạng 84xxx',
  `hotline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số hotline, số tổng đài',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của user tạo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `message_logs` */

DROP TABLE IF EXISTS `message_logs`;

CREATE TABLE `message_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT 'ID công ty',
  `project_id` int(11) DEFAULT NULL COMMENT 'ID của dự án',
  `message_id` int(11) NOT NULL COMMENT 'ID của thông báo',
  `user_id` int(11) NOT NULL COMMENT 'ID của user nhận thông báo',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PRIVATE' COMMENT 'Loại tin: cá nhân (PRIVATE) hoặc nhóm (GROUP)',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Trạng thái: 0-Chưa đọc, 1-Đã đọc, 2-Đã xóa',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL COMMENT 'ID công ty',
  `project_id` int(11) DEFAULT NULL COMMENT 'ID của dự án. Nếu gửi dự án thì sẽ có giá trị, null gửi cho cá nhân',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiêu đề thông báo/tin nhắn',
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung tóm tắt',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nội dung thông báo',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Trạng thái: 0-Tạo mới, 1-Đã duyệt, 2-Đã gửi',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của user tạo',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `order_bags` */

DROP TABLE IF EXISTS `order_bags`;

CREATE TABLE `order_bags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT NULL COMMENT 'ID order',
  `product_id` int(11) DEFAULT NULL COMMENT 'ID sản phẩm',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID người mua hàng',
  `quantity` double DEFAULT '0' COMMENT 'Số lượng',
  `unit_price` double DEFAULT '0' COMMENT 'Đơn giá',
  `total_price` double DEFAULT '0' COMMENT 'Tổng thành tiền hàng',
  `sale_off` double DEFAULT '0' COMMENT '% giảm giá',
  `total_sale_off` double DEFAULT '0' COMMENT 'Tổng tiền giảm giá',
  `discount` double DEFAULT '0' COMMENT '% chiết khấu',
  `total_discount` double DEFAULT '0' COMMENT 'Tổng tiền chiết khấu',
  `vat_percentage` double DEFAULT '0' COMMENT '% VAT',
  `total_vat` double DEFAULT '0' COMMENT 'Tổng tiền VAT',
  `shipper_charge` double DEFAULT '0' COMMENT 'Phí giao hàng',
  `total_pay` double DEFAULT '0' COMMENT 'Tổng tiền phải thanh toán',
  `status` tinyint(4) DEFAULT '0' COMMENT 'Trạng thái',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) DEFAULT NULL COMMENT 'ID order',
  `product_id` int(11) DEFAULT NULL COMMENT 'ID sản phẩm',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID người mua hàng',
  `quantity` double DEFAULT '0' COMMENT 'Số lượng',
  `unit_price` double DEFAULT '0' COMMENT 'Đơn giá',
  `total_price` double DEFAULT '0' COMMENT 'Tổng thành tiền hàng',
  `sale_off` double DEFAULT '0' COMMENT '% giảm giá',
  `total_sale_off` double DEFAULT '0' COMMENT 'Tổng tiền giảm giá',
  `discount` double DEFAULT '0' COMMENT '% chiết khấu',
  `total_discount` double DEFAULT '0' COMMENT 'Tổng tiền chiết khấu',
  `vat_percentage` double DEFAULT '0' COMMENT '% VAT',
  `total_vat` double DEFAULT '0' COMMENT 'Tổng tiền VAT',
  `shipper_charge` double DEFAULT '0' COMMENT 'Phí giao hàng',
  `total_pay` double DEFAULT '0' COMMENT 'Tổng tiền phải thanh toán',
  `status` tinyint(4) DEFAULT '0' COMMENT 'Trạng thái',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'ID người mua hàng',
  `quantity` int(11) DEFAULT NULL COMMENT 'Số lượng',
  `total_price` double DEFAULT NULL COMMENT 'Tổng tiền hàng',
  `total_discount` double DEFAULT NULL COMMENT 'Tổng tiền được giảm',
  `total_pay` double DEFAULT NULL COMMENT 'Tổng tiền thanh toán = total_price - total_discount',
  `is_free_ship` tinyint(1) DEFAULT '0' COMMENT 'Được miễn phí ship không: 0-Không, 1-Có',
  `status` tinyint(1) DEFAULT '0' COMMENT 'Trạng thái: 0-Chưa thanh toán, 1-Đã thanh toán',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên sản phẩm',
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã sp',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ảnh đại diện sp',
  `price` double DEFAULT '0' COMMENT 'Giá gốc/bán',
  `discount` double DEFAULT '0' COMMENT '% giảm giá',
  `summary` text COLLATE utf8mb4_unicode_ci COMMENT 'Tóm tắt',
  `info` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Thông tin sp',
  `status` tinyint(1) DEFAULT '1' COMMENT 'Trạng thái: 0-Nháp, 1-Đã duyệt',
  `created_at` datetime DEFAULT NULL COMMENT 'Ngày tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Ngày cập nhật',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `project_user` */

DROP TABLE IF EXISTS `project_user`;

CREATE TABLE `project_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT 'ID của công ty',
  `project_id` int(11) NOT NULL COMMENT 'ID của dự án',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID của user tham gia dự án',
  `position_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Vị trí user trong dự án',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của user admin gán user vào dự án',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL COMMENT 'ID công ty',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên dự án',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Mô tả dự án',
  `start_date` datetime DEFAULT NULL COMMENT 'Ngày bắt đầu thực hiện dự án, ngày kickoff',
  `hand_over_date` datetime DEFAULT NULL COMMENT 'Ngày bàn giao dự án',
  `end_date` datetime DEFAULT NULL COMMENT 'Ngày kết thúc dự án',
  `priority` int(11) NOT NULL DEFAULT '1' COMMENT 'Độ ưu tiên sắp xếp, 1 là cao nhất, cùng độ ưu tiên sẽ sắp xếp theo mức độ level',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Mức độ quan trọng dự án: 0-Bình thường, 1-Gấp, 2-Rất gấp, 3-Hỏa tốc',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Trạng thái dự án: 0-Tạo mới, 1-Chờ duyệt, 2-Đã duyệt, 3-Đang thực hiện, 4-Hoàn thành, 5-Tạm dừng',
  `leader_id` int(11) DEFAULT NULL COMMENT 'ID của user làm Leader dự án',
  `pm_id` int(11) DEFAULT NULL COMMENT 'ID của user làm PM dự án',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của user tạo dự án',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `recruiments` */

DROP TABLE IF EXISTS `recruiments`;

CREATE TABLE `recruiments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Họ và tên ứng viên',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email liên hệ',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SĐT liên hệ',
  `cv_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn file CV',
  `date_interview` datetime DEFAULT NULL COMMENT 'Ngày hẹn phỏng vấn',
  `date_working` datetime DEFAULT NULL COMMENT 'Ngày hẹn đi làm',
  `notes` text COLLATE utf8mb4_unicode_ci COMMENT 'Ghi chú nếu có',
  `status` tinyint(1) DEFAULT NULL COMMENT 'Trạng thái: 0-Mới nhận CV,',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'ID nhóm quyền',
  `user_id` int(11) NOT NULL COMMENT 'ID của user được gán vào nhóm quyền',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID nhóm quyền',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên nhóm quyền',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã nhóm quyền',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mô tả nhóm quyền',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT 'ID của dự án',
  `company_id` int(11) DEFAULT NULL COMMENT 'ID công ty',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID của user tham gia dự án',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên công việc',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Mô tả công việc',
  `start_date` datetime DEFAULT NULL COMMENT 'Ngày bắt đầu thực hiện công việc',
  `end_date` datetime DEFAULT NULL COMMENT 'Ngày kết thúc công việc',
  `priority` int(11) NOT NULL DEFAULT '1' COMMENT 'Độ ưu tiên sắp xếp, 1 là cao nhất, cùng độ ưu tiên sẽ sắp xếp theo mức độ level',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Mức độ quan trọng công việc: 0-Bình thường, 1-Gấp, 2-Rất gấp, 3-Hỏa tốc',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Trạng thái công việc: 0-Tạo mới, 1-Đã duyệt, 2-Đã giao, 3-Đang thực hiện, 4-Hoàn thành, 5-Tạm dừng, 6-Chuyển cho người khác',
  `receiver_id` int(11) DEFAULT NULL COMMENT 'ID của user nhận lại công việc',
  `transferred_at` datetime DEFAULT NULL COMMENT 'Thời điểm chuyển cho user khác thực hiện',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của user tạo công việc',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL COMMENT 'ID công ty do user làm việc',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tên đầy đủ',
  `birthday` datetime DEFAULT NULL COMMENT 'Ngày sinh, định dạng yyyy-mm-dd 00:00:00',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Giới tính: 0-Bí mật, 1-Nam, 2-Nữ',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ',
  `mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Số di động, định dạng 84xxx',
  `api_token` text COLLATE utf8mb4_unicode_ci COMMENT 'Chuỗi token sau khi login thành công',
  `last_login_at` datetime DEFAULT NULL COMMENT 'Thời điểm login lần cuối',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động: 0-Chưa kích hoạt, 1-Đã kích hoạt, 2-Tạm khóa, 3-Đã nghỉ làm',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
