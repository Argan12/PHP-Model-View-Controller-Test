<?php
	require_once('model/Database.php');
	
	class PostManager extends Database {
		public function getPosts() {
			$database = $this->dbConnect();
			$searchPosts = $database->query('SELECT post_id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %H:%i\') AS datetime FROM mvctest ORDER BY post_id DESC');
			
			return $searchPosts;
		}
		
		public function getPost($postID) {
			$database = $this->dbConnect();
			$displayPost = $database->prepare('SELECT post_id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %H:%i\') AS datetime FROM mvctest WHERE post_id = ?');
			$displayPost->execute(array($postID));
			$post = $displayPost->fetch();
			
			return $post;
		}
	
		public function postEdit($title, $content) {
			$database = $this->dbConnect();
			$edit = $database->prepare('INSERT INTO mvctest(title, content, date) VALUES(?, ?, NOW())');
			$save = $edit->execute(array(htmlspecialchars($title), nl2br(htmlspecialchars($content))));
		
			return $save;
		}
		
		public function postUpdate($postID, $title, $content) {
			$database = $this->dbConnect();
			$update = $database->prepare('UPDATE mvctest SET title = :title, content = :content WHERE post_id = :post_id');
			$update->execute(array(
				'post_id' => $postID,
				'title' => $title,
				'content' => $content
			));
			
			return $update;
		}
		
		public function postDelete($postID) {
			$database = $this->dbConnect();
			$infoPost = $database->prepare('DELETE FROM mvctest WHERE post_id = ?');
			$infoPost->execute(array($postID));
			$deletePost = $infoPost->fetch();
			
			return $deletePost;
		}
	}