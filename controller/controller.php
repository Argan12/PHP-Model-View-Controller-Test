<!-- Controller contains PHP functions which will be call by router -->

<?php
	require_once('model/PostManager.php');
	require_once('model/MemberManager.php');
	require_once('model/CommentManager.php');
	
	// Homepage
	// Display every posts
	function listPosts() {
		$postManager = new PostManager();
		$commentManager = new CommentManager();
		$searchPosts = $postManager->getPosts();
		
		require('view/homepage.php');
	}
	
	// Save post in database
	function savePost($title, $content) {
		$postManager = new PostManager();
		$save = $postManager->postEdit($title, $content);
		
		if ($edit === false)
			throw new Exception('Action impossible');
		else 
			header('Location:index.php?action=listPosts');
	}
	
	function updatePostPage() {
		$postManager = new PostManager();
		$post = $postManager->getPost($_GET['id']);
		
		require('view/update.php');
	}
	
	// Save new post content in database
	function updatePost($postID, $title, $content) {
		$postManager = new PostManager();
		$update = $postManager->postUpdate($postID, $title, $content);
		
		if ($modifyPost === false)
			throw new Exception('Action impossible');
		else 
			header('Location:index.php?action=update&id='.$_GET['id']);
	}
	
	// Delete post from database
	function deletePost($postID) {
		$postManager = new PostManager();
		$deletePost = $postManager->postDelete($postID);
		
		if ($infoPost === false)
			throw new Exception('Action impossible');
		else 
			header('Location:index.php?action=listPosts');
	}
	
	function displayComments() {
		$postManager = new PostManager();
		$commentManager = new CommentManager();
		
		$post = $postManager->getPost($_GET['id']);
		$comments = $commentManager->getComments($_GET['id']);
		
		require('view/comment.php');
	}
	
	// Page to publish new comments via inputs
	function newComment() {
		$postManager = new PostManager();
		$commentManager = new CommentManager();
		$post = $postManager->getPost($_GET['id']);
		$count = $commentManager->countComments($_GET['id']);
		
		require('view/newComment.php');
	}
	
	// Save new comments in database
	function saveComment($postID, $authorID, $authorFirstname, $authorLastname, $comment) {
		$commentManager = new CommentManager();
		$published_comment = $commentManager->postComment($postID, $authorID, $authorFirstname, $authorLastname, $comment);
		
		if ($published_comment === false)
			throw new Exception('Impossible d\'ajouter votre commentaire..');
		else 
			header('Location:index.php?action=comment&id='.$_GET['id']);
	}
		
	// Create an account
	function registerPage($firstname, $lastname, $mail_address, $password) {
		$memberManager = new MemberManager();
		$register = $memberManager->newMember($firstname, $lastname, $mail_address, $password);
		
		if ($register === false)
			throw new Exception('Action impossible');
		else 
			header('Location:index.php?action=listPosts');
	}

	function login($mail_address, $password) {
		$memberManager = new MemberManager();
		$log = $memberManager->accessAllowed($mail_address, $password);
		$check = $log->fetch();
		
		if (!$check)
		{
			echo 'Mot de passe incorrect';
		} else {
			if (password_verify($password, $check['password']))
			{
				session_start();
				$_SESSION['id'] = $check['member_id'];
				$_SESSION['firstname'] = $check['firstname'];
				$_SESSION['lastname'] = $check['lastname'];
				$_SESSION['mail_address'] = $check['mail_address'];
				
				header('Location:index.php?action=listPosts');
			} else {
				header('Location:index.php');
			}
		}
	}
	
	function logout() {
		session_start();		
		$_SESSION = array();		
		session_destroy;
		
		header('Location:index.php');
	}
