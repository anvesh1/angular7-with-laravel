/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.35-1+deb.sury.org~xenial+0.1 : Database - admin_api
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`admin_api` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `admin_api`;


DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_27_123451_create_jobs_table',1),('2016_06_01_083701_create_graduates_table',2),('2016_06_01_083758_create_industries_table',2),('2016_06_01_101617_create_provinces_table',3),('2016_05_27_123451_create_companies_table',4),('2016_05_27_123451_create_questions_table',5),('2016_05_27_123451_create_subscriptions_table',6);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `user_profile_image` text,
  `device_type` enum('android','ios','web') NOT NULL DEFAULT 'web',
  `address` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `designation` varchar(250) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `device_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email_id`,`password`,`contact_no`,`user_profile_image`,`device_type`,`address`,`status`,`designation`,`id_number`,`created_at`,`updated_at`,`device_token`) values (1,'admin','name','admin@gmail.com','$2y$10$SSn7QnZO5/QyxlCfFU1WEu85lDNg1Nl1h3gla3YmmgHmlRcVfyWjO','1122334455','','web','',1,'web dev','112234433','2018-09-10 14:13:55','2018-12-19 09:44:30','$2y$10$3L4Lh8CDhBrSO/.zpCsBEek0hHyH6SfzZpIdCc7A2tr3OwCjNT042');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
