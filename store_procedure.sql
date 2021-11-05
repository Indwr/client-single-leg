DELIMITER //

CREATE PROCEDURE checkLike(wherePostId integer(11),whereUserId varchar(15))
BEGIN
	SELECT isLike  FROM posts_like WHERE post_id = wherePostId and user_id = whereUserId;
END //

DELIMITER ;