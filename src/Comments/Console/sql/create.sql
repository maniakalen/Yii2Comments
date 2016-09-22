CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_relation` enum('') COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_relation_id` VARCHAR(65) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `table_item_idx` (`table_relation`,`table_relation_id`),
  KEY `user_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
