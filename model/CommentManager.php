<?php
	require_once('model/Database.php');
	
	class CommentManager extends Database {
		public function postComment($postID, $authorID, $authorFirstname, $authorLastname, $comment) {
			$database = $this->dbConnect();
			$post_comment = $database->prepare('INSERT INTO mvctestcomments(post_id, author_id, author_firstname, author_lastname, comment, date) VALUES(?, ?, ?, ?, ?, NOW())');
			$published_comment = $post_comment->execute(array(nl2br(htmlspecialchars($postID)), nl2br(htmlspecialchars($authorID)), nl2br(htmlspecialchars($authorFirstname)), nl2br(htmlspecialchars($authorLastname)), nl2br(htmlspecialchars($comment))));
			
			return $published_comment;
		}
			
		public function getComments($postID) {
			$database = $this->dbConnect();
			$comments = $database->prepare('SELECT id, post_id, author_firstname, author_lastname, comment, DATE_FORMAT(date, \'%d/%m/%Y à %H:%i\') AS fr_date FROM mvctestcomments WHERE post_id = ? ORDER BY id DESC');
			$comments->execute(array($postID));
			
			return $comments;
		}
		
		public function countComments($postID) {
			$database = $this->dbConnect();
			$count = $database->prepare('SELECT COUNT(*) AS nb_comments FROM mvctestcomments WHERE post_id = ?');
			$count->execute(array($postID));
			
			return $count;
		}
	}	