# ************************************************************
# Sequel Ace SQL dump
# Version 20044
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.28)
# Datenbank: carbonCompanion
# Verarbeitungszeit: 2022-12-31 18:43:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Tabellen-Dump failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Tabellen-Dump footprintUnit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `footprintUnit`;

CREATE TABLE `footprintUnit` (
  `footprintUnitID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`footprintUnitID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump manufacturer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `manufacturer`;

CREATE TABLE `manufacturer` (
  `manufacturerID` int unsigned NOT NULL AUTO_INCREMENT,
  `manufacturerName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fk_userID` bigint unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`manufacturerID`),
  KEY `fk_userID` (`fk_userID`),
  CONSTRAINT `manufacturer_ibfk_1` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Tabellen-Dump password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Tabellen-Dump personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Tabellen-Dump product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `productID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `fk_userID` bigint unsigned NOT NULL,
  PRIMARY KEY (`productID`),
  KEY `fk_userID` (`fk_userID`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `supplierID` int unsigned NOT NULL AUTO_INCREMENT,
  `supplierName` varchar(255) DEFAULT NULL,
  `fk_userID` bigint unsigned NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`supplierID`),
  KEY `fk_userID` (`fk_userID`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`fk_userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `tagID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fk_userID` bigint unsigned NOT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump tagVariantLink
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tagVariantLink`;

CREATE TABLE `tagVariantLink` (
  `tagVariantLinkID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fk_tagID` bigint unsigned NOT NULL,
  `fk_variantID` bigint unsigned NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`tagVariantLinkID`),
  KEY `fk_tagID` (`fk_tagID`),
  KEY `fk_variantID` (`fk_variantID`),
  CONSTRAINT `tagvariantlink_ibfk_1` FOREIGN KEY (`fk_tagID`) REFERENCES `tag` (`tagID`),
  CONSTRAINT `tagvariantlink_ibfk_2` FOREIGN KEY (`fk_variantID`) REFERENCES `variant` (`variantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Tabellen-Dump variant
# ------------------------------------------------------------

DROP TABLE IF EXISTS `variant`;

CREATE TABLE `variant` (
  `variantID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `fk_productID` bigint unsigned NOT NULL,
  `footprint` decimal(8,2) NOT NULL,
  `fk_footprintUnitID` bigint unsigned NOT NULL,
  `fk_verifyingGradeID` bigint unsigned NOT NULL,
  PRIMARY KEY (`variantID`),
  KEY `fk_productID` (`fk_productID`),
  KEY `fk_footprintUnitID` (`fk_footprintUnitID`),
  KEY `fk_verifyingGradID` (`fk_verifyingGradeID`),
  CONSTRAINT `variant_ibfk_1` FOREIGN KEY (`fk_productID`) REFERENCES `product` (`productID`),
  CONSTRAINT `variant_ibfk_2` FOREIGN KEY (`fk_footprintUnitID`) REFERENCES `footprintUnit` (`footprintUnitID`),
  CONSTRAINT `variant_ibfk_3` FOREIGN KEY (`fk_verifyingGradeID`) REFERENCES `verifyingGrade` (`verifyingGradeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



# Tabellen-Dump verifyingGrade
# ------------------------------------------------------------

DROP TABLE IF EXISTS `verifyingGrade`;

CREATE TABLE `verifyingGrade` (
  `verifyingGradeID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `grade` int NOT NULL,
  PRIMARY KEY (`verifyingGradeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
