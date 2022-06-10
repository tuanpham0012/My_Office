/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.37-MariaDB : Database - pms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `pms`;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `project_user` */

LOCK TABLES `project_user` WRITE;

insert  into `project_user`(`id`,`company_id`,`project_id`,`user_id`,`position_id`,`created_by`,`created_at`,`updated_at`) values (1,1,1,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(2,1,2,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(3,1,3,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(4,1,4,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(5,1,5,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(6,1,6,4,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(7,1,6,5,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(8,1,5,6,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(9,1,7,6,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54'),(10,1,6,7,0,NULL,'2020-01-25 17:52:52','2020-01-25 17:52:54');

UNLOCK TABLES;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `projects` */

LOCK TABLES `projects` WRITE;

insert  into `projects`(`id`,`company_id`,`name`,`description`,`start_date`,`hand_over_date`,`end_date`,`priority`,`level`,`status`,`leader_id`,`pm_id`,`created_by`,`created_at`,`updated_at`) values (1,1,'Giờ vàng chốt số',NULL,'2020-01-25 22:17:49',NULL,'2020-01-31 22:17:54',1,0,0,1,1,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(2,1,'Tử vi 24',NULL,'2020-01-01 22:42:36',NULL,NULL,1,0,1,2,2,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(3,1,'Tri thức Việt',NULL,'2020-01-02 22:42:42',NULL,NULL,1,0,2,2,2,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(4,1,'Nhật ký radio',NULL,'2020-01-03 22:42:45',NULL,NULL,1,0,3,3,3,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(5,1,'BigIdol',NULL,'2020-01-13 22:42:48',NULL,NULL,1,0,4,3,3,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(6,1,'Face life',NULL,'2020-01-05 22:42:51',NULL,NULL,1,0,5,2,2,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(7,1,'Sổ liên lạc điện tử',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(8,1,'Mailserver',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(9,1,'Tevo Bulk SMS',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:56','2020-01-25 09:48:56'),(10,1,'Hóa đơn Việt',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(11,1,'A hóa đơn',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(12,1,'ICT Life',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(13,1,'POSS',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(14,1,'M-Store',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(15,1,'MegaOne',NULL,NULL,NULL,NULL,1,0,2,NULL,NULL,NULL,'2020-01-25 09:48:57','2020-01-25 09:48:57');

UNLOCK TABLES;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tasks` */

LOCK TABLES `tasks` WRITE;

insert  into `tasks`(`id`,`project_id`,`company_id`,`user_id`,`name`,`description`,`start_date`,`end_date`,`priority`,`level`,`status`,`receiver_id`,`transferred_at`,`created_by`,`created_at`,`updated_at`) values (1,1,NULL,4,'Tìm hiểu hệ thống',NULL,NULL,NULL,1,0,4,NULL,NULL,NULL,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(2,1,NULL,4,'Phân tích đặc tả yêu cầu phần mềm',NULL,NULL,NULL,1,0,6,NULL,NULL,NULL,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(3,2,NULL,4,'Thu thập dữ liệu demo',NULL,NULL,NULL,1,0,6,NULL,NULL,NULL,'2020-01-25 09:48:58','2020-01-25 09:48:58');

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL COMMENT 'ID công ty do user làm việc',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`company_id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`fullname`,`birthday`,`gender`,`address`,`mobile`,`api_token`,`last_login_at`,`status`,`created_at`,`updated_at`) values (1,1,'Nguyễn Văn Thi','thinv@dcv.vn',NULL,'$2y$10$HGKujjO.sYQQPC.nNGx5jeyxukxqbuXqfEdbV64SZba2UFMvnLgqm',NULL,'Nguyễn Văn Thi',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(2,1,'Dương Công Đồng','dongdc@dcv.vn',NULL,'$2y$10$pd2wQ.RYgKm62B8mUR0EC.BOB.EE.iX4RYACTsH4yuExxwY9uMu6m',NULL,'Dương Công Đồng',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(3,1,'Tô Nhân Hùng','hungtn@dcv.vn',NULL,'$2y$10$.aRdgluRwmVOY02sVA3dHu7VF5gbsibgY7Z09Ee9O7c.ecNSg3xHi',NULL,'Tô Nhân Hùng',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(4,1,'Phạm Văn Đoan','doanpv@dcv.vn',NULL,'$2y$10$jKyO2vnNV1n9ti9vWQhSROQKllP8ezCdluSe3nOur2zIgd/k/PybC',NULL,'Phạm Văn Đoan',NULL,0,NULL,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBhZmI3MWNkZDNlODUwNjk0YmNkODcxN2NiZDJiNGViOTRkYjUwZjI1MDNiNjUxOGNmODg0NGU4ZjBhZjNlMDlmZGYwNTUyOTVlMzZiZjYxIn0.eyJhdWQiOiIxIiwianRpIjoiMGFmYjcxY2RkM2U4NTA2OTRiY2Q4NzE3Y2JkMmI0ZWI5NGRiNTBmMjUwM2I2NTE4Y2Y4ODQ0ZThmMGFmM2UwOWZkZjA1NTI5NWUzNmJmNjEiLCJpYXQiOjE1ODAzOTUzMjYsIm5iZiI6MTU4MDM5NTMyNiwiZXhwIjoxNjEyMDE3NzI2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.ZrZ8rN6jTxJFXhod0I-rIPrqWjwT5WZLJdEGLRJdVRZkmAI3-oGzdrK2ewNqUQ5-J9k3YTl53WljNhqCxdRzg9tPS0XQGfS4f6UyaZ3XgJQBIJoNLuxwu2hKrwtztxLksiNJqcQ9NP5V2rPh8WE5IXiqMhvz-63TqPJPgblh8gDOta5tEJGAXAUeGN5KJajvwYlP7EUahahZ0ltZbjqcPwnT7Ezs70Y1Q4DzjHf1puo-Nu8Sih0IbOaV8bRW09AQKuQejN2PrhY9QgKmc4XWXR6QkkSIxRFYW5Ph7u4gMSEgzeMG2fKE6LPshFprilxSVdpYxO3d3LRUebFTgnomhHJhyWFyh4fisSCLVlMKqtFNxjecu0BZIdd-xq-t2fb6mrSnhd7mwC9JiKpiSH19C606yio1QVtK13__aTiWoZWzYYbeTweNjx6O5qDdSdKb7BqMhCMa_kPTKebpgCMTxSD_X2C4uidREsa1PPpFNodpxu5gvPAdjrGy_wXYCaDvBak_VaTqpSyG6qAR0qBTgkPZ4qETDpwKAqnLNNO7GQKIhgjLErCurw3_HVL6yOMpMpHEzGlpf6vWwLBzXElaMMSHVlGmlifHAsE3j-gow3M-sm8bVBSlUFlbvOyfk2IROTXW9GpvgjdNKrkda2aaZmwgUCklCRoVzURx2S8bs6c','2020-01-30 21:42:06',1,'2020-01-25 09:48:57','2020-01-30 21:42:06'),(5,1,'Nguyễn Thị Thúy','thuylt@dcv.vn',NULL,'$2y$10$K4JzVmlVWN1ryw1u2jSzwOlLrmWi4fO1ezMk2o7hYQGncdaM5Ob92',NULL,'Nguyễn Thị Thúy',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(6,1,'Phạm Xuân Thủy','thuypx@dcv.vn',NULL,'$2y$10$ceOKeooaQTacZ57theMTBe2LLnfxx2SuooNJqDBThTQG2FcrVMhLy',NULL,'Phạm Xuân Thủy',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:57','2020-01-25 09:48:57'),(7,1,'Phạm Quang Huy','huypq@dcv.vn',NULL,'$2y$10$KRxsN.vaQiQlSNBRycaUdOz3rEFjACTLfLCfkOkgZSh0a/ubqu6mG',NULL,'Phạm Quang Huy',NULL,0,NULL,NULL,'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU0ZjBhYWM4N2QwZGRkMDU3OGY5Y2FkMDVmYTg3YjIyZWI5MmIxN2Q5MDFjMGVjMTc3MDIxZjc2ZWVjOWQyNGE1ZWRiZjk1M2JhOWUwOGQ5In0.eyJhdWQiOiIxIiwianRpIjoiZTRmMGFhYzg3ZDBkZGQwNTc4ZjljYWQwNWZhODdiMjJlYjkyYjE3ZDkwMWMwZWMxNzcwMjFmNzZlZWM5ZDI0YTVlZGJmOTUzYmE5ZTA4ZDkiLCJpYXQiOjE1ODAyOTg0MDcsIm5iZiI6MTU4MDI5ODQwNywiZXhwIjoxNjExOTIwODA3LCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.LywlTOPDUj6B6De6Ni_XhtF4QyDjZXMgAuAat6MOGHo-ca00hE8yJg8GiXogZYzWIsEUH7vlllSx-Sgrmg6ao5uVWgJlZfXBgVCKJ2YhIcU_cEomW9XMFX1yMoYGbHy0X1ReSW-NR_ckeOINgQCUPX5biR1ecBVuyLsaWRBMVWL2cRMXs2LcqkyJ5vk7L_LWlP7ksYuCuPtwun8xaMfEm6BOrq6jMnUeItvtPpsKA_AfJwsnetugefeBj6BF2V5sgCbvob6iMgZPqbQeG5E43wKMCSZuyffUEwTTvEsxL1VzmgB9GzgBXUht72tpQXSg3AAIvKjFFBuUZMd9_iSb6BWbHKcOdTRmyr9OZINsOP5uxe-Ch5HjFDFoyVuHnNOtC6OuvkMktgK-ksI6iKV9CABE-YIR2f94WhDR4WmpqlGQ5ugCmQ1FV2AwWDLqVmEXIKBShumAYZAcUNKjW1W84ChlVUT0LGH6gUh-GHVuRLdNpOuYaNdjZ9hnMQHeup-u2GtgVHi2NkNHv3kkVYWmxD2zwHmXN9k4kyz9sncjgphlMb-DFtYsGeytc9Vod-3JEep2bsaiteJuzVhyYm7AzA3fcSfmt50s0Ho8wm0Xd4RUglrZ25VGC_meI2Afb1cut8ECITbU4fZB5lRXRquAQ8Nci1A7WTMzy9PnAq37KBo','2020-01-29 18:46:47',1,'2020-01-25 09:48:58','2020-01-29 18:46:47'),(8,1,'Lê Thị Trang','tranglt@dcv.vn',NULL,'$2y$10$DoJDb4.Kgj5zI0LdvMdOZ.9InxLWEbXRH4uTtBPHD4S7VOupYM0JS',NULL,'Lê Thị Trang',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(9,1,'Lê Thị Hằng','hanglt@dcv.vn',NULL,'$2y$10$KEIxlmNS/40CAGQwIFR9zusk/cwdfvmtJZRG1.v02o16eYz/tYXdK',NULL,'Lê Thị Hằng',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(10,1,'Cung Tiến Thành','thanhct@dcv.vn',NULL,'$2y$10$k.E8nkHGSqipQb3rbOr8X.TckqgYhJr401esCRuyy82xpWl8AhKV6',NULL,'Cung Tiến Thành',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(11,1,'Nguyễn Mạnh Linh','linhnm@dcv.vn',NULL,'$2y$10$RDXAvn4KyHVJ1FiP9FBf2OP9DO1g3/py6DpBCY/wXCVX8qRsRmJOC',NULL,'Nguyễn Mạnh Linh',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:58','2020-01-25 09:48:58'),(12,1,'Trần Văn Minh','minhtv@dcv.vn',NULL,'$2y$10$4qr3ipYNq2gk/bF21CnbQOTwtDoWjah.V5r9vsrCrxm8YIHcCtO0O',NULL,'Trần Văn Minh',NULL,0,NULL,NULL,NULL,NULL,1,'2020-01-25 09:48:58','2020-01-25 09:48:58');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
