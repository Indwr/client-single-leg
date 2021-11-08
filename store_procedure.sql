DELIMITER //

CREATE PROCEDURE checkLike(wherePostId integer(11),whereUserId varchar(15))
BEGIN
	SELECT isLike  FROM posts_like WHERE post_id = wherePostId and user_id = whereUserId;
END //

DELIMITER ;

-- Added By Indersein
ALTER TABLE `tbl_users` ADD `timmer` DATETIME NULL DEFAULT NULL AFTER `upgrade_date`;



CREATE TABLE `setting` (
  `id` int NOT NULL,
  `timmer` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timmer` (`timmer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;